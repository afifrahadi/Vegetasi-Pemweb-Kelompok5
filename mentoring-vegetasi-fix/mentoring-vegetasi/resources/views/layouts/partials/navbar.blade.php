@php
    $menus = [
        // [
        //     'label' => 'Dashboard',
        //     'route' => route('dashboard.index'),
        //     'is_active' => request()->routeIs('dashboard.index'),
        // ],
        [
            'label' => 'Wilayah',
            'route' => route('dashboard.wilayah.index'),
            'is_active' => request()->Is('dashboard/wilayah*'),
        ],
        [
            'label' => 'Vegetasi',
            'route' => route('dashboard.vegetasi.index'),
            'is_active' => request()->routeIs('dashboard.vegetasi.index'),
        ],
        [
            'label' => 'Kelas',
            'route' => route('dashboard.kelas.index'),
            'is_active' => request()->is('dashboard/kelas*'),
        ],
        [
            'label' => 'Ordo',
            'route' => route('dashboard.ordo.index'),
            'is_active' => request()->is('dashboard/ordo*'),
        ],
        [
            'label' => 'Famili',
            'route' => route('dashboard.famili.index'),
            'is_active' => request()->is('dashboard/famili*'),
        ],
        [
            'label' => 'Genus',
            'route' => route('dashboard.genus.index'),
            'is_active' => request()->is('dashboard/genus*'),
        ],
        [
            'label' => 'Spesies',
            'route' => route('dashboard.spesies.index'),
            'is_active' => request()->is('dashboard/spesies*'),
        ],
        [
            'label' => 'Peta',
            'route' => route('dashboard.peta.index'),
            'is_active' => request()->Is('dashboard/peta'),
        ],
    ];
@endphp

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand pt-0" href="{{ route('dashboard.wilayah.index') }}">
            <img src="{{ asset('logo.svg') }}" alt="logo" style="width: 100%">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link {{ $menu['is_active'] ? 'active' : '' }}"
                            {{ $menu['is_active'] ? 'aria-current="page"' : '' }}
                            href="{{ $menu['route'] }}">{{ $menu['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            {{-- TULISAN LOGOUT BIASA --}}
            {{-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Logout</a>
                </li>
            </ul> --}}

            {{-- PAKE USERNAME --}}
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome Back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.wilayah.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> Lihat Data</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('account.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
