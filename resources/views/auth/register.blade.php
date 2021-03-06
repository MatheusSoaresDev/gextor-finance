<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('css/signin.css') }}" rel="stylesheet">

</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <form method="POST" action="{{ route('register') }}">
    @csrf
        <!--<img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal">Cadastre-se</h1>

        <div class="form-group" style="text-align: left;">
            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Nome e sobrenome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="validationCustom03" name="name" value="{{ old('name') }}">
                <div class="invalid-feedback">
                    @error('name'){{ $message }}@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Endereço de email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="validationCustom03" name="email" value="{{ old('email') }}">
                <div class="invalid-feedback">
                    @error('email'){{ $message }}@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Senha</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="validationCustom03" name="password" value="{{ old('password') }}">
                <div class="invalid-feedback">
                    @error('password'){{ $message }}@enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="validationCustom03" name="password_confirmation" value="{{ old('password_confirmation') }}">
                <div class="invalid-feedback">
                    @error('password_confirmation'){{ $message }}@enderror
                </div>
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
</main>

</body>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
</style>

</html>
