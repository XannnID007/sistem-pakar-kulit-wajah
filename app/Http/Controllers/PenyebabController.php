<?php

namespace App\Http\Controllers;

use App\Models\Penyebab;
use Illuminate\Http\Request;

class PenyebabController extends Controller
{
    public function index()
    {
        $penyebabs = Penyebab::all();
        return view('pakar.penyebab.index', compact('penyebabs'));
    }

    public function create()
    {
        // Ambil data terakhir
        $last = Penyebab::orderBy('id', 'desc')->first();

        // Hitung nomor berikutnya
        $nextNumber = $last ? intval(substr($last->kode, 1)) + 1 : 1;

        // Buat kode format P001, P002, dst
        $kodeBaru = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('pakar.penyebab.create', compact('kodeBaru'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'kode' => 'required|unique:penyebabs,kode',
            'nama' => 'required|string|max:255|unique:penyebabs,nama',
        ], [
            'kode.unique' => 'Kode penyebab sudah digunakan.',
            'nama.unique' => 'Nama penyebab sudah ada.',
        ]);

        // Simpan ke database
        Penyebab::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('pakar.penyebab.index')->with('success', 'Data penyebab berhasil ditambah');
    }

    public function edit(Penyebab $penyebab)
    {
        return view('pakar.penyebab.edit', compact('penyebab'));
    }

    public function update(Request $request, Penyebab $penyebab)
    {
        // Validasi, perbolehkan kode/nama sama jika milik sendiri
        $request->validate([
            'kode' => 'required|unique:penyebabs,kode,' . $penyebab->id,
            'nama' => 'required|string|max:255|unique:penyebabs,nama,' . $penyebab->id,
        ]);

        $penyebab->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('pakar.penyebab.index')->with('success', 'Data penyebab berhasil diubah');
    }

    public function destroy(Penyebab $penyebab)
    {
        $penyebab->delete();
        return redirect()->route('pakar.penyebab.index')->with('success', 'Data penyebab berhasil dihapus');
    }
}
