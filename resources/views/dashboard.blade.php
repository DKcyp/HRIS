@extends('layouts.app')

@section('title', 'Dashboard - HRIS V2')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <!-- Total Karyawan -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Karyawan</div>
                    <div class="stat-value">{{ $totalKaryawan ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-users fa-3x text-primary opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Karyawan Baru -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Karyawan Baru (Bulan Ini)</div>
                    <div class="stat-value">{{ $karyawanBaru ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-user-plus fa-3x text-success opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Karyawan Resign -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Resign (Bulan Ini)</div>
                    <div class="stat-value">{{ $karyawanResign ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-user-minus fa-3x text-danger opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kontrak Habis -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Kontrak Habis (30 Hari)</div>
                    <div class="stat-value">{{ $kontrakHabis ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-exclamation-triangle fa-3x text-warning opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Row -->
<div class="row g-4 mb-4">
    <!-- Absensi Hari Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Hadir Hari Ini</div>
                    <div class="stat-value">{{ $absensiHariIni ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-calendar-check fa-3x text-info opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cuti Pending -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Cuti Pending</div>
                    <div class="stat-value">{{ $cutiPending ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-clock fa-3x text-warning opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Terlambat Hari Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Terlambat Hari Ini</div>
                    <div class="stat-value">{{ $terlambat ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-user-clock fa-3x text-danger opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Lembur Bulan Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Lembur (Jam)</div>
                    <div class="stat-value">{{ $totalLembur ?? 0 }}</div>
                </div>
                <div>
                    <i class="fas fa-business-time fa-3x text-primary opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables -->
<div class="row g-4">
    <!-- Pengumuman Terbaru -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-bullhorn me-2"></i>
                    Pengumuman Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($pengumumanList ?? [] as $pengumuman)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $pengumuman->judul }}</h6>
                            <small>{{ $pengumuman->tanggal }}</small>
                        </div>
                        <p class="mb-1 text-muted">{{ Str::limit($pengumuman->isi, 100) }}</p>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Belum ada pengumuman</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ulang Tahun Bulan Ini -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-birthday-cake me-2"></i>
                    Ulang Tahun Bulan Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($birthdayList ?? [] as $birthday)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ $birthday->nama }}</h6>
                            <small class="text-muted">{{ $birthday->jabatan }}</small>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $birthday->tanggal }}</span>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-calendar fa-3x mb-3"></i>
                        <p>Tidak ada ulang tahun bulan ini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2 text-warning"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('employee.create') }}" class="btn btn-primary w-100 py-3" onclick="navigateTo(event, '{{ route('employee.create') }}')">
                            <i class="fas fa-user-plus fa-2x mb-2 d-block"></i>
                            Tambah Karyawan Baru
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('attendance.checkin') }}" class="btn btn-success w-100 py-3" onclick="navigateTo(event, '{{ route('attendance.checkin') }}')">
                            <i class="fas fa-sign-in-alt fa-2x mb-2 d-block"></i>
                            Check In/Out
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('leave.index') }}" class="btn btn-info w-100 py-3" onclick="navigateTo(event, '{{ route('leave.index') }}')">
                            <i class="fas fa-umbrella-beach fa-2x mb-2 d-block"></i>
                            Ajukan Cuti
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('laporan.index') }}" class="btn btn-warning w-100 py-3" onclick="navigateTo(event, '{{ route('laporan.index') }}')">
                            <i class="fas fa-file-alt fa-2x mb-2 d-block"></i>
                            Generate Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
