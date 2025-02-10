<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\EquipoTorneo;
use App\Models\Jugador;
use App\Models\Jugadore;
use App\Models\JugadorEquipo;
use App\Models\JugadorEquipoTorneo;
use App\Models\Torneo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Equipo_Torneo_JugadorController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de la tabla pivote
        $equipo_torneo_jugadores = EquipoTorneo::with('equipo', 'torneo')->get();

        // Obtener todos los equipos con el conteo de jugadores
        $equipos = Equipo::withCount('jugador_equipos')->get();

        return view('equipo_torneo_jugadores.index', compact('equipo_torneo_jugadores', 'equipos'));
    }

    public function crear()
    {
        $torneos = Torneo::all();

        return view('equipo_torneo_jugadores.create', compact('torneos'));
    }

    public function guardar(Request $request)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'torneo_id' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El nombre del equipo es requerido',
            'nombre.string' => 'El nombre del equipo debe ser un texto',
            'nombre.max' => 'El nombre del equipo debe tener máximo 100 caracteres',
            'nombre.unique' => 'El nombre del equipo ya existe para ese torneo',
            'torneo_id.required' => 'Por favor elige un torneo',
            'logo.image' => 'El logo debe ser una imagen',
            'logo.mimes' => 'El logo debe ser de tipo: jpeg, png, jpg, gif, svg',
            'logo.max' => 'El logo debe tener un tamaño máximo de 2MB',
        ]);

        // Mostrar errores de validación
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }

        // Guardar equipo
        try {
            DB::beginTransaction();
            // Verificar si ya existe el nombre del equipo en el torneo
            $equipoExistente = EquipoTorneo::whereHas('equipo', function ($query) use ($request) {
                $query->where('nombre', $request->nombre);
            })->where('torneo_id', $request->torneo_id)->first();

            if ($equipoExistente) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El equipo ' . $request->nombre . ' ya existe para el torneo seleccionado.'
                ], 422);
            }

            $equipo = new Equipo();
            $equipo->nombre = $request->nombre;

            if ($request->hasFile('logo')) {
                $path = Storage::disk('public')->put('logos', $request->file('logo'));
                $equipo->escudo = $path;
            } else {
                $equipo->escudo = 'assets/club-de-futbol.png';
            }

            $equipo->save();

            if ($request->jugadores == null) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Debe agregar al menos un jugador.'
                ], 422);
            } else {
                // Recibir el array "jugadores" del formulario y recorrerlo
                foreach ($request->jugadores as $jugadorData) {
                    // Validar cada jugador individualmente
                    $jugadorValidator = Validator::make($jugadorData, [
                        'nombre' => 'required|string|max:100',
                        'edad' => 'required|integer|min:1',
                        'num_jugador' => 'required|integer',
                        // 'foto' => 'nullable|image',
                    ], [
                        'nombre.required' => 'El nombre del jugador es requerido',
                        'nombre.string' => 'El nombre del jugador debe ser un texto',
                        'nombre.max' => 'El nombre del jugador debe tener máximo 100 caracteres',
                        'edad.required' => 'La edad del jugador es requerida',
                        'edad.integer' => 'La edad del jugador debe ser un número entero',
                        'edad.min' => 'La edad del jugador debe ser al menos 1',
                        'num_jugador.required' => 'El número del jugador es requerido',
                        'num_jugador.integer' => 'El número del jugador debe ser un número entero',
                        // 'foto.image' => 'La foto del jugador debe ser una imagen',
                        // 'foto.mimes' => 'La foto del jugador debe ser de tipo: jpeg, png, jpg, gif, svg',
                        // 'foto.max' => 'La foto del jugador debe tener un tamaño máximo de 2MB',
                    ]);

                    // Mostrar errores de validación para cada jugador
                    if ($jugadorValidator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $jugadorValidator->errors()
                        ], 422); // Código 422 para errores de validación
                    }

                    // Verificar si el jugador ya existe
                    // $jugadorExistente = Jugador::where('nombre', $jugadorData['nombre'])->first();
                    // if ($jugadorExistente) {
                    //     return response()->json([
                    //         'success' => false,
                    //         'mensaje' => 'El jugador ' . $jugadorData['nombre'] . ' ya existe.'
                    //     ], 422);
                    // }

                    $jugador = new Jugador();
                    $jugador->nombre = $jugadorData['nombre'];
                    $jugador->edad = $jugadorData['edad'];

                    if (isset($jugadorData['foto_file']) && $jugadorData['foto_file'] instanceof \Illuminate\Http\UploadedFile) {
                        // Si se subió un nuevo archivo
                        $file = $jugadorData['foto_file'];
                        $extension = $file->getClientOriginalExtension();
                        $fileName = time() . '_' . uniqid() . '.' . $extension;
                        $path = Storage::disk('public')->putFileAs('jugadores', $file, $fileName);
                        $jugador->foto = $path;
                    } elseif (isset($jugadorData['foto']) && filter_var($jugadorData['foto'], FILTER_VALIDATE_URL)) {
                        // Si es una URL válida (podría ser la imagen predeterminada o una ya cargada)
                        $jugador->foto = $jugadorData['foto'];
                    } else {
                        // Si no hay foto, usa la imagen por defecto
                        $jugador->foto = 'assets/avatar-jugador.png';
                    }


                    $jugador->numero_camiseta = $jugadorData['num_jugador'];
                    // dd($jugador);
                    $jugador->save();

                    // Guardar cada jugador en la tabla jugador_equipo
                    $jugador_equipo = new JugadorEquipo();
                    $jugador_equipo->equipo_id = $equipo->id;
                    $jugador_equipo->jugador_id = $jugador->id;
                    $jugador_equipo->torneo_id = $request->torneo_id;
                    $jugador_equipo->save();
                }
            }

            DB::commit();
            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Guardado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al guardar: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    // Método para editar un equipo
    public function editar($id)
    {
        $equipo = EquipoTorneo::with('equipo', 'torneo')->findOrFail($id);
        $torneos = Torneo::all();

        return view('equipo_torneo_jugadores.edit', compact('equipo', 'torneos'));
    }

    // Método para actualizar un equipo

    public function actualizar(Request $request, $id)
    {
        // dd($request->all());
        // Validar campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'torneo_id' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El nombre del equipo es requerido',
            'nombre.string' => 'El nombre del equipo debe ser un texto',
            'nombre.max' => 'El nombre del equipo debe tener máximo 100 caracteres',
            'nombre.unique' => 'El nombre del equipo ya existe para ese torneo',
            'torneo_id.required' => 'El torneo es requerido',
            'logo.image' => 'El logo del equipo debe ser una imagen',
            'logo.mimes' => 'El logo del equipo debe ser de tipo: jpeg, png, jpg, gif, svg',
            'logo.max' => 'El logo del equipo debe tener un tamaño máximo de 2MB',
        ]);

        // Mostrar errores de validación
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }

        // Actualizar equipo
        try {
            DB::beginTransaction();
            // Verificar si ya existe el nombre del equipo en el torneo actual pero no es el mismo equipo
            $equipoExistente = Equipo::where('nombre', $request->nombre)
                ->whereHas('torneos', function ($query) use ($request, $id) {
                    $query->where('torneo_id', $request->torneo_id)
                        ->where('equipo_id', '!=', $id);
                })
                ->first();

            if ($equipoExistente) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'El equipo ' . $request->nombre . ' ya existe para el torneo seleccionado.'
                ], 422);
            }

            $equipo = Equipo::findOrFail($id);
            $equipo->nombre = $request->nombre;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $file_name = time() . '.png';
                $file->move(public_path('images/logos'), $file_name);
                $equipo->escudo = 'images/logos/' . $file_name;
            }

            $equipo->save();

            if ($request->jugadores) {
                // Recibir el array "jugadores" del formulario y recorrerlo
                foreach ($request->jugadores as $jugadorData) {
                    // Validar cada jugador individualmente
                    $jugadorValidator = Validator::make($jugadorData, [
                        'nombre' => 'required|string|max:100',
                        'edad' => 'required|integer|min:1',
                        'num_jugador' => 'required|integer',
                        // 'foto' => 'nullable|image',
                    ], [
                        'nombre.required' => 'El nombre del jugador es requerido',
                        'nombre.string' => 'El nombre del jugador debe ser un texto',
                        'nombre.max' => 'El nombre del jugador debe tener máximo 100 caracteres',
                        'edad.required' => 'La edad del jugador es requerida',
                        'edad.integer' => 'La edad del jugador debe ser un número entero',
                        'edad.min' => 'La edad del jugador debe ser al menos 1',
                        'num_jugador.required' => 'El número del jugador es requerido',
                        'num_jugador.integer' => 'El número del jugador debe ser un número entero',
                        // 'foto.image' => 'La foto del jugador debe ser una imagen',
                        // 'foto.mimes' => 'La foto del jugador debe ser de tipo: jpeg, png, jpg, gif, svg',
                        // 'foto.max' => 'La foto del jugador debe tener un tamaño máximo de 2MB',
                    ]);

                    // Mostrar errores de validación para cada jugador
                    if ($jugadorValidator->fails()) {
                        return response()->json([
                            'success' => false,
                            'errors' => $jugadorValidator->errors()
                        ], 422); // Código 422 para errores de validación
                    }

                    // Verificar si el jugador ya existe
                    // $jugadorExistente = Jugador::where('nombre', $jugadorData['nombre'])->first();
                    // if ($jugadorExistente) {
                    //     return response()->json([
                    //         'success' => false,
                    //         'mensaje' => 'El jugador ' . $jugadorData['nombre'] . ' ya existe.'
                    //     ], 422);
                    // }

                    $jugador = new Jugador();
                    $jugador->nombre = $jugadorData['nombre'];
                    $jugador->edad = $jugadorData['edad'];

                    if (isset($jugadorData['foto_file']) && $jugadorData['foto_file'] instanceof \Illuminate\Http\UploadedFile) {
                        // Si se subió un nuevo archivo
                        $file = $jugadorData['foto_file'];
                        $extension = $file->getClientOriginalExtension();
                        $fileName = time() . '_' . uniqid() . '.' . $extension;
                        $path = Storage::disk('public')->putFileAs('jugadores', $file, $fileName);
                        $jugador->foto = $path;
                    } elseif (isset($jugadorData['foto']) && filter_var($jugadorData['foto'], FILTER_VALIDATE_URL)) {
                        // Si es una URL válida (podría ser la imagen predeterminada o una ya cargada)
                        $jugador->foto = $jugadorData['foto'];
                    } else {
                        // Si no hay foto, usa la imagen por defecto
                        $jugador->foto = 'assets/avatar-jugador.png';
                    }


                    $jugador->numero_camiseta = $jugadorData['num_jugador'];
                    // dd($jugador);
                    $jugador->save();

                    // Guardar cada jugador en la tabla jugador_equipo
                    $jugador_equipo = new JugadorEquipo();
                    $jugador_equipo->equipo_id = $equipo->id;
                    $jugador_equipo->jugador_id = $jugador->id;
                    $jugador_equipo->torneo_id = $request->torneo_id;
                    // dd($jugador_equipo);
                    $jugador_equipo->save();
                }
            }

            DB::commit();
            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al actualizar: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    //editar jugador 
    public function editarJugador($id)
    {
        $jugador = Jugador::findOrFail($id);
        return view('equipo_torneo_jugadores.editJugador', compact('jugador'));
    }

    // Método para actualizar un jugador
    public function actualizarJugador(Request $request, $id)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'edad' => 'required|integer|min:1',
            'numero_camiseta' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El nombre del jugador es requerido',
            'nombre.string' => 'El nombre del jugador debe ser un texto',
            'nombre.max' => 'El nombre del jugador debe tener máximo 100 caracteres',
            'edad.required' => 'La edad del jugador es requerida',
            'edad.integer' => 'La edad del jugador debe ser un número entero',
            'edad.min' => 'La edad del jugador debe ser al menos 1',
            'numero_camiseta.required' => 'El número de camiseta es requerido',
            'numero_camiseta.integer' => 'El número de camiseta debe ser un número entero',
            'foto.image' => 'La foto del jugador debe ser una imagen',
            'foto.mimes' => 'La foto del jugador debe ser de tipo: jpeg, png, jpg, gif, svg',
            'foto.max' => 'La foto del jugador debe tener un tamaño máximo de 2MB',
        ]);

        // Mostrar errores de validación
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }

        // Actualizar jugador
        try {
            DB::beginTransaction();
            $jugador = Jugador::findOrFail($id);
            $jugador->nombre = $request->nombre;
            $jugador->edad = $request->edad;
            $jugador->numero_camiseta = $request->numero_camiseta;

            if ($request->hasFile('foto')) {
                // Eliminar foto anterior
                if ($jugador->foto) {
                    Storage::disk('public')->delete($jugador->foto);
                }

                // Guardar nueva foto
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $extension;
                $path = Storage::disk('public')->putFileAs('jugadores', $file, $fileName);
                $jugador->foto = $path;
            }

            $jugador->save();

            DB::commit();
            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al actualizar: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    // Método para eliminar un equipo
    public function eliminar($id)
    {
        // Eliminar equipo
        try {
            DB::beginTransaction();
            $equipo = EquipoTorneo::findOrFail($id);
            // Eliminar jugadores del equipo
            $equipo->equipo()->delete();
            $equipo->jugador()->delete();
            $equipo->delete();
            DB::commit();
            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al eliminar: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }
}
