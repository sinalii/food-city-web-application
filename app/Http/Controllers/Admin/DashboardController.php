<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = today();
        $salesFor = fn ($from, $to) => Sale::query()->where('status', 'completed')->whereBetween('created_at', [$from, $to]);
        $chart = collect(range(6, 0))->map(function ($daysAgo) {
            $date = today()->subDays($daysAgo);

            return ['label' => $date->format('D'), 'value' => (int) Sale::query()->where('status', 'completed')->whereDate('created_at', $date)->sum('total_lkr')];
        });

        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'todaySales' => $salesFor($today->copy()->startOfDay(), $today->copy()->endOfDay())->count(),
            'todayRevenue' => $salesFor($today->copy()->startOfDay(), $today->copy()->endOfDay())->sum('total_lkr'),
            'weekSales' => $salesFor($today->copy()->startOfWeek(), $today->copy()->endOfWeek())->count(),
            'weekRevenue' => $salesFor($today->copy()->startOfWeek(), $today->copy()->endOfWeek())->sum('total_lkr'),
            'monthSales' => $salesFor($today->copy()->startOfMonth(), $today->copy()->endOfMonth())->count(),
            'monthRevenue' => $salesFor($today->copy()->startOfMonth(), $today->copy()->endOfMonth())->sum('total_lkr'),
            'revenue' => (int) Sale::query()->where('status', 'completed')->sum('total_lkr'),
            'lowStock' => Product::query()->whereColumn('stock_quantity', '<=', 'minimum_stock')->where('is_active', true)->orderBy('stock_quantity')->limit(8)->get(),
            'outOfStock' => Product::query()->where('stock_quantity', 0)->where('is_active', true)->count(),
            'recentSales' => Sale::query()->withCount('items')->latest()->limit(8)->get(),
            'chart' => $chart,
            'chartMax' => max(1, (int) $chart->max('value')),
            'stockMovements' => StockMovement::query()->with('product')->latest()->limit(6)->get(),
            'expirySoon' => Product::query()->whereNotNull('expiry_date')->whereDate('expiry_date', '<=', now()->addDays(30))->whereDate('expiry_date', '>=', today())->orderBy('expiry_date')->limit(6)->get(),
            'salesItems' => SaleItem::count(),
        ]);
    }
}
