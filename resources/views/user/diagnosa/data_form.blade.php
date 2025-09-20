@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-4">
    <div class="card shadow-sm p-3 w-100" style="max-width: 400px; border-radius: 10px;">
        <h5 class="text-center mb-3">
            <i class="bi bi-person-fill me-1 text-primary"></i>
            Data Diri
        </h5>

        <form action="{{ route('diagnosa.data_form') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label for="nama" class="form-label small">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control form-control-sm" value="{{ old('nama') }}" required>
            </div>

            <div class="mb-2">
                <label for="usia" class="form-label small">Usia (tahun)</label>
                <input type="number" id="usia" name="usia" class="form-control form-control-sm" value="{{ old('usia') }}" min="0" required>
            </div>

            <div class="mb-2">
                <label for="jenis_kelamin" class="form-label small">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-sm" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-arrow-right-circle me-1"></i> Lanjut ke Diagnosa
            </button>
        </form>
    </div>
</div>
@endsection
