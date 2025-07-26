@extends('templates.html')

@section('title', 'Register')

@push('styles')
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>
@endpush

@section('content')
    <x-register />
@endsection


