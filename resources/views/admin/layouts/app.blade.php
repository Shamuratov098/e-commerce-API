<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @yield('styles')
    <style>
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            transition: all 0.2s;
            gap: 10px;
        }
        .sidebar-link:hover {
            background-color: #f3f4f6;
            color: #111827;
        }
        .sidebar-link.active {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        .sidebar-link.active svg {
            color: #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md flex flex-col" style="min-height: 100vh;">

        <!-- Logo -->
        <div class="flex items-center px-6 py-5 border-b border-gray-200">
            <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="ml-3 text-lg font-bold text-gray-800">Admin Panel</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <!-- Categories -->
            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Kategoriyalar
            </a>

            <!-- Brands -->
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Brendlar
            </a>

            <!-- Products -->
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Mahsulotlar
            </a>

            <!-- Orders -->
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Buyurtmalar
            </a>

            <!-- Users -->
            <a href="#"
               class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Foydalanuvchilar
            </a>

        </nav>

        <!-- User Info + Logout -->
        <div class="px-4 py-4 border-t border-gray-200">
            <div class="flex items-center mb-3">
                <div class="w-9 h-9 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Chiqish
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Header -->
        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
            <span class="text-sm text-gray-500">{{ now()->format('d.m.Y') }}</span>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mx-8 mt-4 flash-message">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-8 mt-4 flash-message">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-1 px-8 py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="px-8 py-4 border-t border-gray-200 bg-white">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} {{ config('app.name') }}. Barcha huquqlar himoyalangan.</p>
        </footer>

    </div>
</div>

@yield('scripts')
</body>
</html>
