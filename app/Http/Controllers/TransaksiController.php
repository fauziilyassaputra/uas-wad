<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index() 
    {
    $transactions = Transaction::with(['user', 'items.product'])
    ->orderByDesc('transaction_date')    
    ->orderByDesc('id')    
    ->get();
    
    return view('transaksi.index', compact('transactions'));
    }
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('transaksi.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'             => ['required', Rule::in(['in', 'out'])],
            'product_id'       => 'required|exists:products,id',
            'quantity'         => 'required|integer|min:1',
            'transaction_date' => 'required|date|before_or_equal:today',
            'note'             => 'nullable|string|max:255',
        ]);

        $transaction = DB::transaction(function () use ($data, $request){
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($data['type'] === 'out' && $product->stock < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak cukup. Tersedia: {$product->stock} {$product->unit}.",
                ]);
            }
            $transaction = Transaction::create([
                'user_id' => $request->user()->id ,
                 'type'=> $data['type'],
                  'reference_no' => $this->generateReferenceNo($data['type']),
                   'transaction_date' => $data['transaction_date'],
                    'note' => $data['note']
            ]);

            $transaction->items()->create([
                'product_id'=> $product->id,
                'quantity' => $data['quantity'],
            ]);

            if ($data["type"] === 'in'){
                $product->increment('stock',$data['quantity']);
                }
                else {
                $product->decrement('stock',$data['quantity']);

            }
            return $transaction;
        });
        return redirect()
                ->route('transaksi.show', $transaction)
                ->with('success', 'Transaksi berhasil dicatat');
    }

    public function show(Transaction $transaksi)
    {
        $transaksi->load(['user', 'items.product']);

        return view('transaksi.show', compact('transaksi'));
    }
    private function generateReferenceNo(string $type): string
    {
        $prefix = $type === 'in' ? 'IN' : 'OUT';

        return $prefix . '-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
    }
}
