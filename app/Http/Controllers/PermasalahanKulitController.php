<?php

namespace App\Http\Controllers;

use App\Models\PermasalahanKulit;
use Illuminate\Http\Request;

class PermasalahanKulitController extends Controller
{
    public function index()
    {
        $permasalahan = PermasalahanKulit::all();
        return view('pakar.permasalahan_kulit.index', compact('permasalahan'));
    }

    public function create()
    {
        // Generate kode otomatis P001, P002, dst
        $last = PermasalahanKulit::orderBy('id', 'desc')->first();
        $nextNumber = $last ? intval(substr($last->kode, 1)) + 1 : 1;
        $kodeBaru = 'Pk' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('pakar.permasalahan_kulit.create', compact('kodeBaru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:permasalahan_kulits,kode',
            'nama_permasalahan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'saran' => 'nullable|string',
        ]);

        PermasalahanKulit::create([
            'kode' => $request->kode,
            'nama_permasalahan' => $request->nama_permasalahan,
            'deskripsi' => $request->deskripsi,
            'saran' => $request->saran,
        ]);

        return redirect()->route('pakar.permasalahan_kulit.index')
                         ->with('success', 'Permasalahan kulit berhasil ditambahkan.');
    }

    public function edit(PermasalahanKulit $permasalahanKulit)
    {
        return view('pakar.permasalahan_kulit.edit', compact('permasalahanKulit'));
    }

    public function update(Request $request, PermasalahanKulit $permasalahanKulit)
    {
        $request->validate([
            'kode' => 'required|unique:permasalahan_kulits,kode,' . $permasalahanKulit->id,
            'nama_permasalahan' => 'required|string|max:255',
            'saran' => 'nullable|string',
        ]);

        $permasalahanKulit->update([
            'kode' => $request->kode,
            'nama_permasalahan' => $request->nama_permasalahan,
            'saran' => $request->saran,
        ]);

        return redirect()->route('pakar.permasalahan_kulit.index')
                         ->with('success', 'Permasalahan kulit berhasil diupdate.');
    }

    public function destroy(PermasalahanKulit $permasalahanKulit)
    {
        $permasalahanKulit->delete();

        return redirect()->route('pakar.permasalahan_kulit.index')
                         ->with('success', 'Permasalahan kulit berhasil dihapus.');
    }
}
