@extends('layouts.pakar') 

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Penyebab</h1>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
    <form action="{{ route('pakar.penyebab.store') }}" method="POST">
        @csrf
        <div class="mb-3">
    <label for="kode" class="form-label">Kode Penyebab</label>
    <input type="text" name="kode" class="form-control" value="{{ $kodeBaru }}" readonly>
</div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penyebab</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="" value="{{ old('nama') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pakar.penyebab.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
