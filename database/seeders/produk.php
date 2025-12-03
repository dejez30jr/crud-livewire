<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class produk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Product::create(['title' => 'Produk c', 'price' => 12000]);
    }
}
