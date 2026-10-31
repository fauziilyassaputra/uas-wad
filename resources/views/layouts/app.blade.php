<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - Random Play </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main class="page">
        @if (session('success'))
            <div class="alert alert--success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert--error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="panel">
            @yield('content')
        </div>
    </main>

</body>
</html>
