<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured courses.
     */
    public function index()
    {
        // Get only published courses, ordered by creation date (newest first)
        $cursos = Curso::where('estado', 'publicado')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('inicio', [
            'cursos' => $cursos
        ]);
    }
}
