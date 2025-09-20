<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyebab;
use App\Models\PermasalahanKulit;
use App\Models\Pengetahuan;
use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    // Tampilkan form data diri
    public function showDataForm()
    {
        return view('user.diagnosa.data_form');
    }

    // Simpan data diri user
    public function storeData(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'usia'  => 'required|integer|min:0|max:120',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        session([
            'nama' => $request->nama,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('diagnosa.permasalahan_form');
    }

    // Tampilkan daftar permasalahan kulit
    public function showPermasalahanForm()
    {
        if (!session()->has('nama')) {
            return redirect()->route('diagnosa.data_form')->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        $permasalahans = PermasalahanKulit::all();
        return view('user.diagnosa.permasalahan_form', compact('permasalahans'));
    }

    // Tampilkan form penyebab berdasarkan permasalahan yang dipilih
    public function showPenyebabForm(Request $request)
    {
        if (!session()->has('nama')) {
            return redirect()->route('diagnosa.data_form')->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        $request->validate([
            'permasalahan_id' => 'required|exists:permasalahan_kulits,id',
        ]);

        session(['permasalahan_id' => $request->permasalahan_id]);

        // Ambil penyebab yang terkait dengan permasalahan yang dipilih
        $penyebabs = Pengetahuan::where('permasalahan_id', $request->permasalahan_id)
            ->with('penyebab')
            ->get()
            ->pluck('penyebab')
            ->unique('id');

        return view('user.diagnosa.penyebab_form', compact('penyebabs'));
    }

    // Proses diagnosa CF
public function prosesDiagnosa(Request $request)
{
    $request->validate([
        'penyebab' => 'required|array',
    ]);

    $permasalahanId = session('permasalahan_id');
    if (!$permasalahanId) {
        return redirect()->route('diagnosa.permasalahan_form')
                         ->with('error', 'Silakan pilih permasalahan terlebih dahulu.');
    }

    $inputPenyebab = $request->input('penyebab'); // array: [penyebab_id => cf_user]

    // Ambil aturan pengetahuan
    $aturan = Pengetahuan::where('permasalahan_id', $permasalahanId)
        ->whereIn('penyebab_id', array_keys($inputPenyebab))
        ->with('permasalahan')
        ->get();

    // ===== Debug jika perlu =====
    // dd($aturan->toArray());

    $cfCombine = null;

    foreach ($aturan as $item) {
        $cfUser = floatval($inputPenyebab[$item->penyebab_id] ?? 0);
        $mb = floatval($item->mb) * $cfUser;
        $md = floatval($item->md) * $cfUser;
        $cf = $mb - $md;

        if (is_null($cfCombine)) {
            $cfCombine = $cf;
        } else {
            $cfCombine = $cfCombine + ($cf * (1 - $cfCombine));
        }
    }

    // Ambil permasalahan dari tabel permasalahan langsung sebagai fallback
    $permasalahan = $aturan->first()->permasalahan ?? PermasalahanKulit::find($permasalahanId);

    $hasilDiagnosa = [
        'permasalahan' => $permasalahan->nama_permasalahan ?? 'Tidak Diketahui',
        'saran'        => $permasalahan->saran ?? '-',
        'cf'           => round($cfCombine ?? 0, 4),
    ];

    // Ambil daftar penyebab yang dipilih
    $penyebabDipilih = [];
    foreach ($inputPenyebab as $id => $cfUser) {
        $penyebab = Penyebab::find($id);
        if ($penyebab) {
            $penyebabDipilih[] = [
                'nama'    => $penyebab->nama,
                'cf_user' => floatval($cfUser),
            ];
        }
    }

    return view('user.diagnosa.hasil', compact('hasilDiagnosa', 'penyebabDipilih'));
}


    // Diagnosa ulang
    public function diagnosaUlang()
    {
        if (!session()->has('nama')) {
            return redirect()->route('diagnosa.data_form')->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        session()->forget(['permasalahan_id']);
        return redirect()->route('diagnosa.permasalahan_form');
    }
}
