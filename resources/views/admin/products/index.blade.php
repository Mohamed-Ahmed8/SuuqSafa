@extends('layouts.panel')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Dashboard</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Profile</a>
    <a href="{{ route('admin.stores.index') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">All Stores</a>
    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded bg-teal-100 text-teal-700 font-medium">Products Module</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Order Module</a>
@endsection

@section('content')
    <h3 class="text-2xl font-bold mb-4">Products</h3>

    <div class="bg-white p-6 rounded shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <a href="{{ route('admin.products.create') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded">Add New Product</a>
                    </div>
                    <div class="text-sm text-gray-600">Total Products: {{ $products->total() }}</div>
                </div>

                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Store</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Stock</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $p)
                        <tr>
                            <td class="px-4 py-2">{{ $p->id }}</td>
                            <td class="px-4 py-2">{{ $p->name }}</td>
                            <td class="px-4 py-2">{{ $p->store?->name }}</td>
                            <td class="px-4 py-2">${{ number_format($p->price,2) }}</td>
                            <td class="px-4 py-2">{{ $p->stock }}</td>
                            <td class="px-4 py-2">{{ $p->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.products.edit', $p) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline-block ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-yellow-600">No Product Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>

                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                    <div>Per Page: {{ $products->perPage() }}</div>
                    <div>From: {{ $products->firstItem() ?? 0 }} To: {{ $products->lastItem() ?? 0 }}</div>
                    <div>Total: {{ $products->total() }}</div>
                </div>

                <div class="mt-4">{{ $products->links() }}</div>
            </div>
@endsection
