<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CursoController extends Controller
{
    // Categorías predefinidas para los cursos
    protected $categorias = [
        'deportivo' => 'Deportivo',
        'disciplinario' => 'Disciplinario',
        'pedagogico' => 'Pedagógico',
        'idiomas' => 'Idiomas',
        'otro' => 'Otro'
    ];

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        // Verificar si el usuario es docente
        if (Auth::user()->role !== 'docente') {
            return redirect()->route('preinscripcion')
                ->with('error', 'No tienes permiso para crear cursos.');
        }

        // Redirigir a la ruta de preinscripción con el parámetro de sección
        return redirect()->route('preinscripcion', ['seccion' => 'crear-curso']);
    }

    /**
     * Almacena un nuevo curso en la base de datos.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario es docente
        if (Auth::user()->role !== 'docente') {
            return redirect()->route('preinscripcion')
                ->with('error', 'No tienes permiso para crear cursos.');
        }

        // Validar los datos del formulario
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg', // 5MB max
            'categoria' => 'required|string|in:' . implode(',', array_keys($this->categorias)),
            'nivel' => 'required|in:basico,intermedio,avanzado',
            'duracion_horas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'telefono_contacto' => 'nullable|string|max:20',
            'lugar' => 'nullable|string|max:255',
            'cupo_maximo' => 'required|integer|min:1',
            'objetivos' => 'required|array|min:1',
            'objetivos.*' => 'string|max:255',
            'requisitos' => 'nullable|array',
            'requisitos.*' => 'string|max:255'
        ], [
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a hoy.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'objetivos.required' => 'Debe agregar al menos un objetivo de aprendizaje.',
            'objetivos.*.string' => 'Cada objetivo debe ser un texto.',
            'objetivos.*.max' => 'Cada objetivo no debe superar los 255 caracteres.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'El archivo debe ser de tipo: jpeg, png, jpg.',
            'imagen.max' => 'La imagen no debe pesar más de 5MB.'
        ]);

        try {
            // Procesar la imagen si se subió
            if ($request->hasFile('imagen')) {
                // Crear el directorio si no existe
                if (!Storage::exists('public/portadas')) {
                    Storage::makeDirectory('public/portadas');
                }
                
                // Obtener el archivo
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                
                // Generar un nombre único para la imagen
                $fileName = 'portada_' . time() . '_' . uniqid() . '.' . $extension;
                
                // Guardar la imagen en la carpeta portadas (sin 'public/' en el path)
                $path = $file->storeAs('portadas', $fileName, 'public');
                
                // Guardar la ruta relativa en la base de datos
                $datos['imagen'] = 'portadas/' . $fileName;
                
                // Si necesitas guardar todas las imágenes, puedes descomentar esta línea
                // $datos['imagenes_adicionales'] = json_encode(array_slice($imagenesSubidas, 1));
            }

            // Asegurarse de que los arrays de objetivos y requisitos sean JSON
            $datos['objetivos'] = array_values(array_filter($datos['objetivos']));
            $datos['requisitos'] = $request->has('requisitos') ? array_values(array_filter($datos['requisitos'])) : [];
            
            // Establecer el ID del usuario autenticado como creador del curso
            $datos['user_id'] = Auth::id();
            
            // Establecer el estado inicial
            $datos['estado'] = 'borrador';
            $datos['aprobado'] = false;
            
            // Crear el curso
            $curso = Curso::create($datos);

            return redirect()->route('preinscripcion', ['seccion' => 'mis-cursos'])
                ->with('success', '¡Curso creado exitosamente! Está pendiente de aprobación.');
                
        } catch (\Exception $e) {
            // En caso de error, redirigir de vuelta con un mensaje de error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocurrió un error al crear el curso. Por favor, inténtalo de nuevo.');
        }
    }

    /**
     * Muestra los cursos creados por el usuario actual
     */
    public function misCursos()
    {
        // Obtener los cursos del usuario autenticado
        $cursos = Auth::user()->cursosCreados()->latest()->get();
        
        // Pasar a la vista con las variables necesarias
        return view('preinscripcion', [
            'seccion' => 'mis-cursos',
            'cursos' => $cursos,
            'user' => Auth::user() // Asegurarse de que el usuario esté disponible en la vista
        ]);
    }

    /**
     * Cambia el estado de un curso (publicado/borrador).
     */
    public function cambiarEstado(Request $request, Curso $curso)
    {
        // Verificar que el usuario es el propietario del curso o es administrador
        if (Auth::id() !== $curso->user_id && Auth::user()->role !== 'admin') {
            return back()->with('error', 'No tienes permiso para modificar este curso.');
        }

        $request->validate([
            'estado' => 'required|in:borrador,publicado,archivado',
        ]);

        $curso->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado del curso actualizado correctamente.');
    }
    
    /**
     * Remove the specified course from storage.
     */
    public function destroy(Curso $curso)
    {
        // Verificar que el usuario es el propietario del curso o es administrador
        if (Auth::id() !== $curso->user_id && Auth::user()->role !== 'admin') {
            return back()->with('error', 'No tienes permiso para eliminar este curso.');
        }

        try {
            // Eliminar la imagen del almacenamiento si existe
            if ($curso->imagen && Storage::exists($curso->imagen)) {
                Storage::delete($curso->imagen);
            }
            
            // Eliminar el curso
            $curso->delete();
            
            return redirect()->route('cursos.mis-cursos')
                ->with('success', 'El curso ha sido eliminado correctamente.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al intentar eliminar el curso.');
        }
    }

    /**
     * Muestra el formulario para editar un curso existente.
     */
    public function edit(Curso $curso)
    {
        // Verificar que el usuario sea el creador del curso
        if ($curso->user_id !== Auth::id()) {
            return redirect()->route('cursos.mis-cursos')
                ->with('error', 'No tienes permiso para editar este curso.');
        }

        // Obtener las categorías disponibles
        $categorias = $this->categorias;
        
        // Redirigir a la ruta de preinscripción con el parámetro de sección
        return redirect()->route('preinscripcion', [
            'seccion' => 'editar-curso',
            'curso' => $curso->id
        ]);
    }

    /**
     * Actualiza un curso existente en la base de datos.
     */
    public function update(Request $request, Curso $curso)
    {
        // Verificar que el usuario sea el creador del curso
        if ($curso->user_id !== Auth::id()) {
            return redirect()->route('cursos.mis-cursos')
                ->with('error', 'No tienes permiso para actualizar este curso.');
        }

        // Validar los datos del formulario
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'categoria' => 'required|string|in:' . implode(',', array_keys($this->categorias)),
            'nivel' => 'required|in:basico,intermedio,avanzado',
            'duracion_horas' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cupo_maximo' => 'required|integer|min:1',
            'objetivos' => 'required|array|min:1',
            'objetivos.*' => 'string|max:255',
            'requisitos' => 'nullable|array',
            'requisitos.*' => 'string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'lugar' => 'nullable|string|max:255',
            'eliminar_imagen' => 'nullable|boolean'
        ], [
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'objetivos.required' => 'Debe agregar al menos un objetivo de aprendizaje.',
            'objetivos.*.string' => 'Cada objetivo debe ser un texto.',
            'objetivos.*.max' => 'Cada objetivo no debe superar los 255 caracteres.'
        ]);

        try {
            // Procesar la imagen si se subió una nueva
            if ($request->hasFile('imagen')) {
                // Guardar la ruta de la imagen anterior antes de actualizarla
                $imagenAnterior = $curso->imagen;
                
                // Obtener el archivo
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                
                // Generar un nombre único para la imagen
                $fileName = 'portada_' . time() . '_' . uniqid() . '.' . $extension;
                
                // Guardar la nueva imagen
                $path = $file->storeAs('portadas', $fileName, 'public');
                
                // Guardar la ruta relativa en la base de datos
                $datos['imagen'] = 'portadas/' . $fileName;
                
                // Eliminar la imagen anterior después de guardar la nueva
                if ($imagenAnterior && Storage::disk('public')->exists($imagenAnterior)) {
                    Storage::disk('public')->delete($imagenAnterior);
                }
            } elseif ($request->has('eliminar_imagen') && $request->boolean('eliminar_imagen')) {
                // Eliminar la imagen si la casilla de eliminar está marcada
                if ($curso->imagen && Storage::disk('public')->exists($curso->imagen)) {
                    Storage::disk('public')->delete($curso->imagen);
                    $datos['imagen'] = null;
                }
            } else {
                // Mantener la imagen existente
                unset($datos['imagen']);
            }

            // Procesar arrays de objetivos y requisitos
            $datos['objetivos'] = array_values(array_filter($datos['objetivos']));
            $datos['requisitos'] = $request->has('requisitos') ? array_values(array_filter($datos['requisitos'])) : [];

            // Actualizar el curso
            $curso->update($datos);

            return redirect()->route('cursos.mis-cursos')
                ->with('success', '¡El curso ha sido actualizado exitosamente!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocurrió un error al actualizar el curso. Por favor, inténtalo de nuevo.');
        }
    }

    /**
     * Muestra todos los cursos publicados
     */
    public function cursosPublicados()
    {
        // Obtener solo los cursos con estado 'publicado'
        $cursos = Curso::where('estado', 'publicado')
                      ->latest()
                      ->get();
        
        // Pasar a la vista con las variables necesarias
        return view('preinscripcion', [
            'seccion' => 'cursos-publicados',
            'cursos' => $cursos,
            'user' => Auth::user()
        ]);
    }

    // Los demás métodos del controlador pueden permanecer vacíos por ahora
    public function index()
    {
        //
    }

    public function show(string $id)
    {
        //
    }
}
