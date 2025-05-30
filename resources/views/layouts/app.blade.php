<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        {{-- <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-4 text-lg font-semibold border-b">My App</div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">Dashboard</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">Users</a></li>
                    <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">Settings</a></li>
                </ul>
            </nav>
        </aside> --}}

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <div class="text-xl font-semibold">@yield('title', 'Dashboard')</div>
                <div class="text-sm">Welcome, {{ Auth::user()->name ?? 'Guest' }}</div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
