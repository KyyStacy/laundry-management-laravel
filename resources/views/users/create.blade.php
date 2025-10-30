<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-8">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">Tambah Pengguna Baru</h1>
                <p class="text-gray-400">Isi formulir untuk menambahkan pengguna baru</p>
            </div>

            <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="name" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="text" name="name" :value="old('name')" placeholder="Masukkan nama lengkap" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="email" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="email" name="email" :value="old('email')" placeholder="nama@email.com" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Peran')" class="text-sm font-medium text-gray-300 mb-2" />
                            <select id="role" name="role" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" required>
                                <option value="" disabled selected>Pilih Peran</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="pelanggan">Pelanggan</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="password" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="password" name="password" placeholder="Min. 8 karakter" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="password_confirmation" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-gray-300 font-semibold rounded-xl transition-all duration-300">
                                Kembali
                            </a>
                            <button type="submit" class="group relative px-6 py-3 rounded-xl font-semibold text-white transition-all duration-300 overflow-hidden transform hover:scale-105">
                                <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                                <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                <span class="relative z-10">{{ __('Tambah Pengguna') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>