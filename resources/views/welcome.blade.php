<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Reed Code Laundry') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-gray-100 font-sans"  style="font-family: 'Inter', sans-serif;">

    @include('layouts.second-nav')

    <main class="pt-20">
        <section class="relative min-h-[85vh] flex items-center overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1648627667032-d02d79b28066?q=80&w=2350&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-purple-900/90 to-slate-900/95"></div>
            </div>
            
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-700"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl">
                    <div class="mb-6">
                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 border border-cyan-500/30 rounded-full text-cyan-400 text-sm font-semibold backdrop-blur-sm">
                            🚀 Laundry Modern & Terpercaya
                        </span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Laundry Premium</span>
                        <br>
                        <span class="text-white">di Ujung Jari Anda</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed">
                        Bersih, Rapi, dan Wangi. <span class="text-cyan-400 font-semibold">Antar Jemput Gratis!</span>
                        <br>
                        <span class="text-lg text-gray-400">Solusi laundry terbaik untuk gaya hidup modern Anda</span>
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('orders.create') }}" class="group relative px-8 py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 overflow-hidden transform hover:scale-105">
                            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <span class="relative z-10 flex items-center gap-2">
                                Pesan Sekarang
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="#layanan" class="group px-8 py-4 rounded-xl font-bold text-lg text-gray-300 bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 hover:border-cyan-500/50 transition-all duration-300 transform hover:scale-105">
                            Lihat Layanan
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-6">
                        <div class="text-center p-4 bg-white/5 backdrop-blur-sm rounded-lg border border-white/10">
                            <div class="text-3xl font-bold text-cyan-400">6 Jam</div>
                            <div class="text-sm text-gray-400 mt-1">Layanan Express</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 backdrop-blur-sm rounded-lg border border-white/10">
                            <div class="text-3xl font-bold text-purple-400">Gratis</div>
                            <div class="text-sm text-gray-400 mt-1">Antar Jemput</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 backdrop-blur-sm rounded-lg border border-white/10">
                            <div class="text-3xl font-bold text-pink-400">100%</div>
                            <div class="text-sm text-gray-400 mt-1">Higienis</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="layanan" class="py-24 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-cyan-400 font-semibold text-sm uppercase tracking-wider">Layanan Kami</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mt-3 mb-4">Layanan Unggulan</h2>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">Pilih layanan yang sesuai dengan kebutuhan Anda</p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <div class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-2xl border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-500 hover:transform hover:scale-105">
                        <!-- Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity blur-xl"></div>
                        
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-feather="zap" class="text-white h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-cyan-400 transition-colors">Layanan Express</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">Selesai dalam waktu <span class="text-cyan-400 font-semibold">±6 jam</span>. Sempurna untuk kebutuhan mendesak Anda.</p>
                            
                            <div class="mt-6 flex items-center text-cyan-400 font-semibold group-hover:gap-2 gap-1 transition-all">
                                <span>Pilih Layanan</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-2xl border border-purple-500/20 hover:border-purple-500/50 transition-all duration-500 hover:transform hover:scale-105">
                        <!-- Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity blur-xl"></div>
                        
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <i data-feather="clock" class="text-white h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-purple-400 transition-colors">Layanan Reguler</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">Selesai dalam <span class="text-purple-400 font-semibold">2 hari</span>. Kualitas premium dengan harga terjangkau.</p>
                            
                            <div class="mt-6 flex items-center text-purple-400 font-semibold group-hover:gap-2 gap-1 transition-all">
                                <span>Pilih Layanan</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="py-24 relative overflow-hidden bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl"></div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-purple-400 font-semibold text-sm uppercase tracking-wider">Keunggulan Kami</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mt-3 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">Komitmen kami untuk memberikan layanan terbaik</p>
                </div>
                
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="group text-center p-8 bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <i data-feather="truck" class="text-white h-10 w-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">Antar Jemput Gratis</h3>
                        <p class="text-gray-400 leading-relaxed">Layanan door-to-door tanpa biaya tambahan</p>
                    </div>
                    
                    <div class="group text-center p-8 bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <i data-feather="shield" class="text-white h-10 w-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">Proses Higienis</h3>
                        <p class="text-gray-400 leading-relaxed">Standar kebersihan tertinggi untuk keamanan Anda</p>
                    </div>
                    
                    <div class="group text-center p-8 bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <i data-feather="award" class="text-white h-10 w-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">Kualitas Terjamin</h3>
                        <p class="text-gray-400 leading-relaxed">Hasil cucian bersih, rapi, dan wangi setiap saat</p>
                    </div>
                    
                    <div class="group text-center p-8 bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur-sm rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <i data-feather="users" class="text-white h-10 w-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">Tim Profesional</h3>
                        <p class="text-gray-400 leading-relaxed">Staf berpengalaman dan terlatih</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="py-24 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-cyan-400 font-semibold text-sm uppercase tracking-wider">Hubungi Kami</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mt-3 mb-4">Mari Terhubung</h2>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">Siap melayani kebutuhan laundry Anda kapan saja</p>
                </div>
                
                <div class="max-w-4xl mx-auto">
                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6285171713355" target="_blank" class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-2xl border border-green-500/20 hover:border-green-500/50 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-emerald-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity blur-xl"></div>
                            
                            <div class="relative z-10 text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                    <i data-feather="phone" class="text-white h-8 w-8"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-green-400 transition-colors">WhatsApp</h3>
                                <p class="text-gray-400 text-sm mb-3">Chat langsung dengan kami</p>
                                <p class="text-green-400 font-semibold">+62 851-7171-3355</p>
                            </div>
                        </a>
                        
                        <!-- Instagram -->
                        <a href="https://instagram.com/reedcode.id" target="_blank" class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-2xl border border-pink-500/20 hover:border-pink-500/50 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity blur-xl"></div>
                            
                            <div class="relative z-10 text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                    <i data-feather="instagram" class="text-white h-8 w-8"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-pink-400 transition-colors">Instagram</h3>
                                <p class="text-gray-400 text-sm mb-3">Follow untuk update terbaru</p>
                                <p class="text-pink-400 font-semibold">@reedcode.id</p>
                            </div>
                        </a>
                        
                        <!-- TikTok -->
                        <a href="https://tiktok.com/@reedcode.id" target="_blank" class="group relative bg-gradient-to-br from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-8 rounded-2xl border border-cyan-500/20 hover:border-cyan-500/50 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity blur-xl"></div>
                            
                            <div class="relative z-10 text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">TikTok</h3>
                                <p class="text-gray-400 text-sm mb-3">Lihat konten menarik kami</p>
                                <p class="text-cyan-400 font-semibold">@reedcode.id</p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- CTA Card -->
                    <div class="mt-12 text-center p-8 bg-gradient-to-r from-cyan-500/10 to-purple-500/10 backdrop-blur-sm rounded-2xl border border-white/10">
                        <p class="text-gray-300 text-lg mb-4">Butuh layanan laundry sekarang?</p>
                        <a href="{{ route('orders.create') }}" class="inline-block relative px-8 py-4 rounded-xl font-bold text-lg text-white transition-all duration-300 overflow-hidden group transform hover:scale-105">
                            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-purple-500 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            <span class="relative z-10 flex items-center gap-2">
                                Pesan Sekarang
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gradient-to-b from-slate-900 to-slate-950 border-t border-purple-500/20 py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-lg blur-sm opacity-75"></div>
                            <img src="https://www.svgrepo.com/show/195928/laundry.svg" alt="Reed Code Laundry Logo" class="h-10 w-10 relative z-10">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Reed Code</span>
                            <span class="text-xs text-gray-400 -mt-1">Laundry</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Solusi laundry modern untuk gaya hidup Anda. Bersih, cepat, dan terpercaya.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-4">Link Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm">Beranda</a></li>
                        <li><a href="{{ route('home') }}#layanan" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm">Layanan</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#kontak" class="text-gray-400 hover:text-cyan-400 transition-colors text-sm">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Social Media -->
                <div>
                    <h4 class="text-white font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-3">
                        <a href="https://instagram.com/reedcode.id" target="_blank" class="w-10 h-10 bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg flex items-center justify-center hover:scale-110 transition-transform">
                            <i data-feather="instagram" class="text-white h-5 w-5"></i>
                        </a>
                        <a href="https://tiktok.com/@reedcode.id" target="_blank" class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/6285171713355" target="_blank" class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center hover:scale-110 transition-transform">
                            <i data-feather="phone" class="text-white h-5 w-5"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-400 text-sm">WhatsApp:</p>
                        <a href="https://wa.me/6285171713355" class="text-cyan-400 hover:text-cyan-300 font-semibold text-sm">+62 851-7171-3355</a>
                    </div>
                </div>
            </div>
            
            <div class="pt-8 border-t border-white/5 text-center">
                <p class="text-gray-500 text-sm">&copy; 2024 Reed Code Laundry. Semua Hak Dilindungi.</p>
                <p class="text-gray-600 text-xs mt-2">Developed with <span class="text-red-500">❤</span> by Reed Code</p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
        
        const userMenu = document.getElementById('userMenu');
        const userDropdown = document.getElementById('userDropdown');
        if (userMenu && userDropdown) {
            userMenu.addEventListener('click', () => {
                userDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>