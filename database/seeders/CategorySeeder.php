<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $categories = [
            ['name' => 'Minuman Dingin'],
            ['name' => 'Kopi Susu'],
            ['name' => 'Snack & Pastry'],
            ['name' => 'Merchandise Exclusive']
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}