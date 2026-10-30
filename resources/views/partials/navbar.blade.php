
    <nav>
    @auth
        <a href="{{ route('produk.index') }}">Produk</a>
        <a href="{{ route('kategori.index') }}">Kategori</a>

        <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>

        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Registrasi</a>
    @endguest
    </nav>