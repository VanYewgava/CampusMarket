<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6 px-4 sm:px-0">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Saya</h2>

            @if($user->seller_status === 'approved')
                <a href="{{ route('product.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 text-sm font-medium">
                    + Jual Barang Baru
                </a>
            @elseif($user->seller_status === 'pending')
                <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-md cursor-not-allowed text-sm font-medium">
                    ⏳ Menunggu Verifikasi Admin
                </button>
            @else
                <button wire:click="registerAsSeller" wire:confirm="Apakah Anda yakin ingin mendaftar sebagai penjual?" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
                    📝 Daftar Jadi Penjual
                </button>
            @endif
        </div>

        @if (session()->has('message'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4 mx-4 sm:mx-0">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             </div>

    </div>
</div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if($products->isEmpty())
                <div class="p-12 text-center text-gray-500">
                    Belum ada barang yang dijual. Ayo mulai jualan!
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Foto</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        @if(!empty($product->images))
                                            <img src="{{ asset('storage/' . $product->images[0]) }}" class="w-12 h-12 object-cover rounded">
                                        @else
                                            <span class="text-xs">No img</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $product->name }}
                                        <div class="text-xs text-gray-400">{{ $product->category->name ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Tayang' : 'Terjual/Arsip' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button wire:click="delete({{ $product->id }})" 
                                                wire:confirm="Yakin ingin menghapus barang ini?"
                                                class="text-red-600 hover:text-red-900">
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