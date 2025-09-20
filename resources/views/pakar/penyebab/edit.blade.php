@extends('layouts.pakar')

@section('content')
<div class="container">
    <h1>Edit Penyebab</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pakar.penyebab.update', $penyebab->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode" class="form-label">Kode Penyebab</label>
            <input type="text" name="kode" id="kode" 
                   class="form-control" 
                   value="{{ old('kode', $penyebab->kode) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penyebab</label>
            <input type="text" name="nama" id="nama" 
                   class="form-control" 
                   value="{{ old('nama', $penyebab->nama) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pakar.penyebab.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
