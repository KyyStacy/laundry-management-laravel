<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">Detail Pesanan</h1>
                    <p class="text-gray-400">ID Order: {{ $order->id_order }}</p>
                </div>
                <a href="{{ route('employee.orders.index') }}" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-700 text-gray-300 font-semibold rounded-xl transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Customer Info Card -->
            <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden mb-6">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Informasi Pelanggan</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">Nama Pelanggan</label>
                                <p class="text-white text-lg">{{ $order->address->name }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">Alamat</label>
                                <div class="flex items-start gap-3">
                                    <p class="text-gray-300 flex-1">{{ $order->address->alamat }}</p>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $order->address->latitude }},{{ $order->address->longitude }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-semibold rounded-lg hover:from-emerald-500 hover:to-green-500 transition-all flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Lihat Peta
                                    </a>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">WhatsApp</label>
                                <p class="text-white">{{ $order->address->whatsapp }}</p>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">Jadwal Penjemputan</label>
                                @php
                                    $startTime = strtotime($order->jadwal_penjemputan);
                                    $endTime = strtotime('+1 hour', $startTime);
                                @endphp
                                <p class="text-white text-lg">{{ date('d-m-Y H.i', $startTime) }}-{{ date('H.i', $endTime) }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">Jadwal Pengantaran</label>
                                <p class="text-white text-lg">{{ $order->jadwal_pengantaran->format('d-m-Y') }} 15.00-21.00</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-cyan-400 mb-1 block">Metode Pembayaran</label>
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                    {{ $order->metode_pembayaran }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status & Order Details Form -->
            <form action="{{ route('employee.orders.update', $order->id_order) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Status Update Card -->
                <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden mb-6">
                    <div class="p-6 sm:p-8">
                        <h2 class="text-2xl font-bold text-white mb-4">Update Status</h2>
                        <div class="max-w-md">
                            <label for="status" class="text-sm font-medium text-cyan-400 mb-2 block">Status Pesanan</label>
                            <select name="status" id="status" class="block w-full px-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all">
                                <option value="Menunggu Penjemputan" {{ $order->status == 'Menunggu Penjemputan' ? 'selected' : '' }}>Menunggu Penjemputan</option>
                                <option value="Dijemput" {{ $order->status == 'Dijemput' ? 'selected' : '' }}>Dijemput</option>
                                <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Siap Antar" {{ $order->status == 'Siap Antar' ? 'selected' : '' }}>Siap Antar</option>
                                <option value="Diantar" {{ $order->status == 'Diantar' ? 'selected' : '' }}>Diantar</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Order Details Table -->
                <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden mb-6">
                    <div class="p-6 sm:p-8">
                        <h2 class="text-2xl font-bold text-white mb-6">Detail Laundry</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-white/10">
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jenis Laundry</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @php $totalHarga = 0; @endphp
                                    @foreach($order->orderDetails as $detail)
                                        <tr class="hover:bg-white/5 transition-colors duration-200">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-white">{{ $detail->jenis_laundry }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if(strpos($detail->jenis_laundry, 'Pakaian') !== false)
                                                    <div class="flex items-center gap-2">
                                                        <input type="number" name="weights[{{ $detail->id }}]" value="{{ $detail->jumlah }}" step="0.1" min="0" class="w-24 px-3 py-2 bg-slate-900/50 border border-white/10 rounded-lg text-white focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all">
                                                        <span class="text-gray-400">Kg</span>
                                                    </div>
                                                @else
                                                    <div class="text-sm text-gray-300">{{ $detail->jumlah }} {{ $laundryTypes->firstWhere('nama_jenis', $detail->jenis_laundry)->satuan ?? '' }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-white">Rp {{ number_format($detail->harga, 0, ',', '.') }}</div>
                                            </td>
                                        </tr>
                                        @php $totalHarga += $detail->harga; @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-t border-white/20">
                                        <td colspan="2" class="px-6 py-4 text-right font-bold text-cyan-400 text-lg">Total Harga:</td>
                                        <td class="px-6 py-4">
                                            <div class="text-xl font-bold text-white">Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="group relative px-8 py-4 rounded-xl font-semibold text-white transition-all duration-300 overflow-hidden transform hover:scale-105">
                        <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                        <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
