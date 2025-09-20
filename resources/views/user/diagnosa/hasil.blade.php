@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-sm p-4 w-100" style="max-width: 700px; border-radius:12px;">
        <h3 class="text-center mb-4">Hasil Diagnosa Kulit</h3>

        {{-- Data Diri --}}
        <h5 class="mb-3">Data Diri</h5>
        <table class="table table-bordered table-sm mb-4">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ session('nama') ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>{{ session('usia') ?? '-' }} tahun</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ session('jenis_kelamin') ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Hasil Diagnosa --}}
        <h5 class="mb-3">Hasil Diagnosa</h5>
        <table class="table table-bordered table-sm mb-4">
            <tbody>
                <tr>
                    <th>Permasalahan Kulit</th>
                    <td>{{ $hasilDiagnosa['permasalahan'] ?? 'Tidak Diketahui' }}</td>
                </tr>
                <tr>
                    <th>Persentase Keyakinan (CF)</th>
                    <td>
                        <span class="badge bg-success">
                            {{ isset($hasilDiagnosa['cf']) ? round($hasilDiagnosa['cf'] * 100, 2) : 0 }}%
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Saran</th>
                    <td>{{ $hasilDiagnosa['saran'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Penyebab yang Dipilih --}}
        <h5 class="mb-3">Penyebab yang Dipilih</h5>
        @if(!empty($penyebabDipilih))
            <ul class="list-group mb-4">
                @foreach($penyebabDipilih as $p)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $p['nama'] }}
                        <span class="badge bg-primary">{{ $p['cf_user'] }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>- Tidak ada penyebab dipilih -</p>
        @endif

        {{-- Tombol diagnosa ulang --}}
        <div class="text-center">
            <a href="{{ route('diagnosa.ulang') }}" class="btn btn-primary">Diagnosa Ulang</a>
        </div>
    </div>
</div>
@endsection
