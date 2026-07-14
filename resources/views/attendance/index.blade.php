@extends('layouts.app')

@section('title', 'Rekap Absensi - HRIS V2')
@section('page-title', 'Rekap Absensi')

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
            <i class="fas fa-calendar-check me-2"></i>
            Rekap Absensi Karyawan
        </h5>
        <div class="d-flex gap-2">
            <input type="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" style="width:180px;">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
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
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th class="text-center">Jam Kerja</th>
                        <th class="text-center">Status</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekap as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $r->nik }}</code></td>
                        <td><strong>{{ $r->nama }}</strong></td>
                        <td>{{ $r->tanggal }}</td>
                        <td><span class="badge bg-success">{{ $r->jam_masuk }}</span></td>
                        <td><span class="badge bg-danger">{{ $r->jam_keluar }}</span></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $r->jam_kerja }} jam</span></td>
                        <td class="text-center">
                            @if($r->status == 'hadir')
                                <span class="badge bg-success">Hadir</span>
                            @elseif($r->status == 'terlambat')
                                <span class="badge bg-warning text-dark">Terlambat</span>
                            @elseif($r->status == 'lembur')
                                <span class="badge bg-info">Lembur</span>
                            @elseif($r->status == 'alpha')
                                <span class="badge bg-danger">Alpha</span>
                            @elseif($r->status == 'sakit')
                                <span class="badge bg-secondary">Sakit</span>
                            @elseif($r->status == 'cuti')
                                <span class="badge bg-primary">Cuti</span>
                            @else
                                <span class="badge bg-secondary">{{ $r->status }}</span>
                            @endif
                        </td>
                        <td>{{ $r->keterangan ?: '-' }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $r->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('attendance.index.update', $r->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Rekap Absensi</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">NIK</label>
                                                <input type="text" class="form-control" name="nik" value="{{ $r->nik }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" value="{{ $r->nama }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="{{ $r->tanggal }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Jam Masuk</label>
                                                <input type="time" class="form-control" name="jam_masuk" value="{{ $r->jam_masuk }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jam Keluar</label>
                                                <input type="time" class="form-control" name="jam_keluar" value="{{ $r->jam_keluar }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Jam Kerja</label>
                                                <input type="number" step="0.25" class="form-control" name="jam_kerja" value="{{ $r->jam_kerja }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="hadir" {{ $r->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="terlambat" {{ $r->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                                                    <option value="lembur" {{ $r->status == 'lembur' ? 'selected' : '' }}>Lembur</option>
                                                    <option value="alpha" {{ $r->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                                                    <option value="sakit" {{ $r->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                    <option value="cuti" {{ $r->status == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" rows="2">{{ $r->keterangan }}</textarea>
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

                    <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('attendance.index.destroy', $r->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Rekap</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus data ini?</p>
                                        <p class="text-muted"><strong>{{ $r->nama }} - {{ $r->tanggal }}</strong></p>
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
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-check fa-3x mb-3 d-block"></i>
                            <p>Belum ada data rekap absensi</p>
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
            <form action="{{ route('attendance.index.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Rekap Absensi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nik" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jam Keluar</label>
                            <input type="time" class="form-control" name="jam_keluar">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jam Kerja</label>
                            <input type="number" step="0.25" class="form-control" name="jam_kerja">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="hadir">Hadir</option>
                                <option value="terlambat">Terlambat</option>
                                <option value="lembur">Lembur</option>
                                <option value="alpha">Alpha</option>
                                <option value="sakit">Sakit</option>
                                <option value="cuti">Cuti</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
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
