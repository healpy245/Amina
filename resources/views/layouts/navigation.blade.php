<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />

                    </a>
                    
                </div>
                

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        لوحة التحكم
                    </x-nav-link>
                </div>
                
            </div>
            

            <!-- Language Switcher -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form action="" method="get" id="lang-switcher-form" class="me-2">
                    <select onchange="window.location.href='/lang/' + this.value" class="rounded-md border-gray-300 dark:bg-gray-800 dark:text-gray-200">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>الإنجليزية</option>
                        <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="he" {{ app()->getLocale() == 'he' ? 'selected' : '' }}>العبرية</option>
                    </select>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                لوحة التحكم
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Language Switcher -->
        <div class="px-4 pb-3">
            <form action="" method="get" id="lang-switcher-form-mobile">
                <select onchange="window.location.href='/lang/' + this.value" class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:text-gray-200">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>الإنجليزية</option>
                    <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                    <option value="he" {{ app()->getLocale() == 'he' ? 'selected' : '' }}>العبرية</option>
                </select>
            </form>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
        
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    الملف الشخصي
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        تسجيل الخروج
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
