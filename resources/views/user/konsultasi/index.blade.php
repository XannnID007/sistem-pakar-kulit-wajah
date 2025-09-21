@extends('layouts.app')

@section('content')
    <style>
        .konsultasi-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: calc(100vh - 120px);
            padding: 2rem 0;
        }

        .konsultasi-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .konsultasi-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .konsultasi-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .konsultasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .konsultasi-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .konsultasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-color: #0ea5e9;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }

        .card-header.status-menunggu {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-bottom-color: #f59e0b;
        }

        .card-header.status-dikonfirmasi {
            background: linear-gradient(135deg, #dcfdf7 0%, #a7f3d0 100%);
            border-bottom-color: #10b981;
        }

        .card-header.status-selesai {
            background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
            border-bottom-color: #3b82f6;
        }

        .card-header.status-dibatalkan {
            background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
            border-bottom-color: #ef4444;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-menunggu-badge {
            background: #f59e0b;
            color: white;
        }

        .status-dikonfirmasi-badge {
            background: #10b981;
            color: white;
        }

        .status-selesai-badge {
            background: #3b82f6;
            color: white;
        }

        .status-dibatalkan-badge {
            background: #ef4444;
            color: white;
        }

        .konsultasi-info h5 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .konsultasi-meta {
            color: #6b7280;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-value {
            color: #6b7280;
            text-align: right;
            flex: 1;
            margin-left: 1rem;
        }

        .antrian-highlight {
            background: linear-gradient(45deg, #10b981, #34d399);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .keluhan-preview {
            background: #f9fafb;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            border-left: 4px solid #0ea5e9;
        }

        .keluhan-text {
            color: #374151;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-actions {
            padding: 1rem 1.5rem;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .btn-detail {
            background: linear-gradient(45deg, #0ea5e9, #0284c7);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
            color: white;
            text-decoration: none;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .empty-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }

        .empty-description {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .btn-start {
            background: linear-gradient(45deg, #10b981, #34d399);
            color: white;
            padding: 1rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .konsultasi-container {
                padding: 1rem;
            }

            .konsultasi-title {
                font-size: 2rem;
            }

            .konsultasi-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .card-header,
            .card-body,
            .card-actions {
                padding: 1rem;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .info-value {
                text-align: left;
                margin-left: 0;
            }

            .status-badge {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 1rem;
            }
        }
    </style>

    <div class="konsultasi-container">
        <div class="container">
            <!-- Header -->
            <div class="konsultasi-header">
                <h1 class="konsultasi-title">
                    <i class="fas fa-user-md me-3"></i>
                    Riwayat Konsultasi
                </h1>
                <p class="konsultasi-subtitle">
                    Lihat semua konsultasi yang pernah Anda lakukan dan status terkininya
                </p>
            </div>

            <!-- Konsultasi Cards -->
            @if ($konsultasis->count() > 0)
                <div class="konsultasi-grid">
                    @foreach ($konsultasis as $konsultasi)
                        <div class="konsultasi-card">
                            <!-- Header -->
                            <div class="card-header status-{{ $konsultasi->status }}">
                                <div class="konsultasi-info">
                                    <h5>{{ $konsultasi->permasalahan_kulit }}</h5>
                                    <div class="konsultasi-meta">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $konsultasi->created_at->format('d M Y, H:i') }} WIB
                                    </div>
                                    @if ($konsultasi->pakar)
                                        <div class="konsultasi-meta">
                                            <i class="fas fa-user-md"></i>
                                            Dr. {{ $konsultasi->pakar->name }}
                                        </div>
                                    @endif
                                </div>
                                <div class="status-badge status-{{ $konsultasi->status }}-badge">
                                    @if ($konsultasi->status === 'menunggu')
                                        <i class="fas fa-clock"></i> Menunggu
                                    @elseif($konsultasi->status === 'dikonfirmasi')
                                        <i class="fas fa-check-circle"></i> Dikonfirmasi
                                    @elseif($konsultasi->status === 'selesai')
                                        <i class="fas fa-flag-checkered"></i> Selesai
                                    @else
                                        <i class="fas fa-times-circle"></i> Dibatalkan
                                    @endif
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="card-body">
                                <!-- Nomor Antrian -->
                                @if ($konsultasi->no_antrian)
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-ticket-alt"></i>
                                            Nomor Antrian
                                        </div>
                                        <div class="info-value">
                                            <span class="antrian-highlight">{{ $konsultasi->no_antrian }}</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Jadwal -->
                                @if ($konsultasi->tanggal_konsultasi)
                                    <div class="info-row">
                                        <div class="info-label">
                                            <i class="fas fa-calendar-check"></i>
                                            Jadwal Konsultasi
                                        </div>
                                        <div class="info-value">
                                            <strong>{{ $konsultasi->tanggal_konsultasi->format('d M Y') }}</strong><br>
                                            <small>{{ $konsultasi->tanggal_konsultasi->format('H:i') }} WIB</small>
                                        </div>
                                    </div>
                                @endif

                                <!-- Data Pasien -->
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-user"></i>
                                        Data Pasien
                                    </div>
                                    <div class="info-value">
                                        {{ $konsultasi->nama_pasien }}, {{ $konsultasi->usia }} tahun<br>
                                        <small>{{ $konsultasi->jenis_kelamin }}</small>
                                    </div>
                                </div>

                                <!-- Preview Keluhan -->
                                <div class="keluhan-preview">
                                    <div class="info-label mb-2">
                                        <i class="fas fa-comment-medical"></i>
                                        Keluhan
                                    </div>
                                    <div class="keluhan-text">{{ $konsultasi->keluhan }}</div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="card-actions">
                                <a href="{{ route('konsultasi.status', $konsultasi->id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada Konsultasi</h3>
                    <p class="empty-description">
                        Anda belum pernah melakukan konsultasi. Mulai diagnosa terlebih dahulu, kemudian lakukan konsultasi
                        dengan pakar.
                    </p>
                    <a href="{{ route('diagnosa.data_form') }}" class="btn-start">
                        <i class="fas fa-stethoscope"></i>
                        Mulai Diagnosa
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
