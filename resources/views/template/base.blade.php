<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> @yield('title') </title>
</head>

<body>

    @auth
    @include('template.nav')
    @endauth

    @yield('login')

    <div class="container py-4">
        <div class="mx-2">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')

</body>

</html>