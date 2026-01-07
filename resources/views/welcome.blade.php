<x-layouts.landing>
    
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
                        @auth
                            <a href="{{ route('dashboard') }}" class="mt-3 sm:mt-0 w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition">
                                Mulai Jualan
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="mt-3 sm:mt-0 w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition">
                                Mulai Jualan
                            </a>
                        @endauth
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

</x-layouts.landing>