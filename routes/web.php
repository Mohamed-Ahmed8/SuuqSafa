<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $q = request('q');
    if ($q) {
        $products = \App\Models\Product::where('status', 'active')
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhereHas('store', function($sq) use ($q) { $sq->where('name', 'like', "%{$q}%"); });
            })
            ->orderBy('id','desc')
            ->get();

        $stores = \App\Models\Store::where('status', 'active')
            ->where('name', 'like', "%{$q}%")
            ->orderBy('name')
            ->get();

        return view('welcome', compact('products', 'stores', 'q'));
    }

    $products = \App\Models\Product::where('status', 'active')->orderBy('id','desc')->take(8)->get();
    return view('welcome', compact('products'));
})->name('home');

// Dedicated search route to avoid relying on query param on home.
Route::get('/search', function () {
    $q = request('q');
    if ($q) {
        $products = \App\Models\Product::where('status', 'active')
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhereHas('store', function($sq) use ($q) { $sq->where('name', 'like', "%{$q}%"); });
            })
            ->orderBy('id','desc')
            ->get();

        $stores = \App\Models\Store::where('status', 'active')
            ->where('name', 'like', "%{$q}%")
            ->orderBy('name')
            ->get();

        return view('welcome', compact('products', 'stores', 'q'));
    }

    return redirect()->route('home');
});

// Vendor registration (guest)
Route::get('/vendor/register', [VendorController::class, 'create'])->name('vendor.register');
Route::post('/vendor/register', [VendorController::class, 'store'])->name('vendor.register.store');

// Vendor login (guest)
Route::get('/vendor/login', [VendorAuthController::class, 'showLogin'])->name('vendor.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dev-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('dev.logout');


Route::middleware('auth')->get('/dev/promote-admin', function () {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }

    $user = auth()->user();
    if ($user) {
        $user->role = 'admin';
        $user->save();
        return redirect()->back()->with('success', 'User promoted to admin for development.');
    }

    return redirect()->route('login');
})->name('dev.promote-admin');


Route::get('/dev/products-debug', function () {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }

    return \App\Models\Product::with('store')->get()->map(function($p){
        return [
            'id' => $p->id,
            'name' => $p->name,
            'store' => $p->store?->name,
            'store_id' => $p->store_id,
            'status' => $p->status,
            'price' => $p->price,
            'stock' => $p->stock,
            'created_at' => $p->created_at,
        ];
    });
});


Route::get('/dev/search-debug', function () {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }

    $q = request('q');
    if (! $q) return response()->json(['error' => 'missing query'], 400);

    $products = \App\Models\Product::where('name', 'like', "%{$q}%")
        ->orWhere('description', 'like', "%{$q}%")
        ->with('store')
        ->get();

    $stores = \App\Models\Store::where('name', 'like', "%{$q}%")->get();

    return response()->json(['q' => $q, 'products' => $products, 'stores' => $stores]);
});


Route::get('/dev/login-as/{id}', function ($id) {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }

    $user = \App\Models\User::find($id);
    if (! $user) {
        abort(404);
    }

    auth()->loginUsingId($user->id);
    return redirect()->route('home')->with('success', 'Logged in as user id ' . $user->id);
})->name('dev.login-as');


Route::get('/dev/add-to-cart/{id}', function ($id) {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }

    $product = \App\Models\Product::find($id);
    if (! $product) {
        abort(404);
    }

    $cart = session()->get('cart', []);
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'store_id' => $product->store_id,
        ];
    }
    session()->put('cart', $cart);
    return redirect()->route('cart.index')->with('success', 'Test product added to cart');
})->name('dev.add-to-cart');


Route::get('/dev/cart-debug', function () {
    if (!config('app.debug') && env('APP_ENV') !== 'local') {
        abort(404);
    }
    return response()->json(session()->get('cart', []));
})->name('dev.cart-debug');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Allow owners to edit/update/delete their stores/products
    // Product creation is handled in the admin panel only
    Route::resource('stores', StoreController::class)->only(['edit', 'update', 'destroy']);
    Route::resource('products', ProductController::class)->only(['edit', 'update', 'destroy']);


    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/vendor/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
});


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/checkout/whatsapp', [CheckoutController::class, 'whatsapp'])->name('checkout.whatsapp');


Route::get('/checkout/start', function () {
    return redirect()->route('checkout.index');
})->name('checkout.start');

// Admin resource management (stores & products)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('stores', App\Http\Controllers\Admin\StoreController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
});

Route::get('stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('stores/{store}', [StoreController::class, 'show'])->name('stores.show');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// Shop pages
Route::view('/shop-page/track-order', 'shop.track-order')->name('shop.track-order');

Route::get('/_s/{type}/{filename}', [App\Http\Controllers\StoredFileController::class, 'show'])
->where('type','products|logos')
->name('storage.file');

// About page
Route::view('/about', 'about')->name('about');

require __DIR__.'/auth.php';
