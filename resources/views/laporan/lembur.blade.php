@extends('layouts.app')
@section('title', 'Laporan Lembur - HRIS V2')
@section('page-title', 'Laporan Lembur Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-business-time me-2"></i>Laporan Lembur Karyawan</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Divisi</th><th class="text-center">Jam Lembur</th><th>Tanggal</th><th>Keterangan</th><th class="text-end">Uang Lembur</th></tr></thead>
                <tbody>
                    @forelse($overtimes as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $o->nik }}</code></td>
                        <td><strong>{{ $o->nama }}</strong></td>
                        <td>{{ $o->divisi }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $o->jam_lembur }} Jam</span></td>
                        <td>{{ $o->tanggal }}</td>
                        <td>{{ $o->keterangan }}</td>
                        <td class="text-end"><strong>Rp {{ number_format($o->uang_lembur,0,',','.') }}</strong></td>
                    </tr>
                    @empty<tr><td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-business-time fa-3x mb-3 d-block"></i><p>Belum ada data lembur</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
