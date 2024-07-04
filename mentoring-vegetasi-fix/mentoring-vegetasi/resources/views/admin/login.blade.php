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
                <form action="{{ route('admin.authenticate') }}" method="POST">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset('logo-icon-color.svg') }}" alt="logo icon">
                        <h1>Masuk</h1>
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <p class="text-secondary">Isi form sesuai dengan akun yang telah dibuat</p>
                    </div>
                    <div class="mt-4">
                        <input type="text" name="email" value="{{ old('email')}}" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Email">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg mt-4 w-100">Masuk</button>
                </form>
                {{-- <div class="d-flex justify-content-center mt-3">
                    <span class="text-subtitle">Belum memiliki akun?</span>
                    <a href="#" class="link-primary fw-semibold ml-1">Daftar</a>
                </div> --}}
            </div>
        </div>
    </div>
</body>

</html>
