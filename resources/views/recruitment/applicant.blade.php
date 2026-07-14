@extends('layouts.app')

@section('title', 'Pelamar - HRIS V2')
@section('page-title', 'Data Pelamar')

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
            <i class="fas fa-users me-2"></i>
            Data Pelamar
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari pelamar..." style="width:220px;">
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Posisi</th>
                        <th>Pengalaman</th>
                        <th>Tanggal Lamar</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applicants as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $a->nama }}</strong></td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->telepon }}</td>
                        <td><span class="badge bg-info">{{ $a->posisi }}</span></td>
                        <td>{{ $a->pengalaman }}</td>
                        <td>{{ $a->tanggal_lamar ?? $a->{'tanggal Lamar'} }}</td>
                        <td class="text-center">
                            @if($a->status == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($a->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif($a->status == 'interview')
                                <span class="badge bg-warning text-dark">Interview</span>
                            @elseif($a->status == 'psikotes')
                                <span class="badge bg-info">Psikotes</span>
                            @else
                                <span class="badge bg-secondary">Dalam Review</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $a->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $a->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.applicant.update', $a->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Pelamar</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama" value="{{ $a->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $a->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" value="{{ $a->telepon }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Posisi</label>
                                            <input type="text" class="form-control" name="posisi" value="{{ $a->posisi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pengalaman</label>
                                            <input type="text" class="form-control" name="pengalaman" value="{{ $a->pengalaman }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="dalam_review" {{ $a->status == 'dalam_review' ? 'selected' : '' }}>Dalam Review</option>
                                                <option value="interview" {{ $a->status == 'interview' ? 'selected' : '' }}>Interview</option>
                                                <option value="psikotes" {{ $a->status == 'psikotes' ? 'selected' : '' }}>Psikotes</option>
                                                <option value="diterima" {{ $a->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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

                    <div class="modal fade" id="deleteModal{{ $a->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.applicant.destroy', $a->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Pelamar</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus pelamar ini?</p>
                                        <p class="text-muted"><strong>{{ $a->nama }}</strong></p>
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
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            <p>Belum ada data pelamar</p>
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
            <form action="{{ route('recruitment.applicant.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Pelamar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengalaman</label>
                        <input type="text" class="form-control" name="pengalaman">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="dalam_review">Dalam Review</option>
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
