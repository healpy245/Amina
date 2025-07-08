<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/@heroicons/vue@2.0.18/24/outline/index.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            // Simple theme toggle
            function toggleTheme() {
                const html = document.documentElement;
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
            document.addEventListener('DOMContentLoaded', () => {
                if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            });
            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('-translate-x-full');
                document.getElementById('sidebar').classList.toggle('md:w-64');
                document.getElementById('sidebar').classList.toggle('md:w-20');
                document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
                document.body.classList.toggle('sidebar-collapsed');
            }
        </script>
        <style>
            .sidebar-collapsed nav span,
            .sidebar-collapsed nav div,
            .sidebar-collapsed nav a span {
                display: none !important;
            }
            .sidebar-collapsed nav a {
                justify-content: center !important;
            }
            .sidebar-collapsed .sidebar-footer-text {
                display: none !important;
            }
            /* Make main content go wider when sidebar is collapsed */
            body.sidebar-collapsed .main-content {
                margin-left: 5rem !important; /* md:w-20 = 5rem */
            }
            @media (max-width: 767px) {
                body.sidebar-collapsed .main-content {
                    margin-left: 0 !important;
                }
            }
            /* Smooth transition for main content margin */
            .main-content {
                transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar-collapsed .sidebar-brand {
                display: none !important;
            }
            html, body, * {
                font-family: 'Tajawal', 'Cairo', 'Noto Kufi Arabic', 'Amiri', 'Arial', 'sans-serif' !important;
            }
        </style>
        <style>
        html.dark .select2-container--default .select2-selection--single,
        html.dark .select2-container--default .select2-selection--multiple {
            background-color: #222 !important;
            color: #fff !important;
            border-color: #444 !important;
        }
        html.dark .select2-container--default .select2-selection--single .select2-selection__rendered,
        html.dark .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            color: #fff !important;
        }
        html.dark .select2-container--default .select2-selection--single .select2-selection__arrow {
            color: #fff !important;
        }
        html.dark .select2-dropdown {
            background-color: #222 !important;
            color: #fff !important;
            border-color: #444 !important;
        }
        html.dark .select2-results__option {
            background-color: #222 !important;
            color: #fff !important;
        }
        html.dark .select2-results__option--highlighted {
            background-color: #333 !important;
            color: #fff !important;
        }
        html.dark .select2-search__field {
            background: #222 !important;
            color: #fff !important;
            border-color: #444 !important;
        }
        html.dark .select2-container--default .select2-selection--single:focus,
        html.dark .select2-container--default .select2-selection--multiple:focus {
            border-color: #888 !important;
            box-shadow: 0 0 0 1px #888 !important;
        }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased bg-cream-100 dark:bg-neutral-900">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside id="sidebar" class="md:w-64 w-64 h-screen fixed bg-boutique-900 dark:bg-neutral-900 text-white shadow-2xl flex flex-col justify-between z-30 transform transition-all duration-300 ease-in-out -translate-x-full md:translate-x-0 backdrop-blur-xl bg-opacity-90 border-r border-boutique-800 dark:border-neutral-700">
                <div>
                    <div class="h-16 flex items-center justify-between border-b border-boutique-700 dark:border-neutral-700 px-4">
                        <div class="flex items-center gap-2">
                            <span class="flex items-center gap-2 text-xl font-extrabold tracking-tight sidebar-brand text-boutique-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <rect x="3" y="6" width="18" height="12" rx="3" stroke="currentColor" stroke-width="2.2" fill="none"/>
                                    <path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                                    <circle cx="18" cy="8" r="1.2" fill="currentColor"/>
                                    <polyline points="17,7 18,8 19,6.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="font-extrabold text-xl text-boutique-400">Aminaapp</span>
                            </span>
                            <button class="md:block hidden p-2 rounded hover:bg-boutique-700/40 text-white transition ml-auto" onclick="toggleSidebar()" title="Collapse sidebar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <nav class="flex-1 px-4 py-6 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold shadow hover:from-boutique-600 hover:to-boutique-700 {{ request()->routeIs('dashboard') ? 'ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 12.75L12 4.5l9.75 8.25M4.5 10.5V19.5A1.5 1.5 0 006 21h3.75v-4.5h4.5V21H18a1.5 1.5 0 001.5-1.5V10.5" />
                            </svg>
                            <span>لوحة التحكم</span>
                        </a>
                        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('categories.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                            <span>الفئات</span>
                        </a>
                        <a href="{{ route('dresses.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('dresses.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 9a2 2 0 01-2 2H6a2 2 0 01-2-2l1-9z" /></svg>
                            <span>الفساتين</span>
                        </a>
                        <a href="{{ route('clients.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('clients.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>الزبائن</span>
                        </a>
                        <a href="{{ route('appointments.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('appointments.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span>المواعيد</span>
                        </a>
                        <a href="{{ route('contracts.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('contracts.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 3.75A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 13h4" />
                            </svg>
                            <span>العقود</span>
                        </a>
                        <a href="{{ route('payments.index') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('payments.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" viewBox="0 0 24 24">
                                <text x="2" y="18" font-size="18" font-family="Arial, sans-serif" fill="currentColor">₪</text>
                            </svg>
                            <span>المدفوعات</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition bg-boutique-800 hover:bg-boutique-700 text-white font-semibold {{ request()->routeIs('profile.*') ? 'bg-boutique-700 text-white font-semibold ring-2 ring-boutique-400' : '' }}">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>الملف الشخصي</span>
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-boutique-700 dark:border-neutral-700 flex flex-col gap-2">
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="group relative w-full flex items-center justify-center gap-3 px-6 py-3 bg-gradient-to-r from-boutique-800 via-boutique-700 to-boutique-800 hover:from-burgundy-600 hover:via-burgundy-700 hover:to-burgundy-800 text-white rounded-2xl font-bold shadow-2xl ring-2 ring-boutique-600/50 hover:ring-burgundy-500/60 transition-all duration-500 transform hover:scale-105 hover:-translate-y-1 overflow-hidden sidebar-footer-text">
                            <div class="absolute inset-0 bg-gradient-to-r from-burgundy-500/20 to-burgundy-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <svg class="h-5 w-5 relative z-10 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                            <span class="relative z-10 font-extrabold tracking-wide">تسجيل الخروج</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                        <button type="submit"
                            class="hidden sidebar-collapsed:block w-full flex items-center justify-center p-0 m-0 bg-transparent text-white rounded-2xl transition-all duration-500"
                            title="تسجيل الخروج">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </aside>
            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen bg-gradient-to-br from-cream-50 via-cream-100 to-cream-200 dark:from-neutral-950 dark:via-neutral-900 dark:to-neutral-800 transition-colors duration-300 md:ml-64 main-content">
                <!-- Topbar -->
                <header class="h-24 bg-boutique-900 dark:bg-neutral-900 text-white shadow-lg flex items-center justify-between px-8 sticky top-0 z-20 backdrop-blur-xl bg-opacity-90 border-b border-boutique-800 dark:border-neutral-700">
                    <div class="flex items-center gap-4 flex-1">
                        <!-- Hamburger menu -->
                        <button class="md:hidden block p-2 rounded hover:bg-boutique-700/40 text-white transition mr-2" onclick="toggleSidebar()" title="Toggle sidebar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <nav class="flex items-center gap-1 text-sm font-semibold text-neutral-400 dark:text-neutral-400 bg-white/10 dark:bg-neutral-900/20 px-3 py-1 rounded-xl shadow-sm ml-2" aria-label="Breadcrumb">
                            @php
                                $segments = collect(request()->segments());
                                $url = url('/');
                                $arMap = [
                                    'dashboard' => 'لوحة التحكم',
                                    'categories' => 'الفئات',
                                    'dresses' => 'الفساتين',
                                    'clients' => 'الزبائن',
                                    'appointments' => 'المواعيد',
                                    'contracts' => 'العقود',
                                    'payments' => 'المدفوعات',
                                    'profile' => 'الملف الشخصي',
                                    'edit' => 'تعديل',
                                    'create' => 'إضافة',
                                    'register' => 'تسجيل',
                                    'login' => 'تسجيل الدخول',
                                    'reset-password' => 'إعادة تعيين كلمة المرور',
                                    'verify-email' => 'تأكيد البريد',
                                ];
                            @endphp
                            <a href="{{ route('dashboard') }}" class="hover:underline hover:text-neutral-500 transition">الرئيسية</a>
                            @foreach ($segments as $index => $segment)
                                <span class="mx-1">/</span>
                                @php
                                    $url .= '/' . $segment;
                                    $isLast = $index === $segments->count() - 1;
                                    $label = $arMap[$segment] ?? __(str_replace('-', ' ', $segment));
                                @endphp
                                @if (!$isLast)
                                    <a href="{{ $url }}" class="hover:underline hover:text-gray-500 transition">{{ $label }}</a>
                                @else
                                    <span class="text-gray-600 dark:text-gray-200">{{ $label }}</span>
                                @endif
                            @endforeach
                        </nav>
                        @isset($header)
                            <span class="ml-6 text-lg font-semibold text-blue-100 dark:text-blue-300 bg-white/10 dark:bg-gray-900/20 px-4 py-1 rounded-xl shadow-sm">{{ $header }}</span>
                        @endisset
                    </div>
                    <div class="flex-1 flex justify-center">
                        <img src="/logo2.png" alt="Logo" class="h-20 w-auto" />
                    </div>
                    <div class="flex-1"></div>
                    <div class="flex items-center space-x-4">
                        <button onclick="toggleTheme()" class="p-2 rounded bg-blue-100 dark:bg-gray-700 text-blue-800 dark:text-yellow-300 flex items-center gap-2 font-bold transition" title="تبديل الوضع الليلي/النهاري">
                            <span id="theme-icon">
                                <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2"/>
                                    <path stroke="currentColor" stroke-width="2" d="M12 1v2m0 18v2m11-11h-2M3 12H1m16.95 7.07l-1.41-1.41M6.34 6.34L4.93 4.93m12.02 0l-1.41 1.41M6.34 17.66l-1.41 1.41"/>
                                </svg>
                                <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                                </svg>
                            </span>
                        </button>
                        <script>
                            function updateThemeIcon() {
                                const isDark = document.documentElement.classList.contains('dark');
                                document.getElementById('sun-icon').style.display = isDark ? 'inline' : 'none';
                                document.getElementById('moon-icon').style.display = isDark ? 'none' : 'inline';
                            }
                            document.addEventListener('DOMContentLoaded', updateThemeIcon);
                            document.addEventListener('DOMContentLoaded', () => {
                                document.querySelector('[onclick="toggleTheme()"]')?.addEventListener('click', () => {
                                    setTimeout(updateThemeIcon, 10);
                                });
                            });
                        </script>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @keydown.escape="open = false" class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-600 flex items-center justify-center text-blue-800 dark:text-gray-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded shadow-lg py-2 z-30 transition-all duration-200" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-blue-100 dark:hover:bg-blue-900">الملف الشخصي</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900">تسجيل الخروج</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main Content Area -->
                <main class="flex-1 p-6 transition-colors duration-300">
                    @yield('content')
                </main>
            </div>
        </div>
        <span>Current locale: {{ app()->getLocale() }}</span>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @stack('scripts')
    </body>
</html>
