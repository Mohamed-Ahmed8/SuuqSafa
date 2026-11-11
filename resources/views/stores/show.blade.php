@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            @if($store->logo)
                <img src="{{ route('storage.file', ['type' => 'logos', 'filename' => basename($store->logo)]) }}" 
     alt="{{ $store->name }} logo" 
     class="h-8 w-8 object-contain rounded mr-4" 
     style="max-width:48px;" />
            @endif
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $store->name }}
            </h2>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- debug info removed --}}

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-600">{{ $store->description }}</p>
            </div>

            {{-- Store-level WhatsApp link removed per request --}}

            <h3 class="text-2xl font-bold mb-4">Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white shadow-sm sm:rounded-lg p-4">
                        @if($product->image)
                             <a href="{{ route('products.show', $product) }}" class="block mb-3">
                                <img src="{{ route('storage.file', ['type' => 'products', 'filename' => basename($product->image)]) }}" alt="{{ $product->name }}" class="w-full h-auto object-contain">
                            </a>
                        @else
                            <div class="h-40 w-full bg-gray-100 flex items-center justify-center text-gray-400 mb-3">No image</div>
                        @endif
                        <h4 class="font-bold text-lg">{{ $product->name }}</h4>
                        <div class="text-sm text-gray-500 mt-1">{{ $product->store?->name ?? $store->name }}</div>
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
                        <a href="{{ route('checkout.whatsapp') }}?product={{ $product->id }}"
   target="_blank"
   class="mt-2 block w-full text-center px-4 py-2 bg-[#25D366] text-white rounded hover:opacity-90 font-semibold">
    WhatsApp Order
</a>
                    </div>
                @empty
                    <p class="text-gray-500">No products available yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
