<nav x-data="{ open: false }" class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 backdrop-blur-md bg-opacity-95 shadow-lg fixed w-full z-50 transition-all duration-300 ease-in-out border-b border-purple-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-lg blur-sm opacity-75 group-hover:opacity-100 transition-opacity"></div>
                            <img src="https://www.svgrepo.com/show/195928/laundry.svg" alt="Reed Code Laundry Logo" class="h-10 w-10 relative z-10 transform group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Reed Code</span>
                            <span class="text-xs text-gray-400 -mt-1">Laundry</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="relative px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-cyan-400' : 'text-gray-300 hover:text-cyan-400' }} transition-all duration-300 ease-in-out group">
                        <span class="relative z-10">Dashboard</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 rounded-lg opacity-0 group-hover:opacity-100 {{ request()->routeIs('dashboard') ? 'opacity-100' : '' }} transition-opacity"></span>
                    </a>
                    @role('admin')
                        <a href="{{ route('users.index') }}" class="relative px-4 py-2 text-sm font-medium {{ request()->routeIs('users.*') ? 'text-cyan-400' : 'text-gray-300 hover:text-cyan-400' }} transition-all duration-300 ease-in-out group">
                            <span class="relative z-10">Pengguna</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 rounded-lg opacity-0 group-hover:opacity-100 {{ request()->routeIs('users.*') ? 'opacity-100' : '' }} transition-opacity"></span>
                        </a>
                        <a href="{{ route('laundry-types.index') }}" class="relative px-4 py-2 text-sm font-medium {{ request()->routeIs('laundry-types.*') ? 'text-cyan-400' : 'text-gray-300 hover:text-cyan-400' }} transition-all duration-300 ease-in-out group">
                            <span class="relative z-10">Jenis Laundry</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 rounded-lg opacity-0 group-hover:opacity-100 {{ request()->routeIs('laundry-types.*') ? 'opacity-100' : '' }} transition-opacity"></span>
                        </a>
                    @endrole
                    <a href="{{ route('employee.orders.index') }}" class="relative px-4 py-2 text-sm font-medium {{ request()->routeIs('employee.orders.*') ? 'text-cyan-400' : 'text-gray-300 hover:text-cyan-400' }} transition-all duration-300 ease-in-out group">
                        <span class="relative z-10">Data Pesanan</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 rounded-lg opacity-0 group-hover:opacity-100 {{ request()->routeIs('employee.orders.*') ? 'opacity-100' : '' }} transition-opacity"></span>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-gradient-to-r from-slate-800 to-slate-700 border border-purple-500/30 text-sm font-medium text-gray-300 hover:text-cyan-400 hover:border-purple-500/50 focus:outline-none transition-all duration-300 ease-in-out">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-cyan-400 hover:bg-slate-800/50 focus:outline-none focus:bg-slate-800/50 focus:text-cyan-400 transition duration-300 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gradient-to-b from-slate-900 to-slate-800 border-t border-purple-500/20">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @role('admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                    {{ __('Pengguna') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('laundry-types.index')" :active="request()->routeIs('laundry-types.*')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                    {{ __('Jenis Laundry') }}
                </x-responsive-nav-link>
            @endrole
            <x-responsive-nav-link :href="route('employee.orders.index')" :active="request()->routeIs('employee.orders.*')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                {{ __('Data Pesanan') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-purple-500/20">
            <div class="px-4">
                <div class="font-medium text-base text-gray-300">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-gray-300 hover:text-cyan-400 hover:bg-slate-800/50 rounded-lg">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>