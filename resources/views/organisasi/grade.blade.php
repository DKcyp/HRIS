@extends('layouts.app')

@section('title', 'Grade - HRIS V2')
@section('page-title', 'Manajemen Grade')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-sort-amount-up me-2"></i>
            Data Grade
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari grade..." style="width:220px;">
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
                        <th>Nama Grade</th>
                        <th>Range Gaji</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Karyawan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $g)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $g->kode }}</code></td>
                        <td><strong>{{ $g->nama }}</strong></td>
                        <td>
                            <span class="text-success fw-bold">Rp {{ number_format($g->min_gaji, 0, ',', '.') }}</span>
                            <i class="fas fa-minus mx-1 text-muted"></i>
                            <span class="text-danger fw-bold">Rp {{ number_format($g->max_gaji, 0, ',', '.') }}</span>
                        </td>
                        <td>{{ $g->deskripsi }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $g->jumlah_karyawan }} orang</span>
                        </td>
                        <td class="text-center">
                            @if($g->status == 'aktif')
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
                            <i class="fas fa-sort-amount-up fa-3x mb-3 d-block"></i>
                            <p>Belum ada data grade</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
