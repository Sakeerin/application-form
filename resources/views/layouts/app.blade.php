<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/78659597ce.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- Google Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300;400;500;600;700&family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai:wght@100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }

        input[type="file"] {
            display: none;
        }
    </style>
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
            {{-- <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <div class="text-xl font-semibold">@yield('title', 'Dashboard')</div>
                <div class="text-sm">Welcome, {{ Auth::user()->name ?? 'Guest' }}</div>
            </header> --}}

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
