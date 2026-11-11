@extends('layouts.app')

@section('content')
    <!-- Hero Banners -->
    <div class="container mx-auto px-4 lg:px-12 py-8 flex flex-col md:flex-row gap-6">
        <!-- Banner 1 -->
        <div class="w-full md:w-1/2 p-10 flex rounded-xl overflow-hidden shadow relative" style="background-color: #4dbbf2;">
            <div class="flex-1 text-gray-900 z-10 lg:w-1/2 pr-4 relative">
                <h3 class="text-sm font-bold tracking-widest text-[#0b6e4f] mt-8 mb-2 uppercase">Novembers Gadget Madness</h3>
                <h2 class="text-5xl font-black mb-6 tracking-tight text-[#0f2e53]">20% OFF</h2>
                <a href="{{ route('stores.index') }}" class="inline-block bg-yellow-400 text-gray-900 font-bold px-6 py-2 rounded font-medium shadow hover:bg-yellow-500 transition">GET Offer</a>
            </div>
            <div class="absolute right-[-40px] top-6 transform rotate-[-15deg] opacity-90 hidden md:block">
                <div class="w-48 h-48 border-[20px] rounded-t-full border-[#0f2e53] border-b-0 relative ml-8">
                    <div class="w-16 h-24 bg-[#0f2e53] rounded-[40px] absolute -bottom-12 -left-8 shadow-xl flex items-center justify-center text-white font-bold opacity-90"><span class="-rotate-90">JBL</span></div>
                    <div class="w-16 h-24 bg-[#0f2e53] rounded-[40px] absolute -bottom-12 -right-8 shadow-xl flex items-center justify-center text-white font-bold opacity-90"><span class="-rotate-90">JBL</span></div>
                </div>
            </div>
        </div>

        <!-- Banner 2 -->
        <div class="w-full md:w-1/2 p-10 flex rounded-xl overflow-hidden shadow" style="background-color: #ecf302;">
            <div class="flex-1 text-gray-900 z-10 w-full relative content-center text-center pb-24 pt-8">
                <h3 class="text-sm font-bold tracking-widest opacity-80 mt-4 mb-2 uppercase">Home Appliances</h3>
                <h2 class="text-4xl font-black tracking-tight text-[#0f2e53]">CYBER MONDAY SPECIAL</h2>
            </div>
            <div class="absolute right-12 bottom-6 w-32 h-40 bg-gray-200 border-4 border-gray-300 shadow-2xl rounded flex flex-col items-center pt-2 hidden md:flex">
                <div class="w-24 h-6 border border-gray-300 bg-white mb-4 rounded flex items-center px-1"><div class="w-2 h-2 bg-red-500 rounded-full"></div></div>
                <div class="w-24 h-24 rounded-full border-4 border-gray-400 bg-gray-600 shadow-inner flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full border-2 border-white bg-blue-300 opacity-60"></div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($q) && !empty($stores))
        <div class="container mx-auto px-4 lg:px-12 py-4">
            <h3 class="text-2xl font-bold mb-4">Stores matching "{{ $q }}"</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach($stores as $store)
                    <div class="p-4 bg-white shadow-sm rounded">
                        <a href="{{ route('stores.show', $store) }}" class="font-semibold text-lg">{{ $store->name }}</a>
                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($store->description, 80) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(isset($products) && $products->isNotEmpty())
        <div class="container mx-auto px-4 lg:px-12 py-8">
            <h3 class="text-2xl font-bold mb-6">Featured Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white shadow-sm sm:rounded-lg p-4 flex flex-col">
                        @if($product->image)
                            <a href="{{ route('products.show', $product) }}" class="block mb-3">
                                <img src="{{ route('storage.file', ['type' => 'products', 'filename' => basename($product->image)]) }}" alt="{{ $product->name }}" class="w-full h-auto object-contain">
                            </a>
                        @endif

                        <div class="flex-1">
                            <h4 class="font-bold text-lg"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                            <div class="text-sm text-gray-500 mt-1">{{ $product->store?->name ?? 'Unknown store' }}</div>
                            <p class="text-gray-500 text-sm mt-2 mb-2">{{ Str::limit($product->description, 60) }}</p>
                        </div>

                        <div class="mt-2 flex items-center justify-between">
                            <div>
                                <div class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</div>
                                @if(isset($product->stock))
                                    @if($product->stock > 0)
                                        <div class="text-sm text-green-600">In stock: {{ $product->stock }}</div>
                                    @else
                                        <div class="text-sm text-red-600">Out of stock</div>
                                    @endif
                                @endif
                            </div>

                            <div class="w-1/2">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-4 w-full text-white rounded py-2 {{ ($product->stock ?? 1) > 0 ? 'bg-gray-800 hover:bg-gray-700' : 'bg-gray-300 cursor-not-allowed' }}" {{ ($product->stock ?? 1) > 0 ? '' : 'disabled' }}>Add to Cart</button>
                                </form>
           <a href="{{ route('checkout.whatsapp') }}?product={{ $product->id }}"
   target="_blank"
   class="mt-2 block w-full text-center px-4 py-2 bg-[#25D366] text-white rounded hover:opacity-90 font-semibold">
    WhatsApp Order
</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection