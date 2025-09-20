<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengetahuan;
use App\Models\PermasalahanKulit;
use App\Models\Penyebab;

class PengetahuanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $pengetahuans = Pengetahuan::with(['permasalahan', 'penyebab'])
            ->when($keyword, function ($query, $keyword) {
                $query->whereHas('permasalahan', function ($q) use ($keyword) {
                        $q->where('nama_permasalahan', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('penyebab', function ($q) use ($keyword) {
                        $q->where('nama', 'like', "%{$keyword}%");
                    });
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('pakar.pengetahuan.index', compact('pengetahuans'));
    }

    public function create()
    {
        $permasalahans = PermasalahanKulit::all();
        $penyebabs = Penyebab::all();

        return view('pakar.pengetahuan.create', compact('permasalahans', 'penyebabs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'permasalahan_id' => 'required|exists:permasalahan_kulits,id',
            'penyebab_id'    => 'required|exists:penyebabs,id', // pastikan nama tabel sesuai
            'mb'             => 'required|numeric|min:0|max:1',
            'md'             => 'required|numeric|min:0|max:1',
        ]);

        Pengetahuan::create($validated);

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Pengetahuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengetahuan = Pengetahuan::findOrFail($id);
        $permasalahans = PermasalahanKulit::all();
        $penyebabs = Penyebab::all();

        return view('pakar.pengetahuan.edit', compact('pengetahuan', 'permasalahans', 'penyebabs'));
    }

    public function update(Request $request, $id)
    {
        $pengetahuan = Pengetahuan::findOrFail($id);

        $validated = $request->validate([
            'permasalahan_id' => 'required|exists:permasalahan_kulits,id',
            'penyebab_id'    => 'required|exists:penyebabs,id', // pastikan nama tabel sesuai
            'mb'             => 'required|numeric|min:0|max:1',
            'md'             => 'required|numeric|min:0|max:1',
        ]);

        $pengetahuan->update($validated);

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Data pengetahuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pengetahuan::findOrFail($id)->delete();

        return redirect()->route('pakar.pengetahuan.index')->with('success', 'Data berhasil dihapus.');
    }
}
