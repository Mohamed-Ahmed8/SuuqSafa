<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('store')->where('status', 'active')->orderBy('id','desc')->paginate(12);
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        return view('products.show', compact('product'));
    }

    public function create(Request $request)
    {
        $stores = auth()->user()->stores;
        if ($stores->isEmpty()) {
            return redirect()->route('stores.create')->with('error', 'You need a store first.');
        }
        return view('products.create', compact('stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $store = Store::findOrFail($validated['store_id']);
        if ($store->user_id !== auth()->id()) abort(403);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        Product::create($validated);

        return redirect()->route('stores.show', $store)->with('success', 'Product added!');
    }
}
