<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
            {{ __('Detail Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/30 text-green-400 px-6 py-4 rounded-lg" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Order Info Card -->
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl p-6 hover:border-purple-500/40 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">ID Pesanan</p>
                        <p class="text-gray-200 font-bold text-lg">{{ $order->id_order }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Status</p>
                        @php
                            $statusColors = [
                                'Menunggu Konfirmasi' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'Dikonfirmasi' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                'Dijemput' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                'Diproses' => 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30',
                                'Diantar' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                'Selesai' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                'Menunggu Pembayaran' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                'Gagal' => 'bg-red-500/20 text-red-400 border-red-500/30',
                            ];
                            $statusClass = $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-400 border-gray-500/30';
                        @endphp
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClass }}">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Pelanggan</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">WhatsApp</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->whatsapp }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-400 text-sm mb-1">Alamat</p>
                        <p class="text-gray-200 font-medium">{{ $order->address->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Jadwal Penjemputan</p>
                        @php
                            $startTime = strtotime($order->jadwal_penjemputan);
                            $endTime = strtotime('+1 hour', $startTime);
                        @endphp
                        <p class="text-gray-200 font-medium">{{ date('d-m-Y H.i', $startTime) }}-{{ date('H.i', $endTime) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Jadwal Pengantaran</p>
                        <p class="text-gray-200 font-medium">{{ $order->jadwal_pengantaran->format('d-m-Y') }} <span class="text-gray-500 text-sm">(15.00-21.00)</span></p>
                    </div>
                </div>
            </div>

            <!-- Order Details Card -->
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-4">Detail Laundry</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-purple-500/30">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jenis Laundry</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-500/10">
                                @php 
                                    $total = 0;
                                    $hasPakaianBelumDitimbang = false;
                                @endphp
                                @foreach ($order->orderDetails as $detail)
                                    <tr class="hover:bg-gradient-to-r hover:from-cyan-500/5 hover:to-purple-500/5 transition-all duration-300">
                                        <td class="px-6 py-4">
                                            <span class="text-gray-200 font-medium">{{ $detail->jenis_laundry }}</span>
                                            @if (in_array($detail->jenis_laundry, ['Pakaian Reguler', 'Pakaian Ekspress']))
                                                @if ($detail->jumlah == 0)
                                                    <br><span class="text-sm text-yellow-400">Akan ditimbang saat penjemputan</span>
                                                    @php $hasPakaianBelumDitimbang = true; @endphp
                                                @else
                                                    <br><span class="text-sm text-green-400">✓ Sudah ditimbang</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-300">
                                            @if (in_array($detail->jenis_laundry, ['Pakaian Reguler', 'Pakaian Ekspress']) && $detail->jumlah == 0)
                                                <span class="text-gray-500">-</span>
                                            @else
                                                {{ $detail->jumlah }} kg
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-300">
                                            @if (in_array($detail->jenis_laundry, ['Pakaian Reguler', 'Pakaian Ekspress']) && $detail->jumlah == 0)
                                                <span class="text-gray-500">-</span>
                                            @else
                                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                            @endif
                                            @php $total += $detail->harga; @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-t border-purple-500/30">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-right font-bold text-cyan-400">Total:</td>
                                    <td class="px-6 py-4 font-bold text-green-400">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    @if ($hasPakaianBelumDitimbang)
                        <div class="mt-4 p-3 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                            <p class="text-sm text-yellow-400 italic">
                                * Total harga belum termasuk pakaian yang belum ditimbang. Harga akan diperbarui setelah penimbangan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>