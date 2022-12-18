<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio</title>
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/base/component.css')}}">
    <script src="{{ asset('assets/js/jquery.min.js'); }}"></script>
</head>
<body>
    <main class="main">
        @yield('content')
    </main>

    <x-site.footer />
</body>
</html>
