<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="w-full">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="fixed w-full bg-white">
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endif

                <div class="mt-20">
                    @isset($headerButtons)
                        <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div class="flex items-center justify-end pt-2 mx-auto gap-x-3 max-w-7xl sm:px-2 lg:px-4">
                                {{ $headerButtons }}
                            </div>
                        </div>
                    @endisset

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
