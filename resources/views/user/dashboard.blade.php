@extends('layouts.app')

@section('content')
    <style>
        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .welcome p {
            font-size: 1.1rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .illustration {
            text-align: center;
            margin: 2rem 0;
        }

        .illustration img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .menu-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover::before {
            opacity: 0.05;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
            text-decoration: none;
            color: inherit;
        }

        .menu-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .menu-card.diagnosa .menu-icon {
            background: linear-gradient(45deg, #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .menu-card.konsultasi .menu-icon {
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .menu-card.riwayat .menu-icon {
            background: linear-gradient(45deg, #8b5cf6, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .menu-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .menu-description {
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .stats-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 20px;
            padding: 2rem;
            margin: 3rem 0;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .stat-item {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0ea5e9;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .welcome h2 {
                font-size: 1.8rem;
            }

            .menu {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 2rem;
            }

            .menu-card {
                padding: 1.5rem;
            }

            .menu-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .menu-title {
                font-size: 1.3rem;
            }

            .stats-section {
                padding: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .stat-item {
                padding: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="container">
        <div class="welcome-section">
            <div class="welcome">
                <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
                <p>Sistem pakar untuk membantu diagnosa masalah kulit wajah Anda. Pilih menu di bawah untuk memulai
                    konsultasi atau melihat riwayat sebelumnya.</p>
            </div>

            <div class="illustration">
                <img src="{{ asset('images/bg.png') }}" alt="Dokter Ilustrasi" width="300">
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="stats-section">
            <h4 class="fw-bold text-primary mb-0">
                <i class="fas fa-chart-bar me-2"></i>
                Statistik Anda
            </h4>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">
                        {{ App\Models\Konsultasi::where('user_id', Auth::id())->count() }}
                    </div>
                    <div class="stat-label">Total Konsultasi</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        {{ App\Models\Konsultasi::where('user_id', Auth::id())->where('status', 'selesai')->count() }}
                    </div>
                    <div class="stat-label">Konsultasi Selesai</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        {{ App\Models\Konsultasi::where('user_id', Auth::id())->where('status', 'menunggu')->count() }}
                    </div>
                    <div class="stat-label">Menunggu</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        {{ App\Models\Konsultasi::where('user_id', Auth::id())->where('status', 'dikonfirmasi')->count() }}
                    </div>
                    <div class="stat-label">Dikonfirmasi</div>
                </div>
            </div>
        </div>

        <!-- Main Menu -->
        <div class="menu">
            <a href="{{ route('diagnosa.data_form') }}" class="menu-card diagnosa">
                <div class="menu-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="menu-title">Mulai Diagnosa</h3>
                <p class="menu-description">
                    Lakukan diagnosa mandiri untuk mengetahui kemungkinan masalah kulit wajah yang Anda alami.
                </p>
            </a>

            <a href="{{ route('konsultasi.user') }}" class="menu-card konsultasi">
                <div class="menu-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="menu-title">Konsultasi Pakar</h3>
                <p class="menu-description">
                    Konsultasikan hasil diagnosa atau keluhan kulit Anda langsung dengan pakar berpengalaman.
                </p>
                @php
                    $konsultasiAktif = App\Models\Konsultasi::where('user_id', Auth::id())
                        ->whereIn('status', ['menunggu', 'dikonfirmasi'])
                        ->count();
                @endphp
                @if ($konsultasiAktif > 0)
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-danger rounded-pill">{{ $konsultasiAktif }}</span>
                    </div>
                @endif
            </a>

            <a href="{{ route('konsultasi.user') }}" class="menu-card riwayat">
                <div class="menu-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="menu-title">Riwayat Konsultasi</h3>
                <p class="menu-description">
                    Lihat riwayat diagnosa dan konsultasi yang pernah Anda lakukan sebelumnya.
                </p>
            </a>
        </div>

        <!-- Quick Access -->
        @php
            $konsultasiTerbaru = App\Models\Konsultasi::where('user_id', Auth::id())
                ->whereIn('status', ['menunggu', 'dikonfirmasi'])
                ->latest()
                ->first();
        @endphp

        @if ($konsultasiTerbaru)
            <div class="alert alert-info mt-4 d-flex align-items-center"
                style="border-radius: 15px; border: none; background: linear-gradient(45deg, #e0f2fe, #f0f9ff);">
                <div class="flex-grow-1">
                    <h6 class="alert-heading mb-2">
                        <i class="fas fa-info-circle me-2"></i>
                        Konsultasi Aktif
                    </h6>
                    <p class="mb-2">
                        Anda memiliki konsultasi dengan status <strong>{{ ucfirst($konsultasiTerbaru->status) }}</strong>
                        @if ($konsultasiTerbaru->no_antrian)
                            dengan nomor antrian <strong>{{ $konsultasiTerbaru->no_antrian }}</strong>
                        @endif
                    </p>
                    @if ($konsultasiTerbaru->tanggal_konsultasi)
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            Jadwal: {{ $konsultasiTerbaru->tanggal_konsultasi->format('d M Y, H:i') }} WIB
                        </small>
                    @endif
                </div>
                <div class="ms-3">
                    <a href="{{ route('konsultasi.status', $konsultasiTerbaru->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye me-1"></i>
                        Lihat Status
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
