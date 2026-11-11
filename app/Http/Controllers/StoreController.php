<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::where('status', 'active')->get();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:stores',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = 'active'; // For MVP

        Store::create($validated);

        return redirect()->route('dashboard')->with('success', 'Store created successfully!');
    }

    public function show(Store $store)
    {
        $products = $store->products()->where('status', 'active')->get();
        return view('stores.show', compact('store', 'products'));
    }

    public function edit(Store $store)
    {
        if ($store->user_id !== auth()->id()) abort(403);
        return view('stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        if ($store->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:stores,name,' . $store->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $store->update($validated);

        return redirect()->route('stores.show', $store)->with('success', 'Store updated!');
    }

    public function destroy(Store $store)
    {
        if ($store->user_id !== auth()->id()) abort(403);
        $store->delete();
        return redirect()->route('dashboard');
    }
}
