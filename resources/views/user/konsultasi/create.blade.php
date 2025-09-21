@extends('layouts.app')

@section('content')
    <style>
        .consultation-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: calc(100vh - 120px);
            padding: 2rem 0;
        }

        .consultation-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(14, 165, 233, 0.1);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }

        .consultation-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .consultation-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="50%"><stop offset="0%" stop-color="%23fff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23fff" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }

        .consultation-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .consultation-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .consultation-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            background-color: white;
        }

        .form-control:read-only {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .textarea-keluhan {
            min-height: 120px;
            resize: vertical;
        }

        .info-box {
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
            border: 2px solid #10b981;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-icon {
            color: #10b981;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .btn-submit {
            background: linear-gradient(45deg, #0ea5e9, #0284c7);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.3);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .data-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .data-preview h6 {
            color: #374151;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .data-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .data-item:last-child {
            border-bottom: none;
        }

        .data-label {
            font-weight: 500;
            color: #6b7280;
        }

        .data-value {
            font-weight: 600;
            color: #374151;
        }

        @media (max-width: 768px) {
            .consultation-container {
                padding: 1rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .consultation-header {
                padding: 1.5rem;
            }

            .consultation-title {
                font-size: 1.5rem;
            }

            .data-item {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>

    <div class="consultation-container">
        <div class="container">
            <div class="consultation-card">
                <!-- Header -->
                <div class="consultation-header">
                    <div class="consultation-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h1 class="consultation-title">Permintaan Konsultasi</h1>
                    <p class="consultation-subtitle">Konsultasikan hasil diagnosa Anda dengan pakar</p>
                </div>

                <div class="form-container">
                    <!-- Info Box -->
                    <div class="info-box">
                        <h6 class="mb-2">
                            <i class="fas fa-info-circle info-icon"></i>
                            Informasi Konsultasi
                        </h6>
                        <p class="mb-0">
                            Setelah Anda mengirim permintaan konsultasi, pakar akan meninjau kasus Anda dan memberikan
                            konfirmasi beserta nomor antrian untuk jadwal konsultasi.
                        </p>
                    </div>

                    <!-- Data Preview -->
                    <div class="data-preview">
                        <h6><i class="fas fa-user me-2"></i>Data Diri Anda</h6>
                        <div class="data-item">
                            <span class="data-label">Nama:</span>
                            <span class="data-value">{{ $sessionData['nama'] ?? '-' }}</span>
                        </div>
                        <div class="data-item">
                            <span class="data-label">Usia:</span>
                            <span class="data-value">{{ $sessionData['usia'] ?? '-' }} tahun</span>
                        </div>
                        <div class="data-item">
                            <span class="data-label">Jenis Kelamin:</span>
                            <span class="data-value">{{ $sessionData['jenis_kelamin'] ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('konsultasi.store') }}" method="POST">
                        @csrf

                        <!-- Permasalahan Kulit -->
                        <div class="form-group">
                            <label for="permasalahan_kulit" class="form-label">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Permasalahan Kulit
                            </label>
                            <input type="text" id="permasalahan_kulit" name="permasalahan_kulit" class="form-control"
                                value="{{ session('last_diagnosis.hasil.permasalahan') ?? 'Tidak Diketahui' }}" readonly>
                        </div>

                        <!-- Keluhan Detail -->
                        <div class="form-group">
                            <label for="keluhan" class="form-label">
                                <i class="fas fa-comment-medical me-1"></i>
                                Keluhan Detail <span class="text-danger">*</span>
                            </label>
                            <textarea id="keluhan" name="keluhan" class="form-control textarea-keluhan"
                                placeholder="Jelaskan keluhan Anda secara detail, seperti sejak kapan mengalami masalah ini, gejala yang dirasakan, atau hal lain yang ingin dikonsultasikan..."
                                required>{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Permintaan Konsultasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-resize textarea
        const textarea = document.getElementById('keluhan');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const keluhan = document.getElementById('keluhan').value.trim();

            if (keluhan.length < 10) {
                e.preventDefault();
                alert('Mohon jelaskan keluhan Anda minimal 10 karakter.');
                document.getElementById('keluhan').focus();
            }
        });
    </script>
@endsection
