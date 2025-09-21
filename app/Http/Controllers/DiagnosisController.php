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

    // Proses diagnosa CF - DIPERBAIKI
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

        // Filter hanya penyebab yang memiliki nilai > 0 (Ya atau Ragu-ragu)
        $inputPenyebabFiltered = array_filter($inputPenyebab, function ($value) {
            return floatval($value) > 0;
        });

        // Jika tidak ada penyebab yang dipilih
        if (empty($inputPenyebabFiltered)) {
            return back()->with('error', 'Silakan pilih setidaknya satu penyebab dengan jawaban "Ya" atau "Ragu-ragu".');
        }

        // Ambil aturan pengetahuan berdasarkan penyebab yang dipilih
        $aturan = Pengetahuan::where('permasalahan_id', $permasalahanId)
            ->whereIn('penyebab_id', array_keys($inputPenyebabFiltered))
            ->with(['permasalahan', 'penyebab'])
            ->get();

        // Hitung CF kombinasi
        $cfCombine = null;
        $detailCalculation = [];

        foreach ($aturan as $item) {
            $cfUser = floatval($inputPenyebabFiltered[$item->penyebab_id] ?? 0);
            $mb = floatval($item->mb);
            $md = floatval($item->md);

            // Hitung CF untuk aturan ini
            $cfRule = ($mb - $md) * $cfUser;

            // Simpan detail perhitungan
            $detailCalculation[] = [
                'penyebab' => $item->penyebab->nama,
                'cf_user' => $cfUser,
                'mb' => $mb,
                'md' => $md,
                'cf_rule' => $cfRule
            ];

            // Kombinasi CF
            if (is_null($cfCombine)) {
                $cfCombine = $cfRule;
            } else {
                $cfCombine = $cfCombine + ($cfRule * (1 - $cfCombine));
            }
        }

        // Ambil informasi permasalahan
        $permasalahan = PermasalahanKulit::find($permasalahanId);

        $hasilDiagnosa = [
            'permasalahan' => $permasalahan->nama_permasalahan ?? 'Tidak Diketahui',
            'saran'        => $permasalahan->saran ?? '-',
            'cf'           => $cfCombine ?? 0,
            'cf_percentage' => round(($cfCombine ?? 0) * 100, 2),
        ];

        // Ambil daftar penyebab yang dipilih dengan jawaban Ya/Ragu-ragu
        $penyebabDipilih = [];
        foreach ($inputPenyebabFiltered as $id => $cfUser) {
            $penyebab = Penyebab::find($id);
            if ($penyebab) {
                $jawaban = '';
                if ($cfUser == 1.0) {
                    $jawaban = 'Ya';
                } elseif ($cfUser == 0.5) {
                    $jawaban = 'Ragu-ragu';
                }

                $penyebabDipilih[] = [
                    'nama'    => $penyebab->nama,
                    'cf_user' => floatval($cfUser),
                    'jawaban' => $jawaban,
                ];
            }
        }

        // Simpan hasil ke session untuk keperluan debugging atau riwayat
        session([
            'last_diagnosis' => [
                'hasil' => $hasilDiagnosa,
                'penyebab' => $penyebabDipilih,
                'detail_calculation' => $detailCalculation
            ]
        ]);

        return view('user.diagnosa.hasil', compact('hasilDiagnosa', 'penyebabDipilih'));
    }

    // Diagnosa ulang
    public function diagnosaUlang()
    {
        if (!session()->has('nama')) {
            return redirect()->route('diagnosa.data_form')->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        session()->forget(['permasalahan_id', 'last_diagnosis']);
        return redirect()->route('diagnosa.permasalahan_form');
    }
}
