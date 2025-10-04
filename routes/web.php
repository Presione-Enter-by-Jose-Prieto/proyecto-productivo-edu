<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;


/* RUTAS DE VISTAS */

Route::get('/', [HomeController::class, 'index'])->name('inicio');
Route::view('/login', 'login')->name('login');
Route::view('/registro', 'registro')->name('registro');
Route::view('/creditos', 'creditos')->name('creditos');
Route::get('/preinscripcion/{seccion?}', function (Request $request, $seccion = 'preinscripcion') {
    // Redirigir a la ruta específica para 'mis-cursos'
    if ($seccion === 'mis-cursos') {
        return redirect()->route('cursos.mis-cursos');
    }
    
    $data = ['seccion' => $seccion];
    
    // Definir categorías disponibles para cualquier sección
    $data['categorias'] = [
        'deportivo' => 'Deportivo',
        'disciplinario' => 'Disciplinario',
        'pedagogico' => 'Pedagógico',
        'idiomas' => 'Idiomas',
        'otro' => 'Otro'
    ];
    
    // Cargar el curso si estamos en edición o visualización
    if (($seccion === 'editar-curso' || $seccion === 'ver-curso') && $request->has('curso')) {
        $curso = \App\Models\Curso::findOrFail($request->curso);
        $data['curso'] = $curso;
    }
    
    return view('preinscripcion', $data);
})->where('seccion', 'preinscripcion|mis-cursos|crear-curso|editar-curso|ver-curso')
  ->middleware('auth')
  ->name('preinscripcion');
Route::view('/mensajeria', 'mensajeria')->middleware('auth')->name('mensajeria');
Route::view('/asistencia', 'asistencia')->middleware('auth')->name('asistencia');
Route::view('/sobreproyecto', 'sobreesteproyecto')->name('sobreproyecto');
Route::view('/excusas', 'excusas')->middleware('auth')->name('excusas');

/* RUTAS DE ACCIONES */
Route::post('/validar-login', [LoginController::class, 'login'])->name('validar-login');
Route::post('/validar-register', [LoginController::class, 'register'])->name('validar-register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para los cursos
// Ruta pública para ver cursos publicados
Route::get('/cursos-publicados', [CursoController::class, 'cursosPublicados'])->name('cursos.publicados');

// Ruta para preinscripción (accesible solo para usuarios autenticados)
Route::post('/cursos/{curso}/preinscribir', [CursoController::class, 'preinscribir'])
    ->middleware('auth')
    ->name('cursos.preinscribir');

// Ruta para eliminar preinscripción (accesible solo para usuarios autenticados)
Route::delete('/cursos/{curso}/eliminar-preinscripcion', [CursoController::class, 'eliminarPreinscripcion'])
    ->middleware('auth')
    ->name('cursos.eliminar-preinscripcion');

Route::middleware('auth')->group(function () {
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/mis-cursos', [CursoController::class, 'misCursos'])->name('cursos.mis-cursos');
    Route::get('/cursos/{curso}/editar', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::put('/cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
    Route::patch('/cursos/{curso}/cambiar-estado', [CursoController::class, 'cambiarEstado'])->name('cursos.cambiar-estado');
    Route::delete('/cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
    Route::get('/cursos/{curso}/lista-preinscritos', [CursoController::class, 'listaPreinscritos'])->name('cursos.lista-preinscritos');

    Route::post('/cursos/{curso}/usuarios/{user}/aprobar', [CursoController::class, 'aprobarPreinscrito'])
        ->name('cursos.aprobarPreinscrito');
    Route::post('/cursos/{curso}/usuarios/{user}/rechazar', [CursoController::class, 'rechazarPreinscrito'])
        ->name('cursos.rechazarPreinscrito');
    Route::delete('/cursos/{curso}/inscritos/{user}/eliminar', [CursoController::class, 'eliminarInscrito'])
    ->name('cursos.eliminarInscrito')
    ->middleware('auth');



});
