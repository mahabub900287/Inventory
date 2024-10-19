<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding for the document -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Viewport for responsive web design -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no,viewport-fit=cover" />
    <!-- Document Title -->
    <title>Avocado</title>
    <!-- Meta Description -->
    <meta name="description" content="A simple HTML5 Template for new projects." />
    <!--Keyword-->
    <meta name="keywords"
        content="cryptocurrency, financial, financial company, HYIP, hyip business, HYIP,hyip website, illustration hyip" />
    <!--Author-->
    <meta name="author" content="ITClan" />
    <!--Favicon-->
    <link rel="icon" href="{{ asset('assets/admin') }}/images/logo/avocado-fav.svg" />
    <link rel="icon" href="{{ asset('assets/admin') }}/images/logo/avocado-fav.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    @include('front.partials._head')

</head>

<body>
    <main>
        {{-- <div class="ic-loading">
            <span class="loader"></span>
        </div> --}}
        <div id="app">
            @include('front.partials._header')
            <!--Main Start-->
            <main id="wrapper">
                @yield('content')
            </main>
            <!--Main End-->
            <!---Footer Area Start-->
            @include('front.partials._footer')
            <!---Footer Area End-->
        </div>
        @include('front.partials._footerScript')
        <x-notify.notify></x-notify.notify>
</body>

</html>
