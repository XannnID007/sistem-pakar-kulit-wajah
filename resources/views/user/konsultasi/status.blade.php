@extends('layouts.app')

@section('content')
    <style>
        .status-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: calc(100vh - 120px);
            padding: 2rem 0;
        }

        .status-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
        }

        .status-header {
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .status-menunggu .status-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .status-dikonfirmasi .status-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .status-selesai .status-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .status-dibatalkan .status-header {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .status-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .status-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .status-subtitle {
            opacity: 0.9;
            font-size: 1rem;
        }

        .status-content {
            padding: 2rem;
        }

        .info-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-table {
            background: #f9fafb;
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .info-table th {
            background: #e5e7eb;
            color: #374151;
            font-weight: 600;
            padding: 1rem;
            border: none;
            width: 35%;
        }

        .info-table td {
            padding: 1rem;
            border: none;
            background: white;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-menunggu-badge {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-dikonfirmasi-badge {
            background: #dcfdf7;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-selesai-badge {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .status-dibatalkan-badge {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .antrian-box {
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
            border: 2px solid #10b981;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            margin: 1.5rem 0;
        }

        .antrian-number {
            font-size: 3rem;
            font-weight: 700;
            color: #059669;
            margin-bottom: 0.5rem;
        }

        .antrian-label {
            color: #065f46;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .catatan-box {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .catatan-box h6 {
            color: #0369a1;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .action-buttons {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .btn-action {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .status-container {
                padding: 1rem;
            }

            .status-content {
                padding: 1.5rem;
            }

            .status-header {
                padding: 1.5rem;
            }

            .status-title {
                font-size: 1.5rem;
            }

            .antrian-number {
                font-size: 2.5rem;
            }

            .info-table th,
            .info-table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="status-container">
        <div class="container">
            <div class="status-card status-{{ $konsultasi->status }}">
                <!-- Header -->
                <div class="status-header">
                    <div class="status-icon">
                        @if ($konsultasi->status === 'menunggu')
                            <i class="fas fa-clock"></i>
                        @elseif($konsultasi->status === 'dikonfirmasi')
                            <i class="fas fa-check-circle"></i>
                        @elseif($konsultasi->status === 'selesai')
                            <i class="fas fa-flag-checkered"></i>
                        @else
                            <i class="fas fa-times-circle"></i>
                        @endif
                    </div>
                    <h1 class="status-title">
                        @if ($konsultasi->status === 'menunggu')
                            Menunggu Konfirmasi
                        @elseif($konsultasi->status === 'dikonfirmasi')
                            Konsultasi Dikonfirmasi
                        @elseif($konsultasi->status === 'selesai')
                            Konsultasi Selesai
                        @else
                            Konsultasi Dibatalkan
                        @endif
                    </h1>
                    <p class="status-subtitle">
                        @if ($konsultasi->status === 'menunggu')
                            Permintaan konsultasi Anda sedang ditinjau oleh pakar
                        @elseif($konsultasi->status === 'dikonfirmasi')
                            Konsultasi Anda telah dijadwalkan
                        @elseif($konsultasi->status === 'selesai')
                            Terima kasih telah menggunakan layanan konsultasi kami
                        @else
                            Mohon maaf, konsultasi Anda tidak dapat dilanjutkan
                        @endif
                    </p>
                </div>

                <div class="status-content">
                    <!-- Informasi Konsultasi -->
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="fas fa-info-circle" style="color: #0ea5e9;"></i>
                            Informasi Konsultasi
                        </h5>
                        <table class="table info-table">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-user me-2"></i>Nama Pasien</th>
                                    <td>{{ $konsultasi->nama_pasien }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Tanggal Pengajuan</th>
                                    <td>{{ $konsultasi->created_at->format('d M Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-flag me-2"></i>Status</th>
                                    <td>
                                        <span class="status-badge status-{{ $konsultasi->status }}-badge">
                                            @if ($konsultasi->status === 'menunggu')
                                                <i class="fas fa-clock"></i> Menunggu
                                            @elseif($konsultasi->status === 'dikonfirmasi')
                                                <i class="fas fa-check"></i> Dikonfirmasi
                                            @elseif($konsultasi->status === 'selesai')
                                                <i class="fas fa-flag-checkered"></i> Selesai
                                            @else
                                                <i class="fas fa-times"></i> Dibatalkan
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @if ($konsultasi->pakar)
                                    <tr>
                                        <th><i class="fas fa-user-md me-2"></i>Pakar</th>
                                        <td>{{ $konsultasi->pakar->name }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Nomor Antrian (jika dikonfirmasi) -->
                    @if ($konsultasi->status === 'dikonfirmasi' && $konsultasi->no_antrian)
                        <div class="antrian-box">
                            <div class="antrian-number">{{ $konsultasi->no_antrian }}</div>
                            <div class="antrian-label">Nomor Antrian Anda</div>
                        </div>
                    @endif

                    <!-- Jadwal Konsultasi (jika dikonfirmasi) -->
                    @if ($konsultasi->status === 'dikonfirmasi' && $konsultasi->tanggal_konsultasi)
                        <div class="info-section">
                            <h5 class="section-title">
                                <i class="fas fa-calendar-check" style="color: #10b981;"></i>
                                Jadwal Konsultasi
                            </h5>
                            <table class="table info-table">
                                <tbody>
                                    <tr>
                                        <th><i class="fas fa-calendar me-2"></i>Tanggal & Waktu</th>
                                        <td>
                                            <strong>{{ $konsultasi->tanggal_konsultasi->format('d M Y, H:i') }} WIB</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Detail Keluhan -->
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="fas fa-comment-medical" style="color: #f59e0b;"></i>
                            Detail Keluhan
                        </h5>
                        <div class="catatan-box" style="border-color: #f59e0b; background: #fffbeb;">
                            <p class="mb-0">{{ $konsultasi->keluhan }}</p>
                        </div>
                    </div>

                    <!-- Catatan Pakar (jika ada) -->
                    @if ($konsultasi->catatan_pakar)
                        <div class="info-section">
                            <h5 class="section-title">
                                <i class="fas fa-notes-medical" style="color: #0ea5e9;"></i>
                                Catatan Pakar
                            </h5>
                            <div class="catatan-box">
                                <p class="mb-0">{{ $konsultasi->catatan_pakar }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('konsultasi.user') }}" class="btn-action">
                        <i class="fas fa-list"></i>
                        Lihat Riwayat Konsultasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if ($konsultasi->status === 'menunggu')
        <script>
            // Auto refresh setiap 30 detik untuk status menunggu
            setTimeout(function() {
                location.reload();
            }, 30000);
        </script>
    @endif
@endsection
