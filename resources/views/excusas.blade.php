@extends('templates.html')

@section('title', 'Excusas')

@section('content')
    <x-header />
    
    <div style="display: flex; justify-content: center; margin: 2.5rem 0;">
        <a href="https://jsmesa.corsajetec.com/proyecto/" target="_blank" rel="noopener noreferrer" style="text-decoration: none;">
            <button style="
                padding: 0.75rem 2.5rem;
                font-size: 1rem;
                background: #2563eb;
                color: white;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 500;
                letter-spacing: 0.5px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                transition: all 0.2s ease;
            ">
                Ir al sistema de excusas
            </button>
        </a>
    </div>

@endsection