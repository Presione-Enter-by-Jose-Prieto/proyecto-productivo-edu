@extends('templates.html')

@section('title', 'Login')

@push('styles')
    <style>
        body {
            background-color: #0d1117;
            color: #e6eefa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <x-login />
@endsection
