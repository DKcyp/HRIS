@extends('layouts.app')
@section('title', 'Nilai Training - HRIS V2')
@section('page-title', 'Data Nilai Training')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Data Nilai Training</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama Karyawan</th><th>Training</th><th class="text-center">Nilai</th><th class="text-center">Grade</th><th>Keterangan</th><th>Tanggal</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($scores as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->nik }}</code></td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td>{{ $s->training }}</td>
                        <td class="text-center"><span class="badge bg-primary fs-6">{{ $s->nilai }}</span></td>
                        <td class="text-center"><span class="badge bg-success">{{ $s->grade }}</span></td>
                        <td>{{ $s->keterangan }}</td>
                        <td>{{ $s->tanggal }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('training.nilai.update', $s->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Nilai</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $s->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $s->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Training</label><input type="text" class="form-control" name="training" value="{{ $s->training }}"></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai" value="{{ $s->nilai }}"></div><div class="col-md-4"><label class="form-label">Grade</label><input type="text" class="form-control" name="grade" value="{{ $s->grade }}"></div><div class="col-md-4"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $s->tanggal }}"></div></div>
                                <div class="mb-3"><label class="form-label">Keterangan</label><input type="text" class="form-control" name="keterangan" value="{{ $s->keterangan }}"></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('training.nilai.destroy', $s->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $s->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-star fa-3x mb-3 d-block"></i><p>Belum ada data nilai</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('training.nilai.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Nilai</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Training</label><input type="text" class="form-control" name="training"></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai"></div><div class="col-md-4"><label class="form-label">Grade</label><input type="text" class="form-control" name="grade"></div><div class="col-md-4"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div></div>
            <div class="mb-3"><label class="form-label">Keterangan</label><input type="text" class="form-control" name="keterangan"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
