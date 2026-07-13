@extends('layouts.app')

@section('title', 'Jabatan - HRIS V2')
@section('page-title', 'Manajemen Jabatan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-briefcase me-2"></i>
            Data Jabatan
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari jabatan..." style="width:220px;">
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
                        <th>Nama Jabatan</th>
                        <th>Level</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Karyawan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $p->kode }}</code></td>
                        <td><strong>{{ $p->nama }}</strong></td>
                        <td>
                            @if($p->level == 'C-Level')
                                <span class="badge bg-danger">{{ $p->level }}</span>
                            @elseif($p->level == 'Manager')
                                <span class="badge bg-warning text-dark">{{ $p->level }}</span>
                            @elseif($p->level == 'Senior')
                                <span class="badge bg-info">{{ $p->level }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $p->level }}</span>
                            @endif
                        </td>
                        <td>{{ $p->deskripsi }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $p->jumlah_karyawan }} orang</span>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'aktif')
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-briefcase fa-3x mb-3 d-block"></i>
                            <p>Belum ada data jabatan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
