@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card p-4 w-100" style="max-width: 500px; border-radius:12px;">
        <h5 class="text-center mb-3">Pilih Permasalahan Kulit</h5>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('diagnosa.penyebab_form') }}" method="POST">
            @csrf
            <div class="mb-3">
                @foreach($permasalahans as $permasalahan)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" 
                               name="permasalahan_id" 
                               id="permasalahan_{{ $permasalahan->id }}" 
                               value="{{ $permasalahan->id }}" required>
                        <label class="form-check-label" for="permasalahan_{{ $permasalahan->id }}">
                            {{ $permasalahan->nama_permasalahan }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary w-100">Lanjut ke Penyebab</button>
        </form>
    </div>
</div>
@endsection
