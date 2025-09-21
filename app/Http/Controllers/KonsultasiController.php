<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    // Tampilkan form permintaan konsultasi
    public function create()
    {
        // Ambil data session dari diagnosa
        $sessionData = [
            'nama' => session('nama'),
            'usia' => session('usia'),
            'jenis_kelamin' => session('jenis_kelamin'),
            'permasalahan_id' => session('permasalahan_id'),
        ];

        // Jika tidak ada data session, redirect ke form diagnosa
        if (!$sessionData['nama']) {
            return redirect()->route('diagnosa.data_form')
                ->with('error', 'Silakan lakukan diagnosa terlebih dahulu.');
        }

        return view('user.konsultasi.create', compact('sessionData'));
    }

    // Simpan permintaan konsultasi
    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string|min:10',
            'permasalahan_kulit' => 'required|string',
        ]);

        // Ambil hasil diagnosa terakhir dari session
        $lastDiagnosis = session('last_diagnosis');
        $hasilDiagnosa = $lastDiagnosis ? json_encode($lastDiagnosis['hasil']) : null;

        $konsultasi = Konsultasi::create([
            'user_id' => Auth::id(),
            'nama_pasien' => session('nama'),
            'usia' => session('usia'),
            'jenis_kelamin' => session('jenis_kelamin'),
            'permasalahan_kulit' => $request->permasalahan_kulit,
            'keluhan' => $request->keluhan,
            'hasil_diagnosa' => $hasilDiagnosa,
            'status' => 'menunggu'
        ]);

        return redirect()->route('konsultasi.status', $konsultasi->id)
            ->with('success', 'Permintaan konsultasi berhasil dikirim! Silakan tunggu konfirmasi dari pakar.');
    }

    // Status konsultasi user
    public function status($id)
    {
        $konsultasi = Konsultasi::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('pakar')
            ->firstOrFail();

        return view('user.konsultasi.status', compact('konsultasi'));
    }

    // Daftar konsultasi user
    public function userKonsultasi()
    {
        $konsultasis = Konsultasi::where('user_id', Auth::id())
            ->with('pakar')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.konsultasi.index', compact('konsultasis'));
    }

    // PAKAR SECTION

    // Daftar permintaan konsultasi untuk pakar
    public function pakarIndex(Request $request)
    {
        $status = $request->get('status', 'menunggu');

        $konsultasis = Konsultasi::with(['user', 'pakar'])
            ->byStatus($status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pakar.konsultasi.index', compact('konsultasis', 'status'));
    }

    // Detail konsultasi untuk pakar
    public function pakarShow($id)
    {
        $konsultasi = Konsultasi::with(['user'])->findOrFail($id);

        // Parse hasil diagnosa jika ada
        $hasilDiagnosa = null;
        if ($konsultasi->hasil_diagnosa) {
            $hasilDiagnosa = json_decode($konsultasi->hasil_diagnosa, true);
        }

        return view('pakar.konsultasi.show', compact('konsultasi', 'hasilDiagnosa'));
    }

    // Konfirmasi konsultasi oleh pakar
    public function pakarKonfirmasi(Request $request, $id)
    {
        $request->validate([
            'tanggal_konsultasi' => 'required|date|after:now',
            'catatan_pakar' => 'nullable|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);

        // Generate nomor antrian
        $noAntrian = Konsultasi::generateNoAntrian();

        $konsultasi->update([
            'pakar_id' => Auth::id(),
            'no_antrian' => $noAntrian,
            'status' => 'dikonfirmasi',
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'catatan_pakar' => $request->catatan_pakar,
        ]);

        return redirect()->route('pakar.konsultasi.index')
            ->with('success', "Konsultasi dikonfirmasi dengan nomor antrian: {$noAntrian}");
    }

    // Selesaikan konsultasi
    public function pakarSelesai(Request $request, $id)
    {
        $request->validate([
            'catatan_pakar' => 'required|string|min:10',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => 'selesai',
            'catatan_pakar' => $request->catatan_pakar,
        ]);

        return redirect()->route('pakar.konsultasi.index')
            ->with('success', 'Konsultasi berhasil diselesaikan.');
    }

    // Batalkan konsultasi
    public function pakarBatal(Request $request, $id)
    {
        $request->validate([
            'catatan_pakar' => 'required|string|min:5',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => 'dibatalkan',
            'catatan_pakar' => $request->catatan_pakar,
        ]);

        return redirect()->route('pakar.konsultasi.index')
            ->with('success', 'Konsultasi dibatalkan.');
    }
}
