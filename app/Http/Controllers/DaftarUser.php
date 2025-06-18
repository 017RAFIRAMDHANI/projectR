<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
class DaftarUser extends Controller
{
      public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'item1' => 'required|string|max:255',
            'item2' => 'required|string|max:255',
            'userType' => 'required',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'item1' => $validated['item1'],
            'item2' => $validated['item2'],
            'role' => $validated['userType'],
            'remember_token' => Str::random(60),
        ]);


        // Arahkan ke halaman manajemen pengguna setelah berhasil menambah
        return redirect()->route('regisuser')->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    // Halaman form untuk menambah user baru
    public function create()
    {
        return view('regisuser');
    }
}
