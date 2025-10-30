<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">Data Pesanan</h1>
                <p class="text-gray-400">Kelola dan pantau pesanan laundry</p>
            </div>

            <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">ID Order</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jadwal Penjemputan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Jadwal Pengantaran</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-white/5 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-white">{{ $order->id_order }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-white">{{ $order->address->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $startTime = strtotime($order->jadwal_penjemputan);
                                                $endTime = strtotime('+1 hour', $startTime);
                                            @endphp
                                            <div class="text-sm text-gray-300">{{ date('d-m-Y H.i', $startTime) }}-{{ date('H.i', $endTime) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-300">{{ $order->jadwal_pengantaran->format('d-m-Y') }} 15.00-21.00</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusColors = [
                                                    'Menunggu Penjemputan' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                                    'Dijemput' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                                    'Diproses' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                                    'Siap Antar' => 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30',
                                                    'Diantar' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                                    'Selesai' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                                ];
                                                $colorClass = $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-400 border-gray-500/30';
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $colorClass }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('employee.orders.show', $order->id_order) }}" class="text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
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
