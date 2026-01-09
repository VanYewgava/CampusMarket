<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="flex mb-8 text-sm text-gray-500">
        <a href="/" class="hover:text-orange-600">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12">
        
        <div class="flex flex-col gap-4">
            <div class="aspect-square w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                @if(is_array($product->images) && count($product->images) > 0)
                    {{-- Tampilkan Gambar Pertama --}}
                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                         alt="{{ $product->name }}" 
                         class="h-full w-full object-cover object-center"
                         id="mainImage">
                @else
                    <div class="flex h-full items-center justify-center text-gray-400">Tidak ada gambar</div>
                @endif
            </div>

            {{-- Thumbnail Gallery --}}
            @if(is_array($product->images) && count($product->images) > 1)
                <div class="flex gap-4 overflow-x-auto pb-2">
                    @foreach($product->images as $image)
                        <button onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $image) }}'" 
                                class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 hover:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <img src="{{ asset('storage/' . $image) }}" class="h-full w-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-10 lg:mt-0 px-2">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
            
            <div class="mt-4 flex items-center justify-between">
                <p class="text-3xl font-bold tracking-tight text-orange-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <span class="inline-flex items-center rounded-md bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                    {{ $product->category->name ?? 'Umum' }}
                </span>
            </div>

            <div class="mt-2">
                 <span class="inline-flex items-center rounded-md {{ $product->condition == 'new' ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-yellow-50 text-yellow-700 ring-yellow-600/20' }} px-2 py-1 text-xs font-medium ring-1 ring-inset">
                    {{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}
                </span>
            </div>

            <div class="mt-6 flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xl uppercase">
                    {{ substr($product->seller->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <p class="font-medium text-gray-900">{{ $product->seller->name }}</p>
                        
                        @if($product->seller->is_student_verified)
                            <div title="Terverifikasi Mahasiswa Aktif" class="flex items-center gap-1 text-green-600 bg-green-50 px-2 py-0.5 rounded text-[10px] font-bold border border-green-200">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                VERIFIED
                            </div>
                        @endif
                    </div>
                    
                    <p class="text-sm text-gray-500">Penjual</p>
                    <p class="text-xs text-gray-500">{{ $product->seller->major ?? 'Mahasiswa' }}</p>
                </div>
            </div>

            <div class="mt-8 space-y-4 text-gray-600">
                <h3 class="text-sm font-medium text-gray-900">Deskripsi Barang</h3>
                
                <div class="prose prose-sm max-w-none text-gray-600">
                    {!! $product->description !!}
                </div>
            </div>

            <div class="mt-10 flex gap-4">
                @php
                    // Fallback nomor WA statis (karena kolom phone belum ada di tabel users)
                    // Nanti ganti '6281234567890' dengan $product->seller->phone kalau sudah ada
                    $phone = $product->seller->phone ?? '6281234567890'; 
                    
                    // Format kalau user input pake 08... ganti jadi 62...
                    if(Str::startsWith($phone, '0')) {
                        $phone = '62' . substr($phone, 1);
                    }

                    $message = "Halo kak, saya tertarik dengan barang *{$product->name}* di CampusMarket. Masih ada?";
                    $waLink = "https://wa.me/{$phone}?text=" . urlencode($message);
                @endphp

                <button wire:click="startChat" class="flex-1 flex items-center justify-center gap-2 rounded-full bg-orange-600 px-8 py-3 text-base font-medium text-white hover:bg-orange-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Chat Penjual
                </button>
                
                <button class="flex items-center justify-center rounded-full border border-gray-300 bg-white px-4 py-3 text-gray-700 hover:bg-gray-50 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>