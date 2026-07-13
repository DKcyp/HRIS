@extends('layouts.app')

@section('title', 'Shift - HRIS V2')
@section('page-title', 'Manajemen Shift')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-clock me-2"></i>
            Data Shift
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari shift..." style="width:220px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Shift</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Istirahat</th>
                        <th class="text-center">Total Jam</th>
                        <th>Keterangan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shifts as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->kode }}</code></td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td><span class="badge bg-success">{{ $s->jam_mulai }}</span></td>
                        <td><span class="badge bg-danger">{{ $s->jam_selesai }}</span></td>
                        <td><span class="badge bg-secondary">{{ $s->jam_istirahat }}</span></td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $s->total_jam }} jam</span>
                        </td>
                        <td>{{ $s->keterangan }}</td>
                        <td class="text-center">
                            @if($s->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Non-aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="fas fa-clock fa-3x mb-3 d-block"></i>
                            <p>Belum ada data shift</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
