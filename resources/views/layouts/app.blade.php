<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Toko</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; }
        nav { background: #333; color: white; padding: 1rem; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
        .container { padding: 20px; }
    </style>
</head>
<body>

    <nav>
        <a href="/">Beranda</a>
        <a href="/produk">Daftar Produk</a>
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>