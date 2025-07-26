<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>@yield('title')</title>
    @stack('styles')
    @stack('scripts')
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #e6eefa;
            min-height: 100vh;
        }
        
        main.contenedor {
            flex: 1;
            padding: 5px 20px 20px 20px;
            min-height: 99.3vh;
            background-color: #0d1117;
            transition: margin-left 0.3s ease;
            box-sizing: border-box;
            margin-bottom: 5px;
            margin-left: 226px;
            margin-right: 5px;
        }
        
        @media (max-width: 768px) {
            main.contenedor {
                margin-left: 0;
                padding: 70px 15px 15px;
            }
        }
    </style>
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/form-reset.js') }}"></script>
</body>
</html>