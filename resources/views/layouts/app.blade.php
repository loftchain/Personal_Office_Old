<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Imigize') }}</title>
    <!-- Styles -->
    @include('layouts.links')
</head>
<body>
<div id="app">

    @include('layouts.header')
    @include('home.new_dashboard')
    @yield('content')
    @include('layouts.footer')


</div>

@include('layouts.scripts')

@yield('script')


</body>
</html>
