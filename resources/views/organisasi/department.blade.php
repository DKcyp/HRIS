@extends('layouts.app')

@section('title', 'Departemen - HRIS V2')
@section('page-title', 'Manajemen Departemen')

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
            <i class="fas fa-building me-2"></i>
            Data Departemen
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari departemen..." style="width:220px;">
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
                        <th>Nama Departemen</th>
                        <th>Divisi</th>
                        <th>Kepala Dept</th>
                        <th class="text-center">Jumlah Karyawan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $d->kode }}</code></td>
                        <td><strong>{{ $d->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $d->divisi }}</span></td>
                        <td>{{ $d->kepala }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $d->jumlah_karyawan }} orang</span>
                        </td>
                        <td class="text-center">
                            @if($d->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Non-aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit"
                                data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $d->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('organisasi.department.update', $d->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Departemen</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Kode <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="kode" value="{{ $d->kode }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama" value="{{ $d->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Divisi</label>
                                            <input type="text" class="form-control" name="divisi" value="{{ $d->divisi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kepala Departemen</label>
                                            <input type="text" class="form-control" name="kepala" value="{{ $d->kepala }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="aktif" {{ $d->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="non-aktif" {{ $d->status == 'non-aktif' ? 'selected' : '' }}>Non-aktif</option>
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

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('organisasi.department.destroy', $d->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Departemen</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus departemen ini?</p>
                                        <p class="text-muted"><strong>{{ $d->nama }}</strong></p>
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
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-building fa-3x mb-3 d-block"></i>
                            <p>Belum ada data departemen</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('organisasi.department.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Departemen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Divisi</label>
                        <input type="text" class="form-control" name="divisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kepala Departemen</label>
                        <input type="text" class="form-control" name="kepala">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non-aktif</option>
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
