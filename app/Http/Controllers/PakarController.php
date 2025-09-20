<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penyebab;
use App\Models\PermasalahanKulit;
use App\Models\Pengetahuan;

class PakarController extends Controller
{
    public function user(Request $request)
    {
        $query = \App\Models\User::where('role', 'pengguna');
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        $users = $query->get();
    
        return view('pakar.user', compact('users'));
    }

    public function dashboard()
{
    $jumlahPakar = User::where('role', 'pakar')->count();
    $jumlahUser = User::where('role', 'pengguna')->count();
    $jumlahPenyebab = Penyebab::count();
    $jumlahPermasalahan = PermasalahanKulit::count();
    $jumlahPengetahuan = Pengetahuan::count();
   
    return view('pakar.dashboard', compact('jumlahPakar', 'jumlahUser', 'jumlahPenyebab', 'jumlahPermasalahan', 'jumlahPengetahuan'));
}
    
    public function index(Request $request)
{
    $query = User::where('role', 'pakar');

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    $pakars = $query->get();
   

    return view('pakar.pakar.index', compact('pakars'));
}
public function create()
{
    return view('pakar.pakar.create');
}


    // Simpan pakar baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pakar',
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('pakar.index')->with('success', 'Pakar berhasil ditambahkan.');
    }

    // Form edit pakar
    public function edit($id)
    {
        $pakar = User::findOrFail($id);
        return view('pakar.pakar.edit', compact('pakar'));
    }

    // Update pakar
    public function update(Request $request, $id)
{
    $pakar = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $pakar->id,
        'password' => 'nullable|string|min:6',
    ]);

    $pakar->name = $validated['name'];
    $pakar->email = $validated['email'];

    // Jika password diisi, update password
    if (!empty($validated['password'])) {
        $pakar->password = bcrypt($validated['password']);
    }

    $pakar->save();

    return redirect()->route('pakar.index')->with('success', 'Data pakar berhasil diperbarui.');
}


    // Hapus pakar
    public function destroy($id)
    {
        $pakar = User::findOrFail($id);
        $pakar->delete();
    
        return redirect()->route('pakar.index')->with('success', 'Data pakar berhasil dihapus.');
    }
}


