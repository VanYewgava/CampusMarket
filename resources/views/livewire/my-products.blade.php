<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Dashboard Toko
                </h2>
                <p class="mt-1 text-sm text-gray-500">Kelola barang dagangan dan pantau status tokomu.</p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                @if($user->seller_status === 'approved')
                    <a href="{{ route('product.create') }}" class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600 transition">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Tambah Barang
                    </a>
                @endif
            </div>
        </div>

        @if($user->seller_status === 'pending')
            <div class="rounded-md bg-yellow-50 p-4 mb-6 border border-yellow-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Menunggu Verifikasi</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Permintaan Anda menjadi penjual sedang ditinjau oleh Admin. Mohon tunggu 1x24 jam.</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($user->seller_status !== 'approved')
            <div class="bg-indigo-600 rounded-lg shadow-lg mb-8 overflow-hidden">
                <div class="px-6 py-8 sm:p-10 text-center text-white">
                    <h3 class="text-2xl font-bold">Mulai Jualan Sekarang!</h3>
                    <p class="mt-2 text-indigo-100">Dapatkan penghasilan tambahan dengan menjual barang bekasmu di CampusMarket.</p>
                    <button wire:click="registerAsSeller" wire:confirm="Yakin ingin mendaftar?" class="mt-6 bg-white text-indigo-600 hover:bg-indigo-50 font-bold py-2 px-6 rounded-full shadow transition transform hover:scale-105">
                        Daftar Jadi Penjual
                    </button>
                </div>
            </div>
        @endif

        @if($user->seller_status === 'approved')
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Total Barang</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $products->count() }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Barang Tayang</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-600">{{ $products->where('is_active', true)->count() }}</dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Estimasi Aset</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-orange-600">
                    <span class="text-sm text-gray-400 font-normal">Rp</span> {{ number_format($products->sum('price'), 0, ',', '.') }}
                </dd>
            </div>
        </div>
        @endif

        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" class="mb-4 rounded-md bg-green-50 p-4 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Daftar Barang</h3>
                </div>
            
            @if($products->isEmpty())
                <div class="text-center py-16">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada barang</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai jual barang bekasmu sekarang.</p>
                    @if($user->seller_status === 'approved')
                        <div class="mt-6">
                            <a href="{{ route('product.create') }}" class="inline-flex items-center rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                Upload Barang Pertama
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 sm:pl-6">Produk</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Harga</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                @if(is_array($product->images) && !empty($product->images))
                                                    <img class="h-full w-full object-cover object-center" src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs">No Img</div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900 text-base">{{ $product->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-semibold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 {{ $product->is_active ? 'text-green-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            {{ $product->is_active ? 'Tayang' : 'Arsip' }}
                                        </span>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <button wire:click="delete({{ $product->id }})" 
                                                wire:confirm="Yakin ingin menghapus {{ $product->name }}?"
                                                class="text-red-600 hover:text-red-900 transition flex items-center ml-auto gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>