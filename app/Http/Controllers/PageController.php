<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        $products = Product::latest()->take(8)->get();

        return view('welcome', compact('products'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        $products = Product::latest()->take(10)->get();

        $stats = [
            'totalProducts' => Product::count(),
            'totalStock'    => Product::sum('stok'),
            'totalValue'    => Product::get()->sum(fn ($p) => $p->harga * $p->stok),
            'lowStock'      => Product::where('stok', '<=', 5)->count(),
        ];

        $categories = Product::select('kategori')
            ->selectRaw('COUNT(*) as jumlah, SUM(stok) as stok')
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', compact('products', 'stats', 'categories'));
    }
}