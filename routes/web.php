<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CursoController;


/* RUTAS DE VISTAS */

Route::view('/', 'inicio')->name('inicio');
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

Route::middleware('auth')->group(function () {
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/mis-cursos', [CursoController::class, 'misCursos'])->name('cursos.mis-cursos');
    Route::get('/cursos/{curso}/editar', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::put('/cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
    Route::patch('/cursos/{curso}/cambiar-estado', [CursoController::class, 'cambiarEstado'])->name('cursos.cambiar-estado');
    Route::delete('/cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');
});
