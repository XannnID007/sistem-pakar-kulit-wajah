@extends('layouts.pakar')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Pengetahuan</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pakar.pengetahuan.update', $pengetahuan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Pilih Penyebab --}}
                        <div class="mb-3">
                            <label for="penyebab_id" class="form-label">Penyebab</label>
                            <select name="penyebab_id" id="penyebab_id" class="form-select" required>
                                <option value="">-- Pilih Penyebab --</option>
                                @foreach($penyebabs as $penyebab)
                                    <option value="{{ $penyebab->id }}" {{ $pengetahuan->penyebab_id == $penyebab->id ? 'selected' : '' }}>
                                        {{ $penyebab->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pilih Permasalahan Kulit --}}
                        <div class="mb-3">
                            <label for="permasalahan_id" class="form-label">Permasalahan Kulit</label>
                            <select name="permasalahan_id" id="permasalahan_id" class="form-select" required>
                                <option value="">-- Pilih Permasalahan --</option>
                                @foreach($permasalahans as $permasalahan)
                                    <option value="{{ $permasalahan->id }}" {{ $pengetahuan->permasalahan_id == $permasalahan->id ? 'selected' : '' }}>
                                        {{ $permasalahan->nama_permasalahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- MB --}}
                        <div class="mb-3">
                            <label for="mb" class="form-label">MB (Measure of Belief)</label>
                            <input type="number" step="0.1" min="0" max="1" name="mb" id="mb" class="form-control" value="{{ old('mb', $pengetahuan->mb) }}" required>
                        </div>

                        {{-- MD --}}
                        <div class="mb-3">
                            <label for="md" class="form-label">MD (Measure of Disbelief)</label>
                            <input type="number" step="0.1" min="0" max="1" name="md" id="md" class="form-control" value="{{ old('md', $pengetahuan->md) }}" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('pakar.pengetahuan.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
