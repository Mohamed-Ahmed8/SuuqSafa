@extends('layouts.panel')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Dashboard</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Profile</a>
    <a href="{{ route('admin.stores.index') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">All Stores</a>
    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded bg-teal-100 text-teal-700 font-medium">Products Module</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Order Module</a>
@endsection

@section('content')
    <h3 class="text-2xl font-bold mb-4">Create Product</h3>

    <div class="bg-white p-6 rounded shadow-sm">
        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block">Store</label>
                <select name="store_id" class="w-full rounded border-gray-300">
                    @foreach($stores as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Name</label>
                <input name="name" class="w-full rounded border-gray-300" required />
            </div>
            <div class="mb-4">
                <label class="block">Description</label>
                <textarea name="description" class="w-full rounded border-gray-300"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block">Price</label>
                    <input name="price" type="number" step="0.01" class="w-full rounded border-gray-300" required />
                </div>
                <div>
                    <label class="block">Stock</label>
                    <input name="stock" type="number" class="w-full rounded border-gray-300" required />
                </div>
            </div>
            <div class="mb-4">
                <label class="block">Image</label>
                <input type="file" name="image" accept="image/*" class="w-full rounded border-gray-300" />
                <p class="text-sm text-gray-500 mt-1">Optional. Recommended size 800x800px. Stored publicly.</p>
            </div>
            <div class="mb-4">
                <label class="block">Status</label>
                <select name="status" class="w-full rounded border-gray-300">
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>
            <button class="bg-gray-800 text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>
@endsection
