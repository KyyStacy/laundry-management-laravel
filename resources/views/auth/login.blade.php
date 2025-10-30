<x-guest-layout>
    <div class="p-8 space-y-6">
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">
                Selamat Datang Kembali
            </h2>
            <p class="text-gray-400 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Alamat Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-300 mb-2" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-text-input id="email" 
                        class="block w-full pl-10 pr-3 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all duration-300" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="nama@email.com"
                        required 
                        autofocus 
                        autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Kata Sandi -->
            <div>
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-sm font-medium text-gray-300 mb-2" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-text-input id="password" 
                        class="block w-full pl-10 pr-3 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all duration-300"
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required 
                        autocomplete="current-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Ingat Saya & Lupa Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-slate-900/50 text-cyan-500 focus:ring-2 focus:ring-cyan-500/20 focus:ring-offset-0 transition-all" name="remember">
                    <span class="ml-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 rounded-xl font-semibold text-white transition-all duration-300 overflow-hidden transform hover:scale-[1.02] active:scale-[0.98]">
                    <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                    <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <span class="relative z-10 flex items-center gap-2">
                        {{ __('Masuk') }}
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative my-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-gradient-to-br from-slate-800/90 to-slate-900/90 text-gray-500">atau</span>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-sm text-gray-400">
                {{ __("Belum punya akun?") }}
                <a href="{{ route('register') }}" class="font-semibold text-transparent bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text hover:from-cyan-300 hover:to-purple-300 transition-all">
                    {{ __('Daftar Sekarang') }}
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>