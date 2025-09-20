@extends('layouts.pakar')

@section('content')
<div class="container">
    <h1>Edit Permasalahan Kulit</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pakar.permasalahan_kulit.update', $permasalahanKulit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ old('kode', $permasalahanKulit->kode) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_permasalahan" class="form-label">Nama Permasalahan</label>
            <input type="text" name="nama_permasalahan" class="form-control" value="{{ old('nama_permasalahan', $permasalahanKulit->nama_permasalahan) }}" required>
        </div>
        <div class="mb-3">
            <label for="saran" class="form-label">Saran</label>
            <textarea name="saran" class="form-control">{{ old('saran', $permasalahanKulit->saran) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pakar.permasalahan_kulit.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
