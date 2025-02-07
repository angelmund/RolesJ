<?php

namespace App\Http\Controllers;

use App\Models\Modalidad;
use App\Models\Modalidade;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TorneosController extends Controller
{
    public function  index()
    {
        $torneos = Torneo::all();
        return view('torneos.index', compact('torneos'));
    }

    public function crear()
    {
        $modalidades = Modalidad::all();
        return view('torneos.create', compact('modalidades'));
    }

    public function guardar(Request $request)
    {
        // dd($request->all());
        // Validar campos
        $validator = Validator::make($request->all(), [
            //validar que el campo nombre sea requerido, string y maximo de 255 caracteres y unico
            'nombre' => 'required|string|max:100|unique:modalidades',
            'modalidad_id' => 'required|integer',
            'fecha_inicio' => 'required|date',
        ],
        [
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.string' => 'El campo nombre debe ser un texto',
            'nombre.max' => 'El campo nombre debe tener máximo de 100 caracteres',
            'nombre.unique' => 'El campo nombre ya existe',
            'modalidad_id.required' => 'La modalidad es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
        ]);

        // Mostrar errores de validación
        // Si la validación falla, devolver errores en JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }
    

        // Guardar modalidad
        try {
            $modalidad = new Torneo();
            $modalidad->nombre = $request->nombre;
            $modalidad->modalidad_id = $request->modalidad_id;
            $modalidad->fecha_inicio = $request->fecha_inicio;
            $modalidad->fecha_fin = $request->fecha_fin;
            $modalidad->save();


             // Mensaje de éxito en JSON
             return response()->json([
                'success' => true,
                'mensaje' => 'Torneo guardadao correctamente.'
            ]);
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al guardar el torneo: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    public function editar($id)
    {
        $torneo = Torneo::findOrFail($id);
        $modalidades = Modalidad::all();
        return view('torneos.edit', compact('torneo', 'modalidades'));
    }

        // Función para actualizar la modalidad
        public function actualizar(Request $request, $id)
        {
            // Validar campos
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:100|unique:modalidades,nombre,' . $id,
                'modalidad_id' => 'required|integer',
                'fecha_inicio' => 'required|date',
            ], [
                'nombre.required' => 'El campo nombre es requerido',
                'nombre.string' => 'El campo nombre debe ser un texto',
                'nombre.max' => 'El campo nombre debe tener máximo de 100 caracteres',
                'nombre.unique' => 'El campo nombre ya existe',
                'modalidad_id.required' => 'La modalidad es requerida',
                'fecha_inicio.required' => 'La fecha de inicio es requerida',
            ]);
    
            // Mostrar errores de validación
            // Si la validación falla, devolver errores en JSON
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422); // Código 422 para errores de validación
            }
    
            // Actualizar modalidad
            try {
                $torneo = Torneo::findOrFail($id);
                $torneo->nombre = $request->nombre;
                $torneo->modalidad_id = $request->modalidad_id;
                $torneo->fecha_inicio = $request->fecha_inicio;
                $torneo->fecha_fin = $request->fecha_fin;
                $torneo->save();
    
                // Mensaje de éxito en JSON
                return response()->json([
                    'success' => true,
                    'mensaje' => 'Torneo actualizado correctamente.'
                ]);
            } catch (\Exception $e) {
                // Mensaje de error en JSON
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Error al actualizar el torneo: ' . $e->getMessage()
                ], 500); // Código 500 para errores del servidor
            }
        }
    
        // Función para eliminar la modalidad
        public function eliminar($id)
        {
            // Buscar la modalidad
            $torneo = Torneo::findOrFail($id);
    
            // Eliminar la modalidad
            try {
                $torneo->delete();
    
                // Mensaje de éxito en JSON
                return response()->json([
                    'success' => true,
                    'mensaje' => 'Torneo eliminado correctamente.'
                ]); 
            } catch (\Exception $e) {
                // Mensaje de error en JSON
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Error al eliminar el torneo: ' . $e->getMessage()
                ], 500); // Código 500 para errores del servidor
            }
        }
}
