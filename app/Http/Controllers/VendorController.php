<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function create()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255|unique:stores,name',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:6|confirmed',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'accept' => 'accepted',
        ]);

        // create user
        $user = User::create([
            'name' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'vendor',
        ]);

        // create store
        $store = Store::create([
            'user_id' => $user->id,
            'name' => $validated['business_name'],
            'description' => $validated['description'] ?? null,
            'slug' => \Illuminate\Support\Str::slug($validated['business_name']),
            'status' => 'pending',
        ]);

        Auth::login($user);

        return redirect()->route('vendor.dashboard')->with('success', 'Vendor account created — welcome!');
    }
}
