<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>F16</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom-styles.css">
</head>
<body class="text-dark">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom">
        <h5 class="my-0 mr-md-auto font-weight-normal">F16</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="/">Apie mus</a>
            <a class="p-2 text-dark" href="/">Prisijungti</a>
        </nav>
        <a class="btn btn-outline-primary" href="/registracija">Registruotis</a>
    </div>

    <div class="container">
        @yield('main-content')
    </div>

    {{-- <script src="/bootstrap/js/bootstrap.min.js"></script> --}}
</body>
</html>

