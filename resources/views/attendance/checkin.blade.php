@extends('layouts.app')

@section('title', 'Check In/Out - HRIS V2')
@section('page-title', 'Check In / Check Out')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0"><i class="fas fa-fingerprint me-2"></i>Presensi Hari Ini</h5>
            </div>
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                    <h4>{{ $status->nama }}</h4>
                    <p class="text-muted">{{ $status->nik }}</p>
                </div>

                <div class="mb-4">
                    <div class="display-4 fw-bold text-primary" id="jam-sekarang">{{ $status->jam_sekarang }}</div>
                    <p class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                </div>

                @if($status->sudah_checkin)
                    <div class="alert alert-info">
                        <i class="fas fa-check-circle me-2"></i>
                        Sudah Check In jam <strong>{{ $status->jam_checkin }}</strong>
                    </div>

                    <form action="{{ route('attendance.checkin.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis" value="checkout">
                        <button type="submit" class="btn btn-danger btn-lg px-5 py-3">
                            <i class="fas fa-sign-out-alt me-2"></i>Check Out
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-clock me-2"></i>
                        Jam masuk: <strong>{{ $status->jam_masuk }}</strong>
                    </div>

                    <form action="{{ route('attendance.checkin.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis" value="checkin">
                        <button type="submit" class="btn btn-success btn-lg px-5 py-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Check In
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setInterval(function() {
        var now = new Date();
        var time = now.toLocaleTimeString('id-ID');
        document.getElementById('jam-sekarang').textContent = time;
    }, 1000);
</script>
@endpush
@endsection
