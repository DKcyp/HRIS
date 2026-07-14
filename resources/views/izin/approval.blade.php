@extends('layouts.app')

@section('title', 'Approval Izin - HRIS V2')
@section('page-title', 'Approval Izin')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card">
    <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-check-double me-2"></i>Menunggu Persetujuan Izin</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jenis</th><th>Tanggal</th><th>Jam</th><th>Keterangan</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($approvals as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $a->nik }}</code></td>
                        <td><strong>{{ $a->nama }}</strong></td>
                        <td><span class="badge bg-{{ $a->jenis=='Sakit'?'warning text-dark':'info' }}">{{ $a->jenis }}</span></td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->jam_mulai }} - {{ $a->jam_selesai }}</td>
                        <td>{{ $a->keterangan }}</td>
                        <td class="text-center">
                            <form action="{{ route('izin.approval.store') }}" method="POST" class="d-inline">@csrf
                                <input type="hidden" name="id" value="{{ $a->id }}">
                                <input type="hidden" name="status" value="disetujui">
                                <button class="btn btn-sm btn-success me-1"><i class="fas fa-check"></i> Setujui</button>
                            </form>
                            <form action="{{ route('izin.approval.store') }}" method="POST" class="d-inline">@csrf
                                <input type="hidden" name="id" value="{{ $a->id }}">
                                <input type="hidden" name="status" value="ditolak">
                                <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-check-double fa-3x mb-3 d-block"></i><p>Tidak ada pengajuan izin yang menunggu persetujuan</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
