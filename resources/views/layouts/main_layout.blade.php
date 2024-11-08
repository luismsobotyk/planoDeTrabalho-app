<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link href="{{ asset('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon">
    @yield('other-css-assets')
</head>
<body>
@include('layouts.nav-client')

<div class="content-wrapper">
    @yield('content')
</div>

<!-- Rodapé -->
<footer class="bg-light text-center text-muted mt-5 py-3">
    <p class="mb-0">
        © 2024 Instituto Federal do Rio Grande do Sul. Todos os direitos reservados.
    </p>
    <p>
        Desenvolvido com Bootstrap por Luis Sobotyk.
    </p>
</footer>

<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
@yield('other-js-assets')
</body>
</html>
