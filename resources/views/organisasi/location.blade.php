@extends('layouts.app')

@section('title', 'Lokasi Kerja - HRIS V2')
@section('page-title', 'Manajemen Lokasi Kerja')

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
            <i class="fas fa-map-marker-alt me-2"></i>
            Data Lokasi Kerja
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari lokasi..." style="width:220px;">
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
                        <th>Nama Lokasi</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th class="text-center">Jumlah Karyawan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $l)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $l->kode }}</code></td>
                        <td><strong>{{ $l->nama }}</strong></td>
                        <td>{{ $l->alamat }}</td>
                        <td><span class="badge bg-info">{{ $l->kota }}</span></td>
                        <td>{{ $l->telepon }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary">{{ $l->jumlah_karyawan }} orang</span>
                        </td>
                        <td class="text-center">
                            @if($l->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Non-aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit"
                                data-bs-toggle="modal" data-bs-target="#editModal{{ $l->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $l->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $l->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('organisasi.location.update', $l->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Lokasi Kerja</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Kode <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="kode" value="{{ $l->kode }}" required>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama" value="{{ $l->nama }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="alamat" rows="2" required>{{ $l->alamat }}</textarea>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Kota</label>
                                                <input type="text" class="form-control" name="kota" value="{{ $l->kota }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" name="kode_pos" value="{{ $l->kode_pos ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" class="form-control" name="telepon" value="{{ $l->telepon }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="aktif" {{ $l->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="non-aktif" {{ $l->status == 'non-aktif' ? 'selected' : '' }}>Non-aktif</option>
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
                    <div class="modal fade" id="deleteModal{{ $l->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('organisasi.location.destroy', $l->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Lokasi</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus lokasi ini?</p>
                                        <p class="text-muted"><strong>{{ $l->nama }}</strong></p>
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
                            <i class="fas fa-map-marker-alt fa-3x mb-3 d-block"></i>
                            <p>Belum ada data lokasi kerja</p>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('organisasi.location.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Lokasi Kerja</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Kode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kode" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alamat" rows="2" required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Kota</label>
                            <input type="text" class="form-control" name="kota">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telepon">
                        </div>
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
