<?php

namespace App\Http\Controllers;

use App\Models\Modalidad;
use App\Models\Modalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flasher\Toastr\Prime\ToastrInterface;

class ModalidadController extends Controller
{
    public function index()
    {
        $modalidades = Modalidad::all();
        return view('modalidades.index', compact('modalidades'));
    }

    public function crear()
    {
        return view('modalidades.create');
    }

    public function guardar(Request $request)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            //validar que el campo nombre sea requerido, string y maximo de 255 caracteres y unico
            'nombre' => 'required|string|max:50|unique:modalidades'
        ],
        [
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.string' => 'El campo nombre debe ser un texto',
            'nombre.max' => 'El campo nombre debe tener máximo 50 caracteres',
            'nombre.unique' => 'El campo nombre ya existe'
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
            $modalidad = new Modalidad();
            $modalidad->nombre = $request->nombre;
            $modalidad->save();


             // Mensaje de éxito en JSON
             return response()->json([
                'success' => true,
                'mensaje' => 'Modalidad guardada correctamente.'
            ]);
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al guardar la modalidad: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    public function editar($id)
    {
        $modalidad = Modalidad::findOrFail($id);
        return view('modalidades.edit', compact('modalidad'));
    }

     // Función para actualizar la modalidad
     public function actualizar(Request $request, $id)
     {
         // Validar campos
         $validator = Validator::make($request->all(), [
             'nombre' => 'required|string|max:50|unique:modalidades,nombre,' . $id
         ], [
             'nombre.required' => 'El campo nombre es requerido',
             'nombre.string' => 'El campo nombre debe ser un texto',
             'nombre.max' => 'El campo nombre debe tener máximo 50 caracteres',
             'nombre.unique' => 'El campo nombre ya existe'
         ]);
     
         // Si la validación falla, devolver errores en JSON
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors()
             ], 422); // Código 422 para errores de validación
         }
     
         // Guardar modalidad
         try {
             $modalidad = Modalidad::findOrFail($id);
             $modalidad->nombre = $request->nombre;
             $modalidad->save();
     
             // Mensaje de éxito en JSON
             return response()->json([
                 'success' => true,
                 'mensaje' => 'Modalidad actualizada correctamente.'
             ]);
         } catch (\Exception $e) {
             // Mensaje de error en JSON
             return response()->json([
                 'success' => false,
                 'mensaje' => 'Error al actualizar la modalidad: ' . $e->getMessage()
             ], 500); // Código 500 para errores del servidor
         }
     }

     // Función para eliminar la modalidad
    public function eliminar($id)
    {
        // Buscar la modalidad
        $modalidad = Modalidad::findOrFail($id);

        // Eliminar la modalidad
        try {
            $modalidad->delete();

            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Modalidad eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al eliminar la modalidad: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }
}