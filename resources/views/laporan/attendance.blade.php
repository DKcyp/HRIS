@extends('layouts.app')
@section('title', 'Laporan Absensi - HRIS V2')
@section('page-title', 'Laporan Absensi Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Laporan Absensi Karyawan</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Divisi</th><th class="text-center">Hadir</th><th class="text-center">Terlambat</th><th class="text-center">Alpha</th><th class="text-center">Sakit</th><th class="text-center">Izin</th><th class="text-center">Persentase</th></tr></thead>
                <tbody>
                    @forelse($attendances as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $a->nik }}</code></td>
                        <td><strong>{{ $a->nama }}</strong></td>
                        <td>{{ $a->divisi }}</td>
                        <td class="text-center"><span class="badge bg-success">{{ $a->hadir }}</span></td>
                        <td class="text-center"><span class="badge bg-warning">{{ $a->terlambat }}</span></td>
                        <td class="text-center"><span class="badge bg-danger">{{ $a->alpha }}</span></td>
                        <td class="text-center"><span class="badge bg-info">{{ $a->sakit }}</span></td>
                        <td class="text-center"><span class="badge bg-secondary">{{ $a->izin }}</span></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $a->persentase }}%</span></td>
                    </tr>
                    @empty<tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-calendar-check fa-3x mb-3 d-block"></i><p>Belum ada data absensi</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
