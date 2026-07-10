@extends('layouts.app')

@section('title', 'Data Karyawan - HRIS V2')
@section('page-title', 'Data Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-users me-2"></i>
            Daftar Karyawan
        </h5>
        <a href="{{ route('employee.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Tambah Karyawan
        </a>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Cari nama/NIK...">
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Semua Divisi</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>
                    <option>Marketing</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option>Aktif</option>
                    <option>Kontrak</option>
                    <option>Resign</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
            </div>
        </div>
        
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $emp)
                    <tr>
                        <td><code>{{ $emp->nik }}</code></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div style="width:35px;height:35px;border-radius:50%;background:#4e73df;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:0.85rem;margin-right:10px;">
                                    {{ strtoupper(substr($emp->nama,0,1)) }}
                                </div>
                                {{ $emp->nama }}
                            </div>
                        </td>
                        <td>{{ $emp->divisi }}</td>
                        <td>{{ $emp->jabatan }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->telepon }}</td>
                        <td>
                            @if($emp->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($emp->status == 'kontrak')
                                <span class="badge bg-warning text-dark">Kontrak</span>
                            @else
                                <span class="badge bg-danger">Resign</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('employee.show', $emp->id) }}" class="btn btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.edit', $emp->id) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            <p>Belum ada data karyawan</p>
                            <a href="{{ route('employee.create') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-1"></i> Tambah Karyawan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan 1 - {{ count($employees) }} dari {{ count($employees) }} data
            </div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
