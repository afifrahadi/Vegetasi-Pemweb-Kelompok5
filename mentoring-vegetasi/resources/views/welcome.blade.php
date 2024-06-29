<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="shortcut icon" href="{{ asset('logo-icon.svg') }}" type="image/svg+xml">

    <style>
        body {
            background: url('/assets/topographic-5.svg'), linear-gradient(271deg, #252212 3%, #0C1B0E);
            background-blend-mode: overlay;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }

        @media (max-width: 767.9px) {
            img.cover {
                max-height: 200px !important;
            }
        }
    </style>

</head>

<body>
    <div class="container-fluid h-100">
        <div class="row align-items-stretch h-100">
            <div class="col-md-8 col-xl-9 order-2 order-md-2">
                <div class="d-flex flex-column row-gap-4 h-100 justify-content-center align-items-start py-5 px-md-5">
                    <h1 class="fw-bolder display-5">APLIKASI MENTORING VEGETASI</h1>
                    <p>
                        Aplikasi Monitoring Vegetasi adalah sebuah platform berbasis web yang dirancang untuk memantau
                        dan
                        mengelola data vegetasi di Indonesia, mencakup seluruh provinsi. Aplikasi ini memungkinkan
                        pengguna,
                        mulai dari pemerintah, peneliti, hingga masyarakat umum, untuk mengakses informasi terkini
                        mengenai
                        kondisi vegetasi di berbagai wilayah.
                    </p>
                    <a href="{{ route('account.login') }}" class="btn btn-lg btn-primary px-5">Login</a>
                </div>
            </div>
            <div class="col-md-4 col-xl-3 px-0 order-1 order-md-2">
                <img src="{{ asset('assets/forest.png') }}" alt="cover" class="w-100 h-100 object-fit-cover cover">
            </div>
        </div>
    </div>
</body>

</html>
