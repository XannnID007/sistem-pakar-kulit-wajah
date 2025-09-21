@extends('layouts.app')

@section('content')
    <style>
        .result-container {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
            min-height: calc(100vh - 120px);
            padding: 2rem 0;
        }

        .result-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(102, 126, 234, 0.1);
            overflow: hidden;
        }

        .result-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .result-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="50%"><stop offset="0%" stop-color="%23fff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23fff" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }

        .result-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .result-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .result-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .result-content {
            padding: 2rem;
        }

        .info-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-icon {
            color: #667eea;
        }

        .info-table {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .info-table th {
            background: #667eea;
            color: white;
            font-weight: 500;
            padding: 1rem;
            border: none;
            width: 30%;
        }

        .info-table td {
            padding: 1rem;
            border: none;
            background: white;
        }

        .cf-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .cf-high {
            background: linear-gradient(45deg, #10b981, #34d399);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .cf-medium {
            background: linear-gradient(45deg, #f59e0b, #fbbf24);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .cf-low {
            background: linear-gradient(45deg, #ef4444, #f87171);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .penyebab-grid {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .penyebab-item {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            justify-content: between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .penyebab-item:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .penyebab-name {
            flex: 1;
            font-weight: 500;
            color: #374151;
        }

        .penyebab-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .badge-ya {
            background: #dcfdf7;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-ragu {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .action-buttons {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .btn-diagnosa-ulang {
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
            font-size: 1.1rem;
        }

        .btn-diagnosa-ulang:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
            text-decoration: none;
        }

        .saran-box {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            border: 2px solid #0ea5e9;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .saran-icon {
            color: #0ea5e9;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .result-content {
                padding: 1rem;
            }

            .result-header {
                padding: 1.5rem;
            }

            .result-title {
                font-size: 1.5rem;
            }

            .info-table th,
            .info-table td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            .penyebab-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>

    <div class="result-container">
        <div class="container d-flex justify-content-center">
            <div class="result-card w-100" style="max-width: 800px;">

                <!-- Header -->
                <div class="result-header">
                    <div class="result-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h1 class="result-title">Hasil Diagnosa Kulit</h1>
                    <p class="result-subtitle">Analisis lengkap kondisi kulit Anda</p>
                </div>

                <div class="result-content">
                    <!-- Data Diri -->
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="fas fa-user section-icon"></i>
                            Data Diri
                        </h5>
                        <table class="table info-table">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-id-card me-2"></i>Nama</th>
                                    <td>{{ session('nama') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-birthday-cake me-2"></i>Usia</th>
                                    <td>{{ session('usia') ?? '-' }} tahun</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</th>
                                    <td>{{ session('jenis_kelamin') ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Hasil Diagnosa -->
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="fas fa-stethoscope section-icon"></i>
                            Hasil Diagnosa
                        </h5>
                        <table class="table info-table">
                            <tbody>
                                <tr>
                                    <th><i class="fas fa-exclamation-triangle me-2"></i>Permasalahan</th>
                                    <td><strong>{{ $hasilDiagnosa['permasalahan'] ?? 'Tidak Diketahui' }}</strong></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-chart-line me-2"></i>Tingkat Keyakinan</th>
                                    <td>
                                        @php
                                            $cfPercentage = $hasilDiagnosa['cf_percentage'] ?? 0;
                                            $cfClass = 'cf-low';
                                            $cfIcon = 'fa-arrow-down';

                                            if ($cfPercentage >= 75) {
                                                $cfClass = 'cf-high';
                                                $cfIcon = 'fa-arrow-up';
                                            } elseif ($cfPercentage >= 50) {
                                                $cfClass = 'cf-medium';
                                                $cfIcon = 'fa-arrow-right';
                                            }
                                        @endphp
                                        <span class="cf-badge {{ $cfClass }}">
                                            <i class="fas {{ $cfIcon }}"></i>
                                            {{ $cfPercentage }}%
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @if (!empty($hasilDiagnosa['saran']) && $hasilDiagnosa['saran'] !== '-')
                            <div class="saran-box">
                                <h6 class="mb-2">
                                    <i class="fas fa-lightbulb saran-icon"></i>
                                    Saran Perawatan
                                </h6>
                                <p class="mb-0">{{ $hasilDiagnosa['saran'] }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Penyebab yang Dipilih -->
                    <div class="info-section">
                        <h5 class="section-title">
                            <i class="fas fa-list-check section-icon"></i>
                            Penyebab yang Dipilih
                        </h5>

                        @if (!empty($penyebabDipilih) && count($penyebabDipilih) > 0)
                            <div class="penyebab-grid">
                                @foreach ($penyebabDipilih as $index => $p)
                                    <div class="penyebab-item">
                                        <div class="penyebab-name">
                                            <i class="fas fa-check-circle me-2 text-success"></i>
                                            {{ $p['nama'] }}
                                        </div>
                                        <div>
                                            @if ($p['jawaban'] === 'Ya')
                                                <span class="penyebab-badge badge-ya">
                                                    <i class="fas fa-check me-1"></i>Ya
                                                </span>
                                            @elseif($p['jawaban'] === 'Ragu-ragu')
                                                <span class="penyebab-badge badge-ragu">
                                                    <i class="fas fa-question me-1"></i>Ragu-ragu
                                                </span>
                                            @endif
                                            <small class="text-muted ms-2">(CF: {{ $p['cf_user'] }})</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <p>Tidak ada penyebab yang dipilih</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('diagnosa.ulang') }}" class="btn-diagnosa-ulang">
                        <i class="fas fa-redo-alt"></i>
                        Diagnosa Ulang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
