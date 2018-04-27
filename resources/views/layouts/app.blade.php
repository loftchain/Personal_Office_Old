<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'ShowRoom') }}</title>
        @include('layouts.links')
    </head>
    <body>
    @include('layouts.cloak')
        <div id=x-app">
            @include('layouts.header')
            @yield('content')
            @include('layouts.footer')
        </div>
        @include('layouts.scripts')
        @yield('script')
        @stack('scripts')
    </body>
</html>
