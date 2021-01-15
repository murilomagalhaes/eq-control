<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> @yield('title') </title>
</head>

<body>

    @include('template.nav')

    <div class="container py-4">
        <div class="mx-2">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>