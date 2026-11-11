<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // determine if cart contains items from a single store
        $storeIds = collect($cart)->pluck('store_id')->filter()->unique()->values();
        $singleStoreId = $storeIds->count() === 1 ? $storeIds->first() : null;

        // Group cart items by store_id so the view can render per-store sections/buttons
        $storeGroups = collect($cart)->groupBy(function($item){ return $item['store_id'] ?? null; })->map(function($items, $storeId){
            $items = $items->toArray();
            $subtotal = array_reduce($items, function($carry, $it){ return $carry + ($it['price'] * $it['quantity']); }, 0);
            return [
                'store_id' => $storeId,
                'items' => $items,
                'subtotal' => $subtotal,
            ];
        })->values()->all();

        // Load Store models for stores present in the cart (keyed by id)
        $storeModels = [];
        $ids = $storeIds->filter()->values()->all();
        if (!empty($ids)) {
            $storeModels = \App\Models\Store::whereIn('id', $ids)->get()->keyBy('id');
        }

        return view('checkout.index', compact('total', 'singleStoreId', 'storeGroups', 'storeModels'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('stores.index');
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'status' => 'completed', // auto-complete for MVP
        ]);

        foreach ($cart as $productId => $item) {
            $lineTotal = $item['price'] * $item['quantity'];
            $adminCommission = $lineTotal * 0.10; // 10% commission to admin
            $vendorEarnings = $lineTotal - $adminCommission;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'store_id' => $item['store_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'admin_commission' => $adminCommission,
                'vendor_earnings' => $vendorEarnings,
            ]);
        }

        session()->forget('cart');

        if (auth()->check()) {
            return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
        }

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

public function whatsapp(Request $request)
{
$productId = $request->query('product');


$cart = session()->get('cart', []);

if (empty($cart) && empty($productId)) {
    return redirect()->route('cart.index')
        ->with('error', 'Your cart is empty.');
}

/*
|--------------------------------------------------------------------------
| Single Product Checkout
|--------------------------------------------------------------------------
*/
if (empty($cart) && !empty($productId)) {

    $product = \App\Models\Product::with('store')->findOrFail($productId);

    $phone = $product->store->whatsapp_number
        ?? env('WHATSAPP_NUMBER', '');

    $phone = preg_replace('/\D+/', '', (string)$phone);

    if (empty($phone)) {
        return redirect()->back()
            ->with('error', 'WhatsApp number is not configured.');
    }

    $customer = auth()->check()
        ? auth()->user()->name
        : 'Guest';

    $productLink = url(
        '/stores/' .
        $product->store->slug .
        '/products/' .
        $product->slug
    );

    $message = "New Order From: {$customer}\n\n";
    $message .= "Product: {$product->name}\n";
    $message .= "Price: $" . number_format($product->price, 2) . "\n";
    $message .= "Quantity: 1\n";
    $message .= "Product Link: {$productLink}\n\n";
    $message .= "Please confirm payment method and delivery details.";

    $waUrl = "https://wa.me/{$phone}?text=" . rawurlencode($message);

    return redirect()->away($waUrl);
}

/*
|--------------------------------------------------------------------------
| Cart Checkout
|--------------------------------------------------------------------------
*/
$store = $request->route('store')
    ?? $request->query('store')
    ?? $request->query('store_id');

if ($store) {

    if (!$store instanceof \App\Models\Store) {
        $store = \App\Models\Store::find($store);
    }

    $storeItems = array_filter($cart, function ($item) use ($store) {
        return isset($item['store_id'])
            && $item['store_id'] == $store->id;
    });

    if (empty($storeItems)) {
        return redirect()->route('cart.index')
            ->with('error', 'No items in cart for that store.');
    }

    $total = array_reduce($storeItems, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    $phone = $store->whatsapp_number
        ?? env('WHATSAPP_NUMBER', '');

} else {

    $storeItems = $cart;

    $total = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    $phone = env('WHATSAPP_NUMBER', '');
}

$phone = preg_replace('/\D+/', '', (string)$phone);

if (empty($phone)) {
    return redirect()->back()
        ->with('error', 'WhatsApp number is not configured.');
}

$lines = [];

foreach ($storeItems as $pid => $item) {

    $product = \App\Models\Product::with('store')->find($pid);

    $link = url('/products/' . $pid);

    if (
        $product &&
        $product->store &&
        !empty($product->store->slug) &&
        !empty($product->slug)
    ) {
        $link = url(
            '/stores/' .
            $product->store->slug .
            '/products/' .
            $product->slug
        );
    }

    $lines[] =
        $item['name'] .
        " x" . $item['quantity'] .
        " - $" . number_format($item['price'], 2) .
        " = $" . number_format($item['price'] * $item['quantity'], 2) .
        "\nProduct Link: " . $link;
}

$customer = auth()->check()
    ? auth()->user()->name
    : 'Guest';

$message = "New Order From: {$customer}\n\n";
$message .= implode("\n\n", $lines);
$message .= "\n\nTotal: $" . number_format($total, 2);
$message .= "\n\nPlease confirm payment method and delivery details.";

$waUrl = "https://wa.me/{$phone}?text=" . rawurlencode($message);

try {

    foreach ($storeItems as $pid => $item) {
        unset($cart[$pid]);
    }

    if (empty($cart)) {
        session()->forget('cart');
    } else {
        session()->put('cart', $cart);
    }

} catch (\Throwable $e) {
    \Log::error($e->getMessage());
}

return redirect()->away($waUrl);


}


}
