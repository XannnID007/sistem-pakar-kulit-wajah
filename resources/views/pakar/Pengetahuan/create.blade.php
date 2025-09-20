@extends('layouts.pakar')

@section('content')
<div class="container mt-4">
    <h3>Tambah Pengetahuan Baru</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pakar.pengetahuan.store') }}" method="POST">
        @csrf

        {{-- Pilih Permasalahan Kulit --}}
        <div class="mb-3">
            <label for="permasalahan_id" class="form-label">Permasalahan Kulit</label>
            <select name="permasalahan_id" id="permasalahan_id" class="form-control" required>
                <option value="">-- Pilih Permasalahan --</option>
                @foreach($permasalahans as $permasalahan)
                    <option value="{{ $permasalahan->id }}" {{ old('permasalahan_id') == $permasalahan->id ? 'selected' : '' }}>
                        {{ $permasalahan->nama_permasalahan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Penyebab --}}
        <div class="mb-3">
            <label for="penyebab_id" class="form-label">Penyebab</label>
            <select name="penyebab_id" id="penyebab_id" class="form-control" required>
                <option value="">-- Pilih Penyebab --</option>
                @foreach($penyebabs as $penyebab)
                    <option value="{{ $penyebab->id }}" {{ old('penyebab_id') == $penyebab->id ? 'selected' : '' }}>
                        {{ $penyebab->nama}}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nilai MB --}}
        <div class="mb-3">
            <label for="mb" class="form-label">MB (0 - 1)</label>
            <input type="number" step="0.1" min="0" max="1"
                   class="form-control" id="mb" name="mb"
                   value="{{ old('mb') }}" required>
        </div>

        {{-- Nilai MD --}}
        <div class="mb-3">
            <label for="md" class="form-label">MD (0 - 1)</label>
            <input type="number" step="0.1" min="0" max="1"
                   class="form-control" id="md" name="md"
                   value="{{ old('md') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
