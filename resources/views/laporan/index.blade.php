@extends('layouts.app')
@section('title', 'Laporan - HRIS V2')
@section('page-title', 'Dashboard Laporan')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.attendance') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Laporan Absensi</h5>
                    <p class="text-muted">Rekap kehadiran karyawan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.leave') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-umbrella-beach fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Laporan Cuti</h5>
                    <p class="text-muted">Rekap penggunaan cuti</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.payroll') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-money-bill-wave fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Laporan Payroll</h5>
                    <p class="text-muted">Rekap gaji karyawan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.employee') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Laporan Karyawan</h5>
                    <p class="text-muted">Statistik data karyawan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.turnover') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-exchange-alt fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Laporan Turnover</h5>
                    <p class="text-muted">Rekap perputaran karyawan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="{{ route('laporan.lembur') }}" class="text-decoration-none">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-business-time fa-3x text-secondary mb-3"></i>
                    <h5 class="card-title">Laporan Lembur</h5>
                    <p class="text-muted">Rekap lembur karyawan</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
