<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Family', 'description' => 'Heartwarming and emotional slice-of-life stories centered around family bonds, domestic struggles, and the enduring love between parents and children.'],
            ['name' => 'Comedy', 'description' => 'Lighthearted, humorous films focused on bringing laughter through absurd situations, eccentric characters, and funny misunderstandings in everyday life.'],
            ['name' => 'Suspense', 'description' => 'Thrilling and mysterious narratives designed to keep the audience on the edge of their seats, often featuring psychological tension, unsolved mysteries, or mind-bending plot twists.'],
        ];

        foreach ($categories as $category){
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
