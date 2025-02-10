<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }


    // Método para mostrar formulario de creación de categoría
    public function crear()
    {
        return view('categorias.create');
    }


    // Método para guardar categoría
    public function guardar(Request $request)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            //validar que El nombre de la categoría sea requerido, string y maximo de 255 caracteres y unico
            'nombre' => 'required|string|max:50|unique:categorias'
        ],
        [
            'nombre.required' => 'El nombre de la categoría es requerido',
            'nombre.string' => 'El nombre de la categoría debe ser un texto',
            'nombre.max' => 'El nombre de la categoría debe tener máximo 50 caracteres',
            'nombre.unique' => 'El nombre de la categoría ya existe'
        ]);

        // Mostrar errores de validación
        // Si la validación falla, devolver errores en JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }
    

        // Guardar categoria
        try {
            $categoria = new Categoria();
            $categoria->nombre = $request->nombre;
            $categoria->save();


             // Mensaje de éxito en JSON
             return response()->json([
                'success' => true,
                'mensaje' => 'Categoría guardada correctamente.'
            ]);
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al guardar la Categoría: ' . $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }


    // Método para editar categoría
    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }


    // Método para actualizar categoría
    public function actualizar(Request $request, $id)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            // Validar que el nombre de la categoría sea requerido, string, máximo de 50 caracteres y único, excluyendo el registro actual
            'nombre' => 'required|string|max:50|unique:categorias,nombre,' . $id . ',id'
        ],
        [
            'nombre.required' => 'El nombre de la categoría es requerido',
            'nombre.string' => 'El nombre de la categoría debe ser un texto',
            'nombre.max' => 'El nombre de la categoría debe tener máximo 50 caracteres',
            'nombre.unique' => 'El nombre de la categoría ya existe'
        ]);
    
        // Mostrar errores de validación
        // Si la validación falla, devolver errores en JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // Código 422 para errores de validación
        }
    
        // Actualizar categoría
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->nombre = $request->nombre;
            $categoria->save(); 
            // Mensaje de éxito en JSON
            return response()->json([
                'success' => true,
                'mensaje' => 'Categoría actualizada correctamente.'
            ]);
    
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al actualizar la categoría: '. $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }

    // Método para eliminar categoría
    public function eliminar($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
            // Mensaje de éxito en JSON
            return response()->json([
               'success' => true,
               'mensaje' => 'Categoría eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            // Mensaje de error en JSON
            return response()->json([
               'success' => false,
               'mensaje' => 'Error al eliminar la categoría: '. $e->getMessage()
            ], 500); // Código 500 para errores del servidor
        }
    }
}
