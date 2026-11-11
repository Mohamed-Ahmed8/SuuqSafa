<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Your Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('stores.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Store Name</label>
                        <input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" type="text" name="name" required autofocus />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea id="description" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Create Store
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
