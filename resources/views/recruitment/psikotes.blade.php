@extends('layouts.app')

@section('title', 'Psikotes - HRIS V2')
@section('page-title', 'Manajemen Psikotes')

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
            <i class="fas fa-brain me-2"></i>
            Data Psikotes
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari psikotes..." style="width:220px;">
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
                        <th>Posisi</th>
                        <th>Tanggal</th>
                        <th class="text-center">Kognitif</th>
                        <th class="text-center">Personality</th>
                        <th class="text-center">Integritas</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($psikotes as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $p->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $p->posisi }}</span></td>
                        <td>{{ $p->tanggal }}</td>
                        <td class="text-center">
                            @if($p->nilai_kognitif)
                                <span class="badge bg-primary">{{ $p->nilai_kognitif }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($p->nilai_personality)
                                <span class="badge bg-success">{{ $p->nilai_personality }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($p->nilai_integritas)
                                <span class="badge bg-warning text-dark">{{ $p->nilai_integritas }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($p->status == 'lulus')
                                <span class="badge bg-success">Lulus</span>
                            @elseif($p->status == 'proses')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-secondary">Terjadwal</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.psikotes.update', $p->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Psikotes</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama" value="{{ $p->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Posisi</label>
                                            <input type="text" class="form-control" name="posisi" value="{{ $p->posisi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="{{ $p->tanggal }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nilai Kognitif</label>
                                                <input type="number" class="form-control" name="nilai_kognitif" value="{{ $p->nilai_kognitif }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Nilai Personality</label>
                                                <input type="number" class="form-control" name="nilai_personality" value="{{ $p->nilai_personality }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Nilai Integritas</label>
                                                <input type="number" class="form-control" name="nilai_integritas" value="{{ $p->nilai_integritas }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="terjadwal" {{ $p->status == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                                <option value="proses" {{ $p->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="lulus" {{ $p->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
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

                    <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.psikotes.destroy', $p->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Psikotes</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus psikotes ini?</p>
                                        <p class="text-muted"><strong>{{ $p->nama }}</strong></p>
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
                            <i class="fas fa-brain fa-3x mb-3 d-block"></i>
                            <p>Belum ada data psikotes</p>
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
            <form action="{{ route('recruitment.psikotes.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Psikotes</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nilai Kognitif</label>
                            <input type="number" class="form-control" name="nilai_kognitif">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nilai Personality</label>
                            <input type="number" class="form-control" name="nilai_personality">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nilai Integritas</label>
                            <input type="number" class="form-control" name="nilai_integritas">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="terjadwal">Terjadwal</option>
                            <option value="proses">Proses</option>
                            <option value="lulus">Lulus</option>
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
