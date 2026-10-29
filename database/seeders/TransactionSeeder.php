<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'wise@randomplay.id')->firstOrFail();
        $staff = User::where('email', 'vivian@randomplay.id')->firstOrFail();

        DB::transaction(function () use ($admin, $staff){
            // barang masuk
            $masuk = Transaction::create([
                'user_id' => $admin->id,
                'type' => 'in',
                'reference_no'     => 'IN-0001',
                'transaction_date' => now()->subDays(5),
                'note'             => 'Stok awal dari pemasok',
            ]);
            foreach (Product::all() as $product){
                $masuk->items()->create([
                    'product_id' => $product->id,
                    'quantity' => 10,
                ]);
                $product->increment('stock',10);
            }
            // barang keluar
            $keluar = Transaction::create([
                'user_id' => $staff->id,
                'type' => 'in',
                'reference_no'     => 'OUT-0001',
                'transaction_date' => now()->subDays(2),
                'note'             => 'Kirim ke belobog industries',
            ]);

              $jumlahKeluar = [8, 6, 3];
              foreach (Product::orderBy('id')->take(3)->get() as $i => $product) {
                $keluar->items()->create([
                    'product_id' => $product->id,
                    'quantity'   => $jumlahKeluar[$i],
                ]);
                $product->decrement('stock', $jumlahKeluar[$i]);
            }
        });


        }
    }

