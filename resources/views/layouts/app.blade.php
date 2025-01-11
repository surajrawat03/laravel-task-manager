<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:static hidden lg:block w-64 bg-gray-800 text-white h-screen z-50">
            @if(Auth::user()->isAdmin())
                @include('layouts.adminSidebar')
            @elseif(Auth::user()->isManager())
                @include('layouts.managerSidebar')
            @else
                @include('layouts.employeeSidebar')
            @endif
        </div>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-grow h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow px-4 py-4 flex items-center justify-between lg:hidden">
                <button id="menu-toggle" class="text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <h1 class="text-xl font-semibold">Dashboard</h1>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>

        <script>
            // Toggle sidebar on mobile
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            menuToggle?.addEventListener('click', () => {
                sidebar?.classList.toggle('hidden');
                overlay?.classList.toggle('hidden');
            });

            overlay?.addEventListener('click', () => {
                sidebar?.classList.add('hidden');
                overlay?.classList.add('hidden');
            });
        </script>
    </body>
</html>
