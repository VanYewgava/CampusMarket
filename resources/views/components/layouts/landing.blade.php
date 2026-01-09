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
            [x-cloak] { display: none !important; }
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none;  scrollbar-width: none; }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased flex flex-col min-h-screen">

        <nav class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-gray-100" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <a href="/" class="flex items-center gap-2">
                            <div class="bg-orange-600 text-white p-1.5 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="font-bold text-xl tracking-tight text-gray-900">Campus<span class="text-orange-600">Market</span></span>
                        </a>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-medium text-gray-700 hover:text-orange-600 transition">Beranda</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-orange-600 transition">Toko Saya</a>
                            
                                <a href="{{ route('inbox') }}" class="text-sm font-medium text-gray-700 hover:text-orange-600 transition relative">
                                Pesan
                                <span class="absolute -top-1 -right-2 flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                </span>
                            </a>
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
            
            <div x-show="open" x-cloak class="md:hidden bg-white border-t border-gray-100 p-4 space-y-3 shadow-lg">
                <a href="/" class="block text-base font-medium text-gray-700 hover:text-orange-600">Beranda</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="block text-base font-medium text-gray-700 hover:text-orange-600">Toko Saya</a>
                    <a href="{{ route('inbox') }}" class="block text-base font-medium text-gray-700 hover:text-orange-600">Pesan</a>
                @else
                    <a href="{{ route('login') }}" class="block text-base font-medium text-gray-700 hover:text-orange-600">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-base font-medium text-orange-600">Daftar Akun</a>
                @endauth
            </div>
        </nav>

        <main class="flex-grow w-full">
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200 pt-12 pb-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div class="col-span-1 md:col-span-1">
                        <span class="font-bold text-xl tracking-tight text-gray-900">Campus<span class="text-orange-600">Market</span></span>
                        <p class="mt-4 text-gray-500 text-sm">Platform jual beli eksklusif untuk komunitas mahasiswa.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Kategori</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">Buku Kuliah</a></li>
                            <li><a href="#" class="hover:text-orange-600">Elektronik</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Bantuan</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">Cara Berjualan</a></li>
                            <li><a href="#" class="hover:text-orange-600">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Hubungi Kami</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>support@campusmarket.id</li>
                            <li>Pekalongan, Indonesia</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-8 text-center">
                    <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Campus Market.</p>
                </div>
            </div>
        </footer>
    </body>
</html>