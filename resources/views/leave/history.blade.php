@extends('layouts.app')

@section('title', 'History Cuti - HRIS V2')
@section('page-title', 'History Cuti')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Cuti Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari NIK/nama..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jenis</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th class="text-center">Hari</th><th>Keterangan</th><th class="text-center">Status</th></tr></thead>
                <tbody>
                    @forelse($histories as $h)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $h->nik }}</code></td>
                        <td><strong>{{ $h->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $h->jenis }}</span></td>
                        <td>{{ $h->tanggal_mulai }}</td>
                        <td>{{ $h->tanggal_selesai }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $h->hari }} hari</span></td>
                        <td>{{ $h->keterangan }}</td>
                        <td class="text-center">
                            @if($h->status=='disetujui')<span class="badge bg-success">Disetujui</span>
                            @elseif($h->status=='pending')<span class="badge bg-warning text-dark">Pending</span>
                            @else<span class="badge bg-danger">Ditolak</span>@endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-history fa-3x mb-3 d-block"></i><p>Belum ada data riwayat cuti</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
