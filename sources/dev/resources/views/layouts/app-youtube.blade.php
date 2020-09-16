<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('HQ Tool - Tự động hóa công việc') }}</title>
    <link rel="icon" type="image/png/ico" href="/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    @yield('styles')
    </head>
    <body class="{{ $class ?? '' }}" data-id="{{Auth::user()->id}}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth-youtube')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        
        <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="{{ mix('js/app.js') }}"></script> -->
        @yield('scripts')
        @stack('js')
    </body>
</html>