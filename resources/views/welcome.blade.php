<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CampusMarket - Jual Beli Mahasiswa</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            /* Hide scrollbar for category slider */
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none;  scrollbar-width: none; }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">

        <nav class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-gray-100" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="bg-orange-600 text-white p-1.5 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900">Campus<span class="text-orange-600">Market</span></span>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-orange-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-orange-600 transition">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white transition-all duration-200 bg-orange-600 border border-transparent rounded-full hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <div class="flex items-center md:hidden">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <div x-show="open" class="md:hidden bg-white border-t border-gray-100 p-4 space-y-3 shadow-lg">
                <a href="{{ route('login') }}" class="block text-base font-medium text-gray-700 hover:text-orange-600">Masuk</a>
                <a href="{{ route('register') }}" class="block text-base font-medium text-orange-600">Daftar Akun</a>
            </div>
        </nav>

        <div class="relative bg-white overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-50 to-orange-100 opacity-50"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="text-center lg:text-left lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold uppercase tracking-wide mb-4">
                            Khusus Mahasiswa
                        </div>
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Jual Beli Aman</span>
                            <span class="block text-orange-600">Sesama Mahasiswa</span>
                        </h1>
                        <p class="mt-4 text-lg text-gray-500 max-w-lg mx-auto lg:mx-0">
                            Punya barang bekas kuliah yang numpuk? Atau butuh buku murah? Cari dan jual semuanya di sini. Verifikasi NIM menjamin keamanan transaksi.
                        </p>
                        <div class="mt-8 sm:flex sm:justify-center lg:justify-start gap-3">
                            <a href="#katalog" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-orange-600 hover:bg-orange-700 md:text-lg transition shadow-lg shadow-orange-600/30">
                                Belanja Sekarang
                            </a>
                            <a href="{{ route('register') }}" class="mt-3 sm:mt-0 w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition">
                                Mulai Jualan
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block relative mt-12 lg:mt-0">
                        <img class="w-full drop-shadow-2xl rounded-2xl transform rotate-2 hover:rotate-0 transition duration-500" src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Students">
                        
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-green-100 p-2 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Terverifikasi</p>
                                <p class="font-bold text-gray-900">Mahasiswa Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10">
            <div class="flex gap-4 overflow-x-auto no-scrollbar py-4">
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm text-sm font-medium hover:border-orange-500 hover:text-orange-600 transition whitespace-nowrap">
                    📚 Buku & Alat Tulis
                </button>
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm text-sm font-medium hover:border-orange-500 hover:text-orange-600 transition whitespace-nowrap">
                    💻 Elektronik
                </button>
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm text-sm font-medium hover:border-orange-500 hover:text-orange-600 transition whitespace-nowrap">
                    👗 Fashion
                </button>
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm text-sm font-medium hover:border-orange-500 hover:text-orange-600 transition whitespace-nowrap">
                    🍱 Makanan
                </button>
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-full shadow-sm text-sm font-medium hover:border-orange-500 hover:text-orange-600 transition whitespace-nowrap">
                    🛵 Jasa Antar
                </button>
            </div>
        </div>

        <main id="katalog" class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Terbaru</h2>
                <a href="#" class="text-orange-600 font-medium hover:underline flex items-center gap-1">
                    Lihat Semua 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <livewire:product-list />
            
        </main>

        <div class="bg-gray-900 py-16 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Terverifikasi Kampus</h3>
                        <p class="text-gray-400 text-sm">Semua penjual dan pembeli terverifikasi menggunakan email universitas.</p>
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Harga Mahasiswa</h3>
                        <p class="text-gray-400 text-sm">Temukan barang dengan harga bersahabat, dari mahasiswa untuk mahasiswa.</p>
                    </div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Nego Langsung</h3>
                        <p class="text-gray-400 text-sm">Fitur chat langsung ke WhatsApp penjual untuk negosiasi cepat.</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white border-t border-gray-200 pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div class="col-span-1 md:col-span-1">
                        <span class="font-bold text-xl tracking-tight text-gray-900">Campus<span class="text-orange-600">Market</span></span>
                        <p class="mt-4 text-gray-500 text-sm">Platform jual beli eksklusif untuk komunitas mahasiswa. Aman, Cepat, dan Terpercaya.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Kategori</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">Buku Kuliah</a></li>
                            <li><a href="#" class="hover:text-orange-600">Elektronik</a></li>
                            <li><a href="#" class="hover:text-orange-600">Fashion</a></li>
                            <li><a href="#" class="hover:text-orange-600">Hobby</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Bantuan</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">Cara Berjualan</a></li>
                            <li><a href="#" class="hover:text-orange-600">Aturan Penggunaan</a></li>
                            <li><a href="#" class="hover:text-orange-600">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Hubungi Kami</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>support@campusmarket.id</li>
                            <li>+62 812 3456 7890</li>
                            <li>Pekalongan, Indonesia</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-8 text-center">
                    <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Campus Market. Dibuat dengan ❤️ oleh Mahasiswa PPL.</p>
                </div>
            </div>
        </footer>

    </body>
</html>