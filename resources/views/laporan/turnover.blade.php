@extends('layouts.app')
@section('title', 'Laporan Turnover - HRIS V2')
@section('page-title', 'Laporan Turnover Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Laporan Turnover Karyawan</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Bulan</th><th class="text-center">Masuk</th><th class="text-center">Keluar</th><th class="text-center">Resign</th><th class="text-center">PHK</th><th class="text-center">Lainnya</th><th class="text-center">Persentase</th></tr></thead>
                <tbody>
                    @forelse($turnovers as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $t->bulan }}</strong></td>
                        <td class="text-center"><span class="badge bg-success">{{ $t->masuk }}</span></td>
                        <td class="text-center"><span class="badge bg-danger">{{ $t->keluar }}</span></td>
                        <td class="text-center"><span class="badge bg-warning">{{ $t->resign }}</span></td>
                        <td class="text-center"><span class="badge bg-secondary">{{ $t->phk }}</span></td>
                        <td class="text-center"><span class="badge bg-info">{{ $t->lainnya }}</span></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $t->persentase }}%</span></td>
                    </tr>
                    @empty<tr><td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-exchange-alt fa-3x mb-3 d-block"></i><p>Belum ada data turnover</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
