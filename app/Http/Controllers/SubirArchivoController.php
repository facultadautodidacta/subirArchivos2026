<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubirArchivoController extends Controller
{
    public function index()
    {
        // Obtener la lista de archivos para que la vista index (que incluye "listado") tenga la variable $archivos
        $archivos = Storage::disk('public')->allFiles('uploads');
        return view('index', compact('archivos'));
    }

    // Método para procesar la subida
    public function store(Request $request)
    {
        // Verificar si hay un archivo
        if ($request->hasFile('archivo')) {
            
            // Obtener el archivo
            $archivo = $request->file('archivo');

            // Obtener el nombre original y sanitizarlo para evitar caracteres problemáticos
            $originalName = $archivo->getClientOriginalName();

            $disk = Storage::disk('public');
            $destPath = 'uploads/' . $originalName;

            // Si ya existe un archivo con ese nombre, agregar un sufijo único para evitar sobreescritura
            if ($disk->exists($destPath)) {
                $extension = $archivo->getClientOriginalExtension();
                $basename = pathinfo($originalName, PATHINFO_FILENAME);
                $originalName = $basename . '_' . uniqid() . ($extension ? '.' . $extension : '');
            }

            // Guardar el archivo usando el nombre original 
            $archivo->storeAs('uploads', $originalName, 'public');

            // Retornar mensaje de éxito con la ruta
            return back()->with('mensaje', '¡Archivo subido correctamente!');
        }

        // Si no hay archivo
        return back()->with('error', 'No se seleccionó ningún archivo');
    }

    public function listar()
    {
        // allFiles() devuelve un array vacío si la carpeta no existe
        $archivos = Storage::disk('public')->allFiles('uploads');
        
        return view('listado', compact('archivos'));
    }

    // Método para eliminar un archivo (recibe la ruta relativa dentro de disk 'public', p.ej. 'uploads/archivo.txt')
    public function eliminar(Request $request)
    {
        $archivo = $request->input('archivo');

        // Validaciones básicas para evitar rutas peligrosas
        if (empty($archivo) || strpos($archivo, '..') !== false || !str_starts_with($archivo, 'uploads/')) {
            return back()->with('error', 'Nombre de archivo inválido');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($archivo)) {
            return back()->with('error', 'Archivo no encontrado');
        }

        // Eliminar el archivo
        $disk->delete($archivo);

        return back()->with('mensaje', 'Archivo eliminado correctamente');
    }
}
