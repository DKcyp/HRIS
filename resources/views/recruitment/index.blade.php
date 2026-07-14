@extends('layouts.app')

@section('title', 'Lowongan - HRIS V2')
@section('page-title', 'Manajemen Lowongan')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-briefcase me-2"></i>
            Data Lowongan Pekerjaan
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari lowongan..." style="width:220px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Posisi</th>
                        <th>Departemen</th>
                        <th class="text-center">Jumlah</th>
                        <th>Range Gaji</th>
                        <th>Tanggal Tutup</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowongans as $l)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $l->kode }}</code></td>
                        <td><strong>{{ $l->posisi }}</strong></td>
                        <td><span class="badge bg-info">{{ $l->departemen }}</span></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $l->jumlah }} orang</span></td>
                        <td>
                            <span class="text-success fw-bold">Rp {{ number_format($l->gaji_min, 0, ',', '.') }}</span>
                            <i class="fas fa-minus mx-1 text-muted"></i>
                            <span class="text-danger fw-bold">Rp {{ number_format($l->gaji_max, 0, ',', '.') }}</span>
                        </td>
                        <td>{{ $l->tutup }}</td>
                        <td class="text-center">
                            @if($l->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Ditutup</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $l->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $l->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $l->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.index.update', $l->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Lowongan</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Kode <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kode" value="{{ $l->kode }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Posisi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="posisi" value="{{ $l->posisi }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Departemen</label>
                                            <input type="text" class="form-control" name="departemen" value="{{ $l->departemen }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah" value="{{ $l->jumlah }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Tutup</label>
                                                <input type="date" class="form-control" name="tutup" value="{{ $l->tutup }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Gaji Minimum</label>
                                                <input type="number" class="form-control" name="gaji_min" value="{{ $l->gaji_min }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Gaji Maksimum</label>
                                                <input type="number" class="form-control" name="gaji_max" value="{{ $l->gaji_max }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="aktif" {{ $l->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="ditutup" {{ $l->status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $l->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.index.destroy', $l->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Lowongan</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus lowongan ini?</p>
                                        <p class="text-muted"><strong>{{ $l->posisi }}</strong></p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i> Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="fas fa-briefcase fa-3x mb-3 d-block"></i>
                            <p>Belum ada data lowongan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('recruitment.index.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Lowongan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="posisi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Departemen</label>
                        <input type="text" class="form-control" name="departemen">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Tutup</label>
                            <input type="date" class="form-control" name="tutup">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Gaji Minimum</label>
                            <input type="number" class="form-control" name="gaji_min">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gaji Maksimum</label>
                            <input type="number" class="form-control" name="gaji_max">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="ditutup">Ditutup</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
