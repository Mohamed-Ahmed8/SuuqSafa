@extends('layouts.panel')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Dashboard</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Profile</a>
    <a href="{{ route('admin.stores.index') }}" class="block px-4 py-2 rounded bg-teal-100 text-teal-700 font-medium">All Stores</a>
    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Products Module</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Order Module</a>
@endsection

@section('content')
    <h3 class="text-2xl font-bold mb-4">Stores</h3>

    <div class="bg-white p-6 rounded shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <a href="{{ route('admin.stores.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Create Store</a>
                    </div>
                    <div class="text-sm text-gray-600">Total Stores: {{ $stores->total() }}</div>
                </div>

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Owner</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $s)
                        <tr>
                            <td class="px-4 py-2">{{ $s->id }}</td>
                            <td class="px-4 py-2">{{ $s->name }}</td>
                            <td class="px-4 py-2">{{ $s->user?->name }}</td>
                            <td class="px-4 py-2">{{ $s->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.stores.edit', $s) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('admin.stores.destroy', $s) }}" method="POST" class="inline-block ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-yellow-600">No stores available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>

                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                    <div>Per Page: {{ $stores->perPage() }}</div>
                    <div>From: {{ $stores->firstItem() ?? 0 }} To: {{ $stores->lastItem() ?? 0 }}</div>
                    <div>Total: {{ $stores->total() }}</div>
                </div>

                <div class="mt-4">{{ $stores->links() }}</div>
            </div>
@endsection
