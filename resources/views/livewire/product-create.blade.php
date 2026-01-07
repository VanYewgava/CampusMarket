<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Jual Barang Baru</h2>

            <form wire:submit="save" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Contoh: Buku Kalkulus Edisi 5">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                        <select wire:model="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            <option value="used">Bekas</option>
                            <option value="new">Baru</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" wire:model="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Contoh: 50000">
                    @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi Lengkap</label>
                    <textarea wire:model="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Jelaskan kondisi barang, minus (jika ada), dan alasan jual."></textarea>
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Barang (Max 5)</label>
                    
                    <input type="file" wire:model="images" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <div wire:loading wire:target="images" class="text-sm text-orange-600 mt-1">Sedang mengupload...</div>
                    @error('images') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    @if ($images)
                        <div class="mt-4 flex gap-2 overflow-x-auto">
                            @foreach ($images as $img)
                                <img src="{{ $img->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-md border">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                        Tayangkan Barang
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>