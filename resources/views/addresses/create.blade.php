<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
            {{ __('Tambah Alamat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-md shadow-xl border border-purple-500/20 rounded-xl p-8">
                <form action="{{ route('addresses.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Nama
                            </span>
                        </label>
                        <input type="text" name="name" id="name" 
                            class="w-full bg-slate-900/50 border-2 border-purple-500/30 text-gray-100 placeholder-gray-500 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3 transition-all duration-300" 
                            placeholder="Masukkan nama penerima"
                            required>
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Nomor WhatsApp
                            </span>
                        </label>
                        <input type="tel" name="whatsapp" id="whatsapp" 
                            class="w-full bg-slate-900/50 border-2 border-purple-500/30 text-gray-100 placeholder-gray-500 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3 transition-all duration-300" 
                            placeholder="08123456789"
                            pattern="[0-9]+"
                            title="Hanya boleh angka"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required>
                        <p class="mt-2 text-xs text-gray-400">Format: 08xxxxxxxxxx (hanya angka)</p>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-200 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Alamat Lengkap
                            </span>
                        </label>
                        <textarea name="alamat" id="alamat" rows="3" 
                            class="w-full bg-slate-900/50 border-2 border-purple-500/30 text-gray-100 placeholder-gray-500 focus:border-cyan-500 focus:ring-cyan-500 rounded-lg px-4 py-3 transition-all duration-300" 
                            placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan"
                            required></textarea>
                    </div>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <!-- Lokasi Map -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-200">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Pilih Lokasi di Peta
                            </span>
                        </label>
                        <button type="button" id="useCurrentLocation" 
                            class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-green-500/50 transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Gunakan Lokasi Saat Ini
                        </button>
                        <div id="map" class="w-full h-96 rounded-xl overflow-hidden border-2 border-purple-500/30 shadow-lg"></div>
                        <p class="text-xs text-gray-400">💡 Klik pada peta untuk memilih lokasi atau gunakan tombol lokasi saat ini</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-purple-500/20">
                        <a href="{{ route('addresses.index') }}" 
                            class="px-6 py-3 bg-slate-700 text-gray-200 font-semibold rounded-lg hover:bg-slate-600 transition-colors duration-300">
                            ← Batal
                        </a>
                        <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-purple-500 text-white font-semibold rounded-lg shadow-lg hover:shadow-cyan-500/50 transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const centerLat = -7.755732;
            const centerLon = 110.356416;
            const maxDistance = 2000;

            var map = L.map('map').setView([centerLat, centerLon], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker;
            var circle = L.circle([centerLat, centerLon], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.1,
                radius: maxDistance
            }).addTo(map);

            function updateMarker(lat, lng) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([lat, lng]).addTo(map);
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
            }

            function onMapClick(e) {
                var distance = map.distance(e.latlng, [centerLat, centerLon]);
                if (distance <= maxDistance) {
                    updateMarker(e.latlng.lat, e.latlng.lng);
                } else {
                    alert('Lokasi yang dipilih terlalu jauh. Silakan pilih lokasi dalam radius 2km.');
                }
            }

            map.on('click', onMapClick);

            document.getElementById('useCurrentLocation').addEventListener('click', function() {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lon = position.coords.longitude;
                        var distance = map.distance([lat, lon], [centerLat, centerLon]);
                        if (distance <= maxDistance) {
                            map.setView([lat, lon], 15);
                            updateMarker(lat, lon);
                        } else {
                            alert('Lokasi Anda saat ini terlalu jauh. Silakan pilih lokasi dalam radius 2km.');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>