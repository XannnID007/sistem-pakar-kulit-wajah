@extends('layouts.pakar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-ul me-2"></i> Data Pengetahuan</h4>
                    <a href="{{ route('pakar.pengetahuan.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Pengetahuan
                    </a>
                </div>
                <div class="card-body">

                    {{-- Pesan sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form pencarian --}}
                    <form method="GET" action="{{ route('pakar.pengetahuan.index') }}" class="mb-3 d-flex justify-content-end" style="max-width: 400px;">
                        <div class="input-group">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control" 
                                placeholder="Cari penyebab atau permasalahan kulit..." 
                                value="{{ request('search') }}"
                            >
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </form>

                    {{-- Tabel daftar pengetahuan --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th style="width: 25%">Penyebab</th>
                                    <th style="width: 25%">Permasalahan Kulit</th>
                                    <th style="width: 10%">MB</th>
                                    <th style="width: 10%">MD</th>
                                    <th style="width: 30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengetahuans as $item)
                                    <tr>
                                        <td>
                                            {{-- Tampilkan kode dan nama penyebab --}}
                                            <span class="badge bg-secondary">{{ $item->penyebab->kode ?? '-' }}</span>
                                            {{ $item->penyebab->nama ?? 'Tidak ada data penyebab' }}
                                        </td>
                                        <td>
                                            {{-- Tampilkan kode dan nama permasalahan kulit --}}
                                            <span class="badge bg-info text-dark">{{ $item->permasalahan->kode ?? '-' }}</span>
                                            {{ $item->permasalahan->nama_permasalahan ?? 'Tidak ada data permasalahan' }}
                                        </td>
                                       <td class="text-center">{{ rtrim(rtrim($item->mb, '0'), '.') }}</td>
<td class="text-center">{{ rtrim(rtrim($item->md, '0'), '.') }}</td>

                                        <td class="text-center">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('pakar.pengetahuan.edit', $item->id) }}" 
                                               class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('pakar.pengetahuan.destroy', $item->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            <i class="bi bi-info-circle"></i> Belum ada data pengetahuan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
