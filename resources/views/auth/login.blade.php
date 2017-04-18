<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA - @yield('title') </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{!!mix('css/app.css')!!}" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">AAD</h1>

        </div>
        <h3>Welcome to Arsenal Admin Dashboard</h3>
        <p>
            Добро пожаловать в инструментальную панель администратора ОАО МЗ Арсенал
        </p>
        <p>Авторизуйтесь, чтобы приступить к работе</p>
        <form class="m-t" role="form" method="post" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="username" name="username" type="text" class="form-control" placeholder="Имя пользователя" value="{{ old('username') }}" required>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password"  name="password" type="password" class="form-control" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>
        </form>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <p class="m-t">
            <small>
                Frontend by <a href="https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S">Inspinia WebApp</a><br>
                Powered by <a href="https://laravel.com/">Laravel Framework</a><br>
                &copy; Dmitriy Belyakov 2016
            </small>
        </p>
    </div>
</div>

@section('scripts')
@show

</body>
</html>