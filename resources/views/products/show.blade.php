<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
                <div class="text-sm text-gray-500 mt-1">{{ $product->store?->name ?? 'Unknown store' }}</div>
                <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                <div class="text-3xl font-bold mt-4">${{ number_format($product->price, 2) }}</div>

                @if(isset($product->stock))
                    @if($product->stock > 0)
                        <div class="text-sm text-green-600 mt-2">In stock: {{ $product->stock }}</div>
                    @else
                        <div class="text-sm text-red-600 mt-2">Out of stock</div>
                    @endif
                @endif

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" class="px-6 py-3 {{ ($product->stock ?? 1) > 0 ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-300 text-gray-600 cursor-not-allowed' }} rounded-md font-bold" {{ ($product->stock ?? 1) > 0 ? '' : 'disabled' }}>Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
