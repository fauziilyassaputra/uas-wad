<header class="site-header">
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="brand">Random Play</a>

        <div class="nav-links">
            @auth
                @php
                    $navLinks = [
                        ['label' => 'Dashboard', 'route' => 'dashboard', 'pattern' => 'dashboard'],
                        ['label' => 'Produk', 'route' => 'produk.index', 'pattern' => 'produk.*'],
                        ['label' => 'Kategori', 'route' => 'kategori.index', 'pattern' => 'kategori.*'],
                        ['label' => 'Transaksi', 'route' => 'transaksi.index', 'pattern' => 'transaksi.*'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="nav-link{{ request()->routeIs($link['pattern']) ? ' is-active' : '' }}">
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach

                <span class="nav-user">
                    {{ auth()->user()->name }} <span class="role-tag">({{ auth()->user()->role }})</span>
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline-form">
                    @csrf
                    <button type="submit" class="btn-logout"><span>Logout</span></button>
                </form>
            @endauth

            @guest
                <div class="nav-guest-links">
                    <a href="{{ route('login') }}" class="nav-link"><span>Login</span></a>
                    <a href="{{ route('register') }}" class="btn btn--sm"><span>Registrasi</span></a>
                </div>
            @endguest
        </div>
    </nav>
</header>
