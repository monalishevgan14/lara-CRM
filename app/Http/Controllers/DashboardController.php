<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index1()
    {
        // Total Users
        $totalUsers = User::count();

        // Total Orders
        $totalOrders = Order::count();

        // Total Revenue
        $totalRevenue = Order::sum('total_amount');

        // Latest 5 Orders with relations
        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Top Selling Products
        $topProducts = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'latestOrders',
            'topProducts'
        ));
    }

    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');

        $latestOrders = Order::with('user')->latest()->take(5)->get();

        $topProducts = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // 🔥 Monthly Revenue
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // 🔥 Monthly Orders
        $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
          )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'latestOrders',
            'topProducts',
            'monthlyRevenue',
            'monthlyOrders'
        ));
    }

}
