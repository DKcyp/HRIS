@extends('layouts.app')

@section('title', 'History Izin - HRIS V2')
@section('page-title', 'History Izin')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Izin Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari NIK/nama..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jenis</th><th>Tanggal</th><th>Jam</th><th>Keterangan</th><th class="text-center">Status</th></tr></thead>
                <tbody>
                    @forelse($histories as $h)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $h->nik }}</code></td>
                        <td><strong>{{ $h->nama }}</strong></td>
                        <td><span class="badge bg-{{ $h->jenis=='Sakit'?'warning text-dark':'info' }}">{{ $h->jenis }}</span></td>
                        <td>{{ $h->tanggal }}</td>
                        <td>{{ $h->jam_mulai }} - {{ $h->jam_selesai }}</td>
                        <td>{{ $h->keterangan }}</td>
                        <td class="text-center">
                            @if($h->status=='disetujui')<span class="badge bg-success">Disetujui</span>
                            @elseif($h->status=='pending')<span class="badge bg-warning text-dark">Pending</span>
                            @else<span class="badge bg-danger">Ditolak</span>@endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-history fa-3x mb-3 d-block"></i><p>Belum ada data riwayat izin</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
