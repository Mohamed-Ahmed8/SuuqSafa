<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $storeIds = Store::where('user_id', $userId)->pluck('id');

        $stats = [
            'current_balance' => OrderItem::whereIn('store_id', $storeIds)->sum('vendor_earnings'),
            'total_earning' => OrderItem::whereIn('store_id', $storeIds)->sum('vendor_earnings'),
            'total_product' => Product::whereIn('store_id', $storeIds)->count(),
            'total_order' => OrderItem::whereIn('store_id', $storeIds)->count(),
            'success_order' => OrderItem::whereIn('store_id', $storeIds)->whereHas('order', function($q) { $q->where('status', 'completed'); })->count(),
        ];

        return view('vendor.dashboard', compact('stats'));
    }
}
