<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Select2/dist/css/select2.min.css') }}">
    @yield('css')
    <!-- Styles -->
    @laravelPWA
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <x-notify::notify />
 <!-- DataTables JS  y jquery 3.7 -->

    <script type="text/javascript" src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Select2/dist/js/select2.min.js') }}"></script>

    @notifyJs
    @stack('modals')
    @include('notify::components.notify')
    @livewireScripts
    <script src="{{ asset('plugins/sweetalert2/sweetalert2@11.js') }}"></script>
    @yield('js')
</body>

</html>
