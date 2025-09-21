@extends('layouts.pakar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-dark mb-0">
                        <i class="fas fa-user-md me-2 text-primary"></i>
                        Manajemen Konsultasi
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .btn-group-sm>.btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .modal-header.bg-success,
        .modal-header.bg-danger,
        .modal-header.bg-info {
            border-bottom: none;
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
        }
    </style>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.createElement('div');
                toast.className =
                    'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
                toast.setAttribute('role', 'alert');
                toast.style.zIndex = '9999';
                toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
                document.body.appendChild(toast);

                const bsToast = new bootstrap.Toast(toast, {
                    autohide: true,
                    delay: 5000
                });
                bsToast.show();

                toast.addEventListener('hidden.bs.toast', function() {
                    toast.remove();
                });
            });
        </script>
    @endif
@endsection
