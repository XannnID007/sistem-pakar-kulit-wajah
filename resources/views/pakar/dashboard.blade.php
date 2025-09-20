@extends('layouts.pakar')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</h3>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Ringkasan Data</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Item</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><i class="fas fa-virus me-2 text-muted"></i> Penyebab</td>
                            <td class="text-end fw-bold">{{ $jumlahPenyebab }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><i class="fas fa-list-alt me-2 text-muted"></i> Permasalahan Kulit</td>
                            <td class="text-end fw-bold">{{ $jumlahPermasalahan }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><i class="fas fa-book-medical me-2 text-muted"></i> Data Pengetahuan</td>
                            <td class="text-end fw-bold">{{ $jumlahPengetahuan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
