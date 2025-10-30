<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent mb-2">Manajemen Pengguna</h1>
                <p class="text-gray-400">Kelola data pengguna sistem</p>
            </div>

            <div class="relative group bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <!-- Action Bar -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                            <a href="{{ route('users.create') }}" class="group relative px-6 py-3 rounded-xl font-semibold text-white transition-all duration-300 overflow-hidden transform hover:scale-105 flex items-center justify-center">
                                <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                                <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                <span class="relative z-10 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tambah Pengguna
                                </span>
                            </a>
                            <form method="GET" action="{{ route('users.index') }}" class="flex w-full md:w-auto">
                                <input type="text" name="search" placeholder="Cari pengguna..." class="w-full md:w-64 px-4 py-3 bg-slate-900/50 border border-white/10 rounded-l-xl text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" value="{{ request('search') }}">
                                <button type="submit" class="px-5 bg-gradient-to-r from-cyan-500 to-purple-500 text-white rounded-r-xl hover:from-purple-500 hover:to-cyan-500 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Peran</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-cyan-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body" class="divide-y divide-white/5">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-white/5 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-cyan-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->role === 'admin' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30' : '' }}
                                                {{ $user->role === 'karyawan' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : '' }}
                                                {{ $user->role === 'pelanggan' ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : '' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4" id="status-{{ $user->id }}">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500/20 text-gray-400 border border-gray-500/30">
                                                Memuat...
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('users.edit', $user) }}" class="text-cyan-400 hover:text-cyan-300 transition-colors" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
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

    <script>
        function updateUserStatus(userId, isOnline) {
            const statusElement = document.getElementById(`status-${userId}`);
            if (statusElement) {
                statusElement.innerHTML = isOnline
                    ? '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">Online</span>'
                    : '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500/20 text-gray-400 border border-gray-500/30">Offline</span>';
            }
        }

        function fetchUserStatuses() {
            fetch('{{ route("users.statuses") }}')
                .then(response => response.json())
                .then(data => {
                    data.forEach(user => {
                        updateUserStatus(user.id, user.is_online);
                    });
                });
        }

        // Initial fetch
        fetchUserStatuses();

        // Set up polling
        setInterval(fetchUserStatuses, 5000);

        // Initialize Feather Icons
        feather.replace();
    </script>
</x-app-layout>