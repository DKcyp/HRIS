@extends('layouts.app')
@section('title', 'Laporan Cuti - HRIS V2')
@section('page-title', 'Laporan Penggunaan Cuti')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-umbrella-beach me-2"></i>Laporan Penggunaan Cuti</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Divisi</th><th class="text-center">Cuti Tahunan</th><th class="text-center">Terpakai</th><th class="text-center">Sisa</th><th class="text-center">Sakit</th><th class="text-center">Izin</th><th class="text-center">Total</th></tr></thead>
                <tbody>
                    @forelse($leaves as $l)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $l->nik }}</code></td>
                        <td><strong>{{ $l->nama }}</strong></td>
                        <td>{{ $l->divisi }}</td>
                        <td class="text-center">{{ $l->cuti_tahunan }}</td>
                        <td class="text-center"><span class="badge bg-warning">{{ $l->cuti_terpakai }}</span></td>
                        <td class="text-center"><span class="badge bg-success">{{ $l->cuti_sisa }}</span></td>
                        <td class="text-center"><span class="badge bg-info">{{ $l->sakit }}</span></td>
                        <td class="text-center"><span class="badge bg-secondary">{{ $l->izin }}</span></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $l->total }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-umbrella-beach fa-3x mb-3 d-block"></i><p>Belum ada data cuti</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
