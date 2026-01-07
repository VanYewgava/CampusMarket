<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="flex mb-8 text-sm text-gray-500">
        <a href="/" class="hover:text-orange-600">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12">
        
        <div class="flex flex-col gap-4">
            <div class="aspect-square w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                @if(!empty($product->images) && isset($product->images[0]))
                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                         alt="{{ $product->name }}" 
                         class="h-full w-full object-cover object-center"
                         id="mainImage">
                @else
                    <div class="flex h-full items-center justify-center text-gray-400">No Image</div>
                @endif
            </div>

            @if(!empty($product->images) && count($product->images) > 1)
                <div class="flex gap-4 overflow-x-auto pb-2">
                    @foreach($product->images as $image)
                        <button onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $image) }}'" 
                                class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 hover:border-orange-500">
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

            <div class="mt-6 flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xl">
                    {{ substr($product->seller->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm text-gray-500">Penjual</p>
                    <p class="font-medium text-gray-900">{{ $product->seller->name }}</p>
                    <p class="text-xs text-gray-500">{{ $product->seller->university->name ?? 'Kampus tidak diketahui' }}</p>
                </div>
            </div>

            <div class="mt-8 space-y-4 text-gray-600">
                <h3 class="text-sm font-medium text-gray-900">Deskripsi Barang</h3>
                <div class="prose prose-sm max-w-none">
                    {!! $product->description !!}
                </div>
            </div>

            <div class="mt-10 flex gap-4">
                @php
                    // Format Nomor WA (Ubah 08xx jadi 628xx)
                    $phone = $product->seller->phone ?? '';
                    if(Str::startsWith($phone, '0')) {
                        $phone = '62' . substr($phone, 1);
                    }
                    $message = "Halo kak, saya tertarik dengan barang *{$product->name}* yang dijual di CampusMarket. Masih ada?";
                    $waLink = "https://wa.me/{$phone}?text=" . urlencode($message);
                @endphp

                <a href="{{ $waLink }}" target="_blank" class="flex-1 flex items-center justify-center gap-2 rounded-full border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    Chat Penjual
                </a>
                
                <button class="flex items-center justify-center rounded-full border border-gray-300 bg-white px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>