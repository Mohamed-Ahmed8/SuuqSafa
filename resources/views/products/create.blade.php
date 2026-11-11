<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="store_id" class="block font-medium text-sm text-gray-700">Select Store</label>
                        <select id="store_id" name="store_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Product Name</label>
                        <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="text" name="name" required />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" name="description" rows="3"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="price" class="block font-medium text-sm text-gray-700">Price ($)</label>
                            <input id="price" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="number" step="0.01" name="price" required />
                        </div>
                        <div>
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stock Quantity</label>
                            <input id="stock" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="number" name="stock" required />
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700">
                        Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
