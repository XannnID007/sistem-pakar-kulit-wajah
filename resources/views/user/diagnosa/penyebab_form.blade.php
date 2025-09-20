@extends('layouts.app')

@section('content')
<style>
    .card {
        margin-top: 80px;
        border-radius: 12px;
    }

    .question-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 15px;
        background-color: #f8f9fa;
    }

    .btn-choice {
        flex: 1;
        margin-right: 5px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .btn-choice:last-child {
        margin-right: 0;
    }

    .btn-choice.active {
        background-color: #0d6efd;
        color: #221f1fff;
        border-color: #0d6efd;
    }

    .btn-group-choice {
        display: flex;
        gap: 5px;
    }
</style>

<div class="container d-flex justify-content-center align-items-start">
    <div class="card shadow-sm p-4 w-100" style="max-width: 700px;">
        <form method="POST" action="{{ route('diagnosa.proses') }}">
            @csrf
            <h4 class="text-center mb-4">Pilih Penyebab Kulit yang Dialami</h4>

            @forelse($penyebabs as $index => $penyebab)
                <div class="question-card">
                    <p><strong>{{ $index + 1 }}. Apakah kulit mengalami {{ $penyebab->nama }}?</strong></p>
                    <div class="btn-group-choice">
                        <input type="radio" class="btn-check" name="penyebab[{{ $penyebab->kode }}]" id="ya_{{ $penyebab->kode }}" value="1.0" required autocomplete="off">
                        <label class="btn btn-outline-primary btn-choice" for="ya_{{ $penyebab->kode }}">Ya</label>

                        <input type="radio" class="btn-check" name="penyebab[{{ $penyebab->kode }}]" id="ragu_{{ $penyebab->kode }}" value="0.5" required autocomplete="off">
                        <label class="btn btn-outline-warning btn-choice" for="ragu_{{ $penyebab->kode }}">Ragu-ragu</label>

                        <input type="radio" class="btn-check" name="penyebab[{{ $penyebab->kode }}]" id="tidak_{{ $penyebab->kode }}" value="0.0" required autocomplete="off">
                        <label class="btn btn-outline-secondary btn-choice" for="tidak_{{ $penyebab->kode }}">Tidak</label>
                    </div>
                </div>
            @empty
                <p class="text-danger">Tidak ada data penyebab.</p>
            @endforelse

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success btn-lg">Proses Diagnosa</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Aktifkan highlight saat radio dipilih
    document.querySelectorAll('.btn-check').forEach(input => {
        input.addEventListener('change', function() {
            const group = this.closest('.btn-group-choice');
            group.querySelectorAll('label').forEach(lbl => lbl.classList.remove('active'));
            group.querySelector(`label[for="${this.id}"]`).classList.add('active');
        });
    });
</script>
@endsection
