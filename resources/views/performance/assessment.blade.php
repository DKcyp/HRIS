@extends('layouts.app')
@section('title', 'Assessment - HRIS V2')
@section('page-title', 'Data Assessment')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Data Assessment Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Assessor</th><th>Periode</th><th>Tanggal</th><th class="text-center">Nilai</th><th>Komentar</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($assessments as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $a->nik }}</code></td>
                        <td><strong>{{ $a->nama }}</strong></td>
                        <td>{{ $a->assessor }}</td>
                        <td><span class="badge bg-info">{{ $a->periode }}</span></td>
                        <td>{{ $a->tanggal }}</td>
                        <td class="text-center"><strong class="text-primary">{{ $a->nilai }}</strong></td>
                        <td>{{ Str::limit($a->komentar, 30) }}</td>
                        <td class="text-center">@if($a->status=='selesai')<span class="badge bg-success">Selesai</span>@else<span class="badge bg-secondary">Draft</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $a->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $a->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.assessment.update', $a->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Assessment</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $a->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $a->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Assessor</label><input type="text" class="form-control" name="assessor" value="{{ $a->assessor }}"></div><div class="col-md-6"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode" value="{{ $a->periode }}"></div></div>
                                <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $a->tanggal }}"></div>
                                <div class="mb-3"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai" value="{{ $a->nilai }}"></div>
                                <div class="mb-3"><label class="form-label">Komentar</label><textarea class="form-control" name="komentar" rows="2">{{ $a->komentar }}</textarea></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $a->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.assessment.destroy', $a->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $a->nama }} - {{ $a->periode }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-clipboard-check fa-3x mb-3 d-block"></i><p>Belum ada data assessment</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.assessment.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Assessment</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Assessor</label><input type="text" class="form-control" name="assessor"></div><div class="col-md-6"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode"></div></div>
            <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div>
            <div class="mb-3"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai"></div>
            <div class="mb-3"><label class="form-label">Komentar</label><textarea class="form-control" name="komentar" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
