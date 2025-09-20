@extends('layouts.pakar')

@section('content')
<div class="container">
    <h1>Data Penyebab</h1>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol tambah gejala --}}
    <a href="{{ route('pakar.gejala.create') }}" class="btn btn-primary mb-3">Tambah Penyebab</a>

    {{-- Tabel daftar Penyebab --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Penyebab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gejalas as $gejala)
                <tr>
                    <td>{{ $gejala->kode }}</td>
                    <td>{{ $gejala->nama }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('pakar.gejala.edit', $gejala->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('pakar.gejala.destroy', $gejala->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus gejala ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
