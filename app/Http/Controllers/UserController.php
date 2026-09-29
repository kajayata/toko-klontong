<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // select() = whitelist. JANGAN get() polos, hash password ikut kebawa.
        // each() wajib: Query Builder mengembalikan timestamp sebagai string,
        // bukan objek Carbon seperti hasil cast Eloquent.
        $users = DB::table('users')
            ->select(['id', 'name', 'email', 'created_at'])
            ->latest()
            ->get()
            ->each(fn ($user) => $user->created_at = Carbon::parse($user->created_at));

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        DB::table('users')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        abort_if(! $user, 404);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        abort_if(! $user, 404);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => 'nullable|min:8|confirmed',   // kosong = jangan diubah
        ]);

        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'updated_at' => now(),
        ];

        if ($data['password'] ?? null) {
            $update['password'] = Hash::make($data['password']);
        }

        DB::table('users')->where('id', $id)->update($update);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cegah admin mengunci dirinya sendiri di luar sistem
        abort_if((int) $id === (int) auth()->id(), 403, 'Tidak bisa menghapus akun yang sedang dipakai.');

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
