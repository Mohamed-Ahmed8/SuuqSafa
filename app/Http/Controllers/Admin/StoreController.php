<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __construct()
    {
        // simple role guard
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role === 'admin') {
                return $next($request);
            }
            abort(403);
        });
    }

    public function index()
    {
        $stores = Store::with('user')->orderBy('id','desc')->paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255|unique:stores',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'logo' => 'nullable|image|max:2048',
            'whatsapp_number' => 'nullable|string|max:32',
        ]);

        // handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $validated['slug'] = Str::slug($validated['name']);
        Store::create($validated);

        return redirect()->route('admin.stores.index')->with('success', 'Store created');
    }

    public function edit(Store $store)
    {
        $users = User::orderBy('name')->get();
        return view('admin.stores.edit', compact('store', 'users'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255|unique:stores,name,' . $store->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'logo' => 'nullable|image|max:2048',
            'whatsapp_number' => 'nullable|string|max:32',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $store->update($validated);

        return redirect()->route('admin.stores.index')->with('success', 'Store updated');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('admin.stores.index')->with('success', 'Store deleted');
    }
}
