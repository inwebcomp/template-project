<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" hreflang="{{ str_replace('_', '-', app()->getLocale()) }}" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @include('layout.meta')

    @yield('styles')

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="page--{{ $pageName ?? 'default' }}">
    <div id="app">
        @include('blocks.header')
        @include('blocks.sidebar-mobile')

        @yield('content')

        @include('blocks.footer')
    </div>

    @include('layout.translations')

    @yield('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
