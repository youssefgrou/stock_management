<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_items' => Product::count(),
            'low_stock_items' => Product::whereRaw('quantity <= minimum_quantity')->count(),
            'total_value' => Product::sum(DB::raw('price * quantity')),
            'recent_activities' => StockMovement::with(['product', 'user'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        // Get data for stock level chart
        $stockLevels = Product::select('name', 'quantity')
            ->orderBy('quantity', 'desc')
            ->take(10)
            ->get();

        // Get data for stock movement chart (last 7 days)
        $stockMovements = StockMovement::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN type = "in" THEN quantity ELSE 0 END) as stock_in'),
            DB::raw('SUM(CASE WHEN type = "out" THEN quantity ELSE 0 END) as stock_out')
        )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get();

        return view('dashboard', compact('stats', 'stockLevels', 'stockMovements'));
    }
} 