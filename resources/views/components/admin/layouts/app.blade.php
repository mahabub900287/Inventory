<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding for the document -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Viewport for responsive web design -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no,viewport-fit=cover" />
    <!-- Document Title -->
    <title>{{ config('settings.site_title') !== null ? config('settings.site_title') : 'Avocado Communications' }} Admin
        ||
        {{ $title['page_title'] ?? '' }}</title>
    <!-- Meta Description -->
    <meta name="description" content="A simple HTML5 Template for new projects." />
    <!--Keyword-->
    <meta name="keywords"
        content="cryptocurrency, financial, financial company, HYIP, hyip business, HYIP,hyip website, illustration hyip" />
    <!--Author-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="ITClan" />
    <!--Favicon-->
    <link rel="icon" href="{{ asset('assets/admin/images/logo/avocado-fav.svg') }}" />
    <link rel="icon" href="{{ asset('assets/admin/images/logo/avocado-fav.svg') }}" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />

    <x-admin.includes.styles>
        <x-slot name="topStyle">
            {{ $topStyle ?? '' }}
        </x-slot>

        <x-slot name="bottomStyle">
            {{ $bottomStyle ?? '' }}
        </x-slot>
    </x-admin.includes.styles>

</head>

<body>
    <main>

        <!-- Begin page -->
        <section class="ic_student_menubar_wrapper">

            {{-- <x-admin.master> --}}

            @if (auth()->user()->type == 'admin')
                <x-admin.partials.admin_leftbar></x-admin.partials.admin_leftbar>
            @endif
            @if (auth()->user()->type == 'company')
                <x-admin.partials.company_leftbar></x-admin.partials.company_leftbar>
            @endif



            <div class="ic_home_content-wrapper">
                <x-admin.partials.topbar></x-admin.partials.topbar>
                <div class="ic-home-content" id="app">
                    <example-component></example-component>
                    @if ($slot->isNotEmpty())
                        {{ $slot ?? '' }}
                    @endif
                </div>

                <x-admin.partials.footer></x-admin.partials.footer>

            </div>
        </section>
        <x-admin.includes.scripts>
            <x-slot name="topScript">
                {{ $topScript ?? '' }}
            </x-slot>

            <x-slot name="bottomScript">
                {{ $bottomScript ?? '' }}
            </x-slot>
        </x-admin.includes.scripts>
        <x-notify.notify></x-notify.notify>
</body>

</html>
