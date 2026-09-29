<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('email', $credentials['email'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->withInput(['email' => $credentials['email']]);
        }

        // Query Builder mengembalikan stdClass, tapi Auth::login() mewajibkan
        // objek Authenticatable. setRawAttributes() menulis langsung ke $attributes,
        // jadi cast 'hashed' TIDAK ikut jalan di sini (bagus - tidak double hash).
        Auth::login((new User)->setRawAttributes((array) $user));

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $products = Product::latest()->take(10)->get();

        $stats = [
            'totalProducts' => Product::count(),
            'totalStock' => Product::sum('stok'),
            'totalValue' => Product::get()->sum(fn ($p) => $p->harga * $p->stok),
            'lowStock' => Product::where('stok', '<=', 5)->count(),
        ];

        $categories = Product::select('kategori')
            ->selectRaw('COUNT(*) as jumlah, SUM(stok) as stok')
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', compact('products', 'stats', 'categories'));
    }
}
