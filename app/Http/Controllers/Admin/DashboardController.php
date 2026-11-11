<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $stats = [
            'current_balance' => \App\Models\OrderItem::sum('admin_commission'),
            'total_earning' => \App\Models\OrderItem::sum('admin_commission'),
            'total_product' => Product::count(),
            'total_order' => Order::count(),
            'success_order' => Order::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
