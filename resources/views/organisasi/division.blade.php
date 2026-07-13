@extends('layouts.app')

@section('title', 'Divisi - HRIS V2')
@section('page-title', 'Manajemen Divisi')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-layer-group me-2"></i>
            Data Divisi
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari divisi..." style="width:220px;">
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
                        <th>Nama Divisi</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Karyawan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($divisions as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $d->kode }}</code></td>
                        <td><strong>{{ $d->nama }}</strong></td>
                        <td>{{ $d->deskripsi }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $d->jumlah_karyawan }} orang</span>
                        </td>
                        <td class="text-center">
                            @if($d->status == 'aktif')
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-layer-group fa-3x mb-3 d-block"></i>
                            <p>Belum ada data divisi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
