<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>F16</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script type="text/javascript" src="/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="/select2/css/select2.min.css">
    <script type="text/javascript" src="/select2/js/select2.full.min.js"></script>

    <link rel="stylesheet" href="/css/custom-styles.css">
    <script type="text/javascript" src="/js/client-frontend.js"></script>
</head>
<body class="text-dark">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom">
        <h5 class="my-0 mr-md-auto font-weight-normal">F16</h5>
        @auth
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="{{ route('orders.index') }}">Mano užsakymai</a>
                <a class="p-2 text-dark" href="#">Mano profilis</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-primary">Atsijungti</button>
            </form>
        @endauth
        @guest
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/">Apie mus</a>
                <a class="p-2 text-dark" href="/">Prisijungti</a>
            </nav>
            <a class="btn btn-outline-primary" href="/registracija">Registruotis</a>
        @endguest
    </div>

    <div class="container">
        @yield('main-content')
    </div>

    {{-- <script src="/bootstrap/js/bootstrap.min.js"></script> --}}
</body>
</html>
