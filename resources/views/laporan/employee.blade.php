@extends('layouts.app')
@section('title', 'Laporan Karyawan - HRIS V2')
@section('page-title', 'Laporan Statistik Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Laporan Statistik Karyawan</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Divisi</th><th class="text-center">Jumlah</th><th class="text-center">Laki-laki</th><th class="text-center">Perempuan</th><th class="text-center">Rata-rata Umur</th></tr></thead>
                <tbody>
                    @forelse($employees as $e)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $e->divisi }}</strong></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $e->jumlah }}</span></td>
                        <td class="text-center"><span class="badge bg-info">{{ $e->laki_laki }}</span></td>
                        <td class="text-center"><span class="badge bg-danger">{{ $e->perempuan }}</span></td>
                        <td class="text-center">{{ $e->rata_umur }} Tahun</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-users fa-3x mb-3 d-block"></i><p>Belum ada data karyawan</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
