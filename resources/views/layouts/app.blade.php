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
        <div class="flex min-h-screen bg-gray-200">
            @include('layouts.navigation')

            <div class="w-full">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="fixed w-full bg-white border-l-2 border-gray-200">
                        <div class="px-4 py-6 max-w-7xl">
                            <h2 class="text-xl font-semibold leading-tight text-primary">
                                {{ $header }}
                            </h2>
                        </div>
                    </header>
                @endif

                <div class="mt-20">
                    @isset($headerButtons)
                        <div class="px-8 pt-2 pb-4 mx-auto max-w-7xl">
                            <div class="flex items-center justify-end pt-2 mx-auto gap-x-3 max-w-7xl">
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
