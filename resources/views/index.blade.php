<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Arsenal Admin Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{!! mix('/css/vendor.css') !!}">
        <link rel="stylesheet" href="{!! mix('/css/app.css') !!}">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="{!! mix('/js/app.js') !!}"></script>
    </body>
</html>
