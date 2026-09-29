<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'nama_produk' => fake()->randomElement([
                'Beras Premium 5kg', 'Minyak Goreng 1L', 'Gula Pasir 1kg',
                'Telur Ayam 1kg', 'Susu Kotak UHT', 'Teh Botol 350ml',
                'Air Mineral 600ml', 'Keripik Kentang', 'Biskuit Cokelat',
                'Kecap Manis 600ml', 'Sabun Cuci Piring', 'Mie Instan Goreng',
                'Kopi Sachet', 'Roti Tawar', 'Shampo Botol 100ml',
            ]),
            'kategori' => fake()->randomElement([
                'Sembako', 'Minuman', 'Snack', 'Kebutuhan Rumah',
            ]),
            'harga' => fake()->numberBetween(2000, 150000),
            'stok' => fake()->numberBetween(0, 100),
        ];
    }
}