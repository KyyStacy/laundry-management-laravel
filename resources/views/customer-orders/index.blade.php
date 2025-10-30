<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
            {{ __('Daftar Pesanan Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-purple-500/30">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">ID Pesanan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Tanggal Pemesanan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-500/10">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gradient-to-r hover:from-cyan-500/5 hover:to-purple-500/5 transition-all duration-300">
                                        <td class="px-6 py-4 text-gray-300">{{ $order->id_order }}</td>
                                        <td class="px-6 py-4 text-gray-300">{{ $order->created_at->format('d-m-Y H.i') }}</td>
                                        <td class="px-6 py-4">
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
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('customer.orders.show', $order->id_order) }}" class="text-cyan-400 hover:text-cyan-300 transition-colors duration-200 font-medium">
                                                Detail →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>