<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed produk contoh menggunakan ProductFactory.
     * Jalankan: php artisan db:seed --class=ProductSeeder
     */
    public function run(): void
    {
        Product::factory()->count(20)->create();

        $this->command->info('20 produk contoh berhasil dibuat.');
    }
}