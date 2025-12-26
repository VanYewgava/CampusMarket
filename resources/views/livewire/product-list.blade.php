<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @foreach($products as $product)
        <div class="group relative bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
            
            <div class="aspect-square w-full overflow-hidden bg-gray-200 group-hover:opacity-75 lg:h-80">
                @if(!empty($product->images) && isset($product->images[0]))
                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                         alt="{{ $product->name }}" 
                         class="h-full w-full object-cover object-center">
                @else
                    <div class="flex h-full items-center justify-center text-gray-400">
                        No Image
                    </div>
                @endif
            </div>

            <div class="flex flex-1 flex-col p-4 space-y-2">
                <h3 class="text-sm font-medium text-gray-900">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        {{ $product->name }}
                    </a>
                </h3>
                
                @if($product->category)
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 w-fit">
                        {{ $product->category->name }}
                    </span>
                @endif
                
                <p class="text-sm text-gray-500 line-clamp-2">
                    {{ strip_tags($product->description) }}
                </p>

                <div class="flex flex-1 flex-col justify-end">
                    <p class="text-base font-bold text-gray-900">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Penjual: {{ $product->seller->name ?? 'Admin' }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>