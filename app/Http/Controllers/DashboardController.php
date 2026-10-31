<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = (int) Product::sum('stock');
        $lowStockCount = Product::lowStock()->count();

        $lowStockProducts = Product::with('category')
            ->lowStock()
            ->orderBy('stock')
            ->take(10)
            ->get();

        $movement = TransactionItem::query()
            ->join('transactions', 'transactions.id', '=', 'transaction_items.transaction_id')
            ->where('transactions.transaction_date', '>=' , now()->subDays(30)->toDateString())
             ->selectRaw('transactions.type, SUM(transaction_items.quantity) as total')
            ->groupBy('transactions.type')
            ->pluck('total', 'type');

        
        $totalIn  = (int) $movement->get('in', 0);
        $totalOut = (int) $movement->get('out', 0);

        $recentTransactions = Transaction::with(['user', 'items.product'])
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->take(5)
            ->get();
            
        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'lowStockCount',
            'lowStockProducts',
            'totalIn',
            'totalOut',
            'recentTransactions')
            );
    }
}
