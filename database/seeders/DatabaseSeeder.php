<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $products = [
            ['Beras Premium 5kg', 'Sembako', 72000, 40],
            ['Minyak Goreng 1L', 'Sembako', 18500, 60],
            ['Gula Pasir 1kg', 'Sembako', 16500, 3],
            ['Susu Kotak UHT', 'Minuman', 8000, 25],
            ['Teh Botol 350ml', 'Minuman', 4500, 10],
            ['Air Mineral 600ml', 'Minuman', 3000, 100],
            ['Keripik Kentang', 'Snack', 12000, 30],
            ['Biskuit Cokelat', 'Snack', 9500, 4],
            ['Kecap Manis 600ml', 'Kebutuhan Rumah', 15000, 20],
            ['Sabun Cuci Piring', 'Kebutuhan Rumah', 11000, 15],
        ];

        foreach ($products as [$nama_produk, $kategori, $harga, $stok]) {
            Product::create(compact('nama_produk', 'kategori', 'harga', 'stok'));
        }
    }
}
