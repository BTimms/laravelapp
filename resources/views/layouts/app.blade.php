<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name', 'LARAVELAPP')}}</title>
    <style>
        .navbar-bg {
            background: #0c9af9;
            padding: 40px;
        }

        footer {
            background: #d9d9d9;
            padding: 30px;
        }
    </style>

</head>
<body class="antialiased">
@include('inc.navbar')
<div class="container">
    @include('inc.messages')
    @yield('content')
</div>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@include('inc.footer')
</body>
</html>

