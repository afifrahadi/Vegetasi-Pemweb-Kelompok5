<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login &mdash; {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="shortcut icon" href="{{ asset('logo-icon.svg') }}" type="image/svg+xml">

    <style>
        body {
            background: url('/assets/topographic-4.svg'), #fafafa;
            background-blend-mode: color-burn;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center py-5" style="min-height: 100vh">
        <div class="card p-5 w-100" style="max-width: 500px;">
            <div class="card-body">
                <form action="{{ route('account.processRegister') }}" method="POST">
                    @csrf
                    <div class="d-flex flex-column justify-content-between align-items-stretch row-gap-5">
                        <div class="text-center">
                            <img src="{{ asset('logo-icon-color.svg') }}" alt="logo icon">
                            <h1>Daftar</h1>
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif
                            <p class="text-secondary">Isi form sesuai informasi Anda</p>
                        </div>
                        <div class="d-flex flex-column row-gap-3">
                            <input type="text" name="name" id="name" class="form-control form-control-lg"
                                placeholder="Masukkan Username Anda">
                            <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Masukkan email Anda">
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="Buat password">
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" value=""
                                placeholder="Ulangi password">
                            {{-- <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control form-control-lg" placeholder="Konfirmasi password"> --}}
                            <button type="submit" class="btn btn-primary btn-lg mt-3">Buat Akun</button>
                        </div>
                        <span class="d-flex gap-2 justify-content-center">
                            <p class="text-subtitle">Belum memiliki akun?</p>
                            <a href="{{ route('account.login') }}" class="link-primary fw-semibold ">Masuk</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
