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
                    <option value="1">IT</option>
                    <option value="2">HRD</option>
                    <option value="3">Finance</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="resign">Resign</option>
                    <option value="kontrak">Kontrak</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100">
                    <i class="fas fa-search me-1"></i>
                    Cari
                </button>
            </div>
        </div>
        
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees ?? [] as $employee)
                    <tr>
                        <td><strong>{{ $employee->nik }}</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.875rem;">
                                    {{ substr($employee->nama, 0, 1) }}
                                </div>
                                {{ $employee->nama }}
                            </div>
                        </td>
                        <td>{{ $employee->divisi }}</td>
                        <td>{{ $employee->jabatan }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->telepon }}</td>
                        <td>
                            @if($employee->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($employee->status == 'kontrak')
                                <span class="badge bg-warning">Kontrak</span>
                            @else
                                <span class="badge bg-danger">Resign</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger" title="Hapus">
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
                                <i class="fas fa-plus me-1"></i>
                                Tambah Karyawan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($employees) && count($employees) > 0)
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan 1 - 10 dari {{ count($employees) }} data
            </div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection
