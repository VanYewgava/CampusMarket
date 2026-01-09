<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pesan</h2>
            <p class="mt-1 text-sm text-gray-500">Riwayat percakapan dengan pembeli & penjual.</p>
        </div>
        <div class="hidden sm:block">
            <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-0.5 text-sm font-medium text-orange-800">
                {{ $conversations->count() }} Percakapan
            </span>
        </div>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
        <ul role="list" class="divide-y divide-gray-100">
            @forelse($conversations as $chat)
                @php
                    $me = auth()->id();
                    $opponent = ($chat->buyer_id == $me) ? $chat->seller : $chat->buyer;
                    $lastMessage = $chat->messages->first();
                    $product = $chat->product;
                    
                    // Cek apakah produk punya gambar
                    $productImage = null;
                    if($product && is_array($product->images) && !empty($product->images)) {
                        $productImage = $product->images[0];
                    }
                @endphp

                <li class="relative hover:bg-gray-50 transition duration-150 ease-in-out group">
                    <a href="{{ route('chat', $chat->id) }}" class="block p-6">
                        <div class="flex items-start gap-x-4">
                            
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                                    {{ substr($opponent->name, 0, 1) }}
                                </div>
                            </div>

                            <div class="min-w-0 flex-auto">
                                <div class="flex items-baseline justify-between gap-x-4">
                                    <p class="text-base font-semibold leading-6 text-gray-900 group-hover:text-orange-600 transition">
                                        {{ $opponent->name }}
                                        <span class="font-normal text-xs text-gray-400 ml-2">
                                            {{ $opponent->major ?? '' }}
                                        </span>
                                    </p>
                                    <p class="flex-none text-xs text-gray-500">
                                        {{ $chat->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <div class="mt-1 flex items-center gap-2">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    <p class="line-clamp-1 text-sm leading-5 text-gray-600">
                                        {{ $lastMessage ? $lastMessage->body : 'Mulai percakapan...' }}
                                    </p>
                                </div>

                                @if($product)
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            Topik: {{ $product->name }}
                                        </span>
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                                            Barang telah dihapus
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-shrink-0 flex flex-col items-end">
                                @if($productImage)
                                    <img class="h-16 w-16 rounded-lg object-cover border border-gray-200 shadow-sm group-hover:border-orange-200 transition" 
                                         src="{{ asset('storage/' . $productImage) }}" 
                                         alt="Produk">
                                @elseif($product)
                                    <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                                        <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <svg class="h-5 w-5 flex-none text-gray-400 mt-4 group-hover:text-orange-500 transition" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </div>

                        </div>
                    </a>
                </li>
            @empty
                <div class="text-center py-16 px-6">
                    <div class="mx-auto h-24 w-24 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-12 w-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="mt-2 text-lg font-semibold text-gray-900">Belum ada percakapan</h3>
                    <p class="mt-1 text-sm text-gray-500 max-w-sm mx-auto">Mulai tawar menawar barang atau tunggu pembeli menghubungi Anda.</p>
                    <div class="mt-6">
                        <a href="/" class="inline-flex items-center rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                            Cari Barang Dulu
                        </a>
                    </div>
                </div>
            @endforelse
        </ul>
    </div>
</div>