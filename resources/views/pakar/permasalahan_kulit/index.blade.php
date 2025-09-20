@extends('layouts.pakar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-ul me-2"></i> Data Permasalahan Kulit</h4>
                    <a href="{{ route('pakar.permasalahan_kulit.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Permasalahan
                    </a>
                </div>
                <div class="card-body">

                    {{-- Pesan sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel daftar permasalahan --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 10%">Kode</th>
                                    <th style="width: 25%">Nama Permasalahan</th>
                                    <th style="width: 35%">Saran</th>
                                    <th style="width: 30%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permasalahan as $item)
                                    <tr>
                                        <td><span class="badge bg-secondary">{{ $item->kode }}</span></td>
                                        <td>{{ $item->nama_permasalahan }}</td>
                                        <td>{{ $item->saran }}</td>
                                        <td class="text-center">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('pakar.permasalahan_kulit.edit', $item->id) }}" 
                                               class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('pakar.permasalahan_kulit.destroy', $item->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus permasalahan ini?')">
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
                                        <td colspan="4" class="text-center text-muted">
                                            <i class="bi bi-info-circle"></i> Belum ada data permasalahan kulit
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
