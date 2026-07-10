@extends('layouts.app')

@section('title', 'Status Karyawan - HRIS V2')
@section('page-title', 'Status Aktif / Resign')

@section('content')
<!-- Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Aktif</div>
                    <div class="stat-value">{{ $statusList->where('status','aktif')->count() }}</div>
                </div>
                <i class="fas fa-user-check fa-3x text-success opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Kontrak</div>
                    <div class="stat-value">{{ $statusList->where('status','kontrak')->count() }}</div>
                </div>
                <i class="fas fa-file-contract fa-3x text-warning opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Resign</div>
                    <div class="stat-value">{{ $statusList->where('status','resign')->count() }}</div>
                </div>
                <i class="fas fa-user-minus fa-3x text-danger opacity-25"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-label">Total Karyawan</div>
                    <div class="stat-value">{{ $statusList->count() }}</div>
                </div>
                <i class="fas fa-users fa-3x text-primary opacity-25"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-toggle-on me-2"></i>
            Status Karyawan
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;">
                <option value="">Semua Status</option>
                <option>Aktif</option>
                <option>Kontrak</option>
                <option>Resign</option>
            </select>
            <input type="text" class="form-control form-control-sm" placeholder="Cari nama/NIK..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Durasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statusList as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->nik }}</code></td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->divisi }}</td>
                        <td>{{ $s->jabatan }}</td>
                        <td>
                            @if($s->status == 'aktif')
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @elseif($s->status == 'kontrak')
                                <span class="badge bg-warning text-dark"><i class="fas fa-file-contract me-1"></i>Kontrak</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Resign</span>
                            @endif
                        </td>
                        <td>{{ $s->tanggal_masuk }}</td>
                        <td>{{ $s->tanggal_keluar ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark">{{ $s->durasi }}</span></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-info" title="Detail"><i class="fas fa-eye"></i></button>
                                @if($s->status != 'resign')
                                    <button class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
