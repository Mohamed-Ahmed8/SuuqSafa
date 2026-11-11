@extends('layouts.panel')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded bg-teal-500 text-white font-medium">Dashboard</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Profile</a>
    <a href="{{ route('admin.stores.index') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">All Stores</a>
    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Products Module</a>
    <a href="#" class="block px-4 py-2 rounded text-gray-600 hover:bg-gray-100 font-medium">Order Module</a>
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Good {{ (now()->format('H') < 12) ? 'Morning' : 'Afternoon' }}, {{ auth()->user()->name }}</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <div class="bg-teal-400 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Current Balance (Admin)</h3>
            <div class="text-4xl font-bold mt-2">${{ number_format($stats['current_balance'], 2) }}</div>
            <div class="absolute right-0 bottom-0 opacity-20 -mb-4 -mr-4">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/></svg>
            </div>
        </div>

        <div class="bg-teal-800 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Pending Balance</h3>
            <div class="text-4xl font-bold mt-2">$0.00</div>
        </div>

        <div class="bg-pink-600 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Order Completed Balance</h3>
            <div class="text-4xl font-bold mt-2">${{ number_format($stats['total_earning'], 2) }}</div>
        </div>

        <div class="bg-indigo-500 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Total Earning</h3>
            <div class="text-4xl font-bold mt-2">${{ number_format($stats['total_earning'], 2) }}</div>
        </div>

        <div class="bg-teal-400 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Total Product</h3>
            <div class="text-4xl font-bold mt-2">{{ $stats['total_product'] }}</div>
        </div>

        <div class="bg-teal-800 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Total Campaign</h3>
            <div class="text-4xl font-bold mt-2">0</div>
        </div>

        <div class="bg-pink-600 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Total Order</h3>
            <div class="text-4xl font-bold mt-2">{{ $stats['total_order'] }}</div>
        </div>

        <div class="bg-indigo-500 rounded-lg p-6 text-white shadow relative overflow-hidden">
            <h3 class="text-lg font-medium opacity-90">Success Order</h3>
            <div class="text-4xl font-bold mt-2">{{ $stats['success_order'] }}</div>
        </div>
    </div>
@endsection
