<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Order;

class AdminDashboardController extends Controller
{
     public function index()
    {
        $totalLeads = Lead::count();
        $followUpLeads = Lead::where('status', 'follow-up')->count();
        $totalOrders = Order::count();
        $ordersPending = Order::where('status', 'menunggu pembayaran')->count();
        $ordersInProduction = Order::where('status', 'produksi')->count();
        $ordersCompleted = Order::where('status', 'selesai')->count();

        $recentOrders = Order::with('lead')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLeads',
            'followUpLeads',
            'totalOrders',
            'ordersPending',
            'ordersInProduction',
            'ordersCompleted',
            'recentOrders'
        ));
    }
}
