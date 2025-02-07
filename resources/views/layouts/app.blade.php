<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{--  <!-- Toastr CSS -->
        @toastr_css  --}}

        @include('layouts.css')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Stack for styles -->
        @stack('styles')

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-800">
        <x-banner />

        <div class="flex justify-center mt-2 max-w-full">
            @include('layouts.navigation-menu')
        </div>
        <!-- Page Heading -->
        <div class="flex justify-center mt-2">
            @if (isset($header))
            <header class="bg-purple-800 shadow mt-3">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-7 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        </div>
        
        {{--  <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-0 bg-gray-800">  --}}
            
        
            <!-- Page Content -->
            <main class="mt-3">
                {{ $slot }}
            </main>
       

        {{--  @stack('modals')  --}}
        @include('layouts.modals')
        @livewireScripts

        @include('layouts.js')
        <!-- Stack para scripts de js -->
        @stack('scripts')
    </body>
</html>
