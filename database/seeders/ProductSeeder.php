<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id', 'name');

        $products = [
            ['VDT-SUS-001', 'Enter the Ether', 'Suspense', 'pcs', 5],
            ['VDT-SUS-002', 'Disappearing Elevator', 'Suspense', 'pcs', 5],
            ['VDT-SUS-003', 'Unlimited Players', 'Suspense', 'pcs', 5],
            ['VDT-COM-001', 'Coffee Mate', 'Comedy', 'pcs', 10],
            ['VDT-COM-002', 'Small Body Big Crisis', 'Comedy', 'pcs', 10],
            ['VDT-FAM-001', 'The Heartbeat', 'Family', 'pcs', 3],
            ['VDT-FAM-002', 'TreCarls', 'Family', 'pcs', 3]
        ];

        foreach($products as [$sku, $name, $category, $unit, $minStock]){
            Product::firstOrCreate(
                ['sku' => $sku],
                [
                   'category_id' => $categoryIds[$category],
                    'name'        => $name,
                    'unit'        => $unit,
                    'stock'       => 0,
                    'min_stock'   => $minStock,
                ]
            );
        }
    }
}
