<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-8">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">Edit Jenis Laundry</h1>
                <p class="text-gray-400">Perbarui informasi jenis laundry</p>
            </div>

            <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('laundry-types.update', $laundryType) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nama_jenis" :value="__('Nama Jenis')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="nama_jenis" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="text" name="nama_jenis" :value="old('nama_jenis', $laundryType->nama_jenis)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_jenis')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="satuan" :value="__('Satuan')" class="text-sm font-medium text-gray-300 mb-2" />
                            <x-text-input id="satuan" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="text" name="satuan" :value="old('satuan', $laundryType->satuan)" required />
                            <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="harga_per_satuan" :value="__('Harga per Satuan')" class="text-sm font-medium text-gray-300 mb-2" />
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp</span>
                                <x-text-input id="harga_per_satuan" class="block w-full pl-12 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" type="number" name="harga_per_satuan" :value="old('harga_per_satuan', $laundryType->harga_per_satuan)" required />
                            </div>
                            <x-input-error :messages="$errors->get('harga_per_satuan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('laundry-types.index') }}" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-gray-300 font-semibold rounded-xl transition-all duration-300">
                                Kembali
                            </a>
                            <button type="submit" class="group relative px-6 py-3 rounded-xl font-semibold text-white transition-all duration-300 overflow-hidden transform hover:scale-105">
                                <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                                <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                <span class="relative z-10">{{ __('Perbarui Jenis Laundry') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
