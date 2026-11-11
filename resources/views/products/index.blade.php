<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white shadow-sm sm:rounded-lg p-4">
                            <h4 class="font-bold text-lg"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                            <div class="text-sm text-gray-500 mt-1">{{ $product->store?->name ?? 'Unknown store' }}</div>
                            <p class="text-gray-500 text-sm mt-1 mb-2">{{ Str::limit($product->description, 50) }}</p>
                            <div class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</div>

                            @if(isset($product->stock))
                                @if($product->stock > 0)
                                    <div class="text-sm text-green-600 mt-1">In stock: {{ $product->stock }}</div>
                                @else
                                    <div class="text-sm text-red-600 mt-1">Out of stock</div>
                                @endif
                            @endif

                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="mt-4 w-full {{ ($product->stock ?? 1) > 0 ? 'bg-gray-800 text-white hover:bg-gray-700' : 'bg-gray-300 text-gray-600 cursor-not-allowed' }} rounded py-2" {{ ($product->stock ?? 1) > 0 ? '' : 'disabled' }}>Add to Cart</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500">No products available.</p>
                    @endforelse
                </div>

                <div class="mt-6">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
