<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Product;
use App\Models\ResearchProject;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $metrics = [
            'orders_today' => Order::query()->whereDate('created_at', today())->count(),
            'orders_pending' => Order::query()->where('status', 'pending')->count(),
            'revenue_mtd' => Order::query()
                ->where('payment_status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('grand_total'),
            'active_products' => Product::query()->where('is_active', true)->count(),
            'open_leads' => Lead::query()->count(),
            'research_projects' => ResearchProject::query()->count(),
        ];

        $recentOrders = Order::query()
            ->with(['brand', 'shippingAddress'])
            ->latest()
            ->limit(6)
            ->get();

        $recentLeads = Lead::query()
            ->with('brand')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders', 'recentLeads'));
    }
}
