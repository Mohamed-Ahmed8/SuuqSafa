<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Stores') }}
            </h2>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.stores.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-bold">Create a Store</a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($stores as $store)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold">{{ $store->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ Str::limit($store->description, 100) }}</p>
                        <a href="{{ route('stores.show', $store) }}" class="mt-4 inline-block text-blue-600 hover:underline">View Store &rarr;</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
