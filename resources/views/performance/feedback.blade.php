@extends('layouts.app')
@section('title', 'Feedback - HRIS V2')
@section('page-title', 'Data Feedback Karyawan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-comment-dots me-2"></i>Data Feedback Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Dari</th><th>Tanggal</th><th class="text-center">Jenis</th><th>Isi Feedback</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($feedbacks as $f)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $f->nik }}</code></td>
                        <td><strong>{{ $f->nama }}</strong></td>
                        <td>{{ $f->from }}</td>
                        <td>{{ $f->tanggal }}</td>
                        <td class="text-center">
                            @if($f->jenis=='positif')<span class="badge bg-success">Positif</span>
                            @else<span class="badge bg-warning text-dark">Saran</span>@endif
                        </td>
                        <td>{{ Str::limit($f->isi, 40) }}</td>
                        <td class="text-center">@if($f->status=='published')<span class="badge bg-success">Published</span>@else<span class="badge bg-secondary">Draft</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $f->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $f->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $f->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.feedback.update', $f->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Feedback</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $f->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $f->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Dari</label><input type="text" class="form-control" name="from" value="{{ $f->from }}"></div><div class="col-md-6"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $f->tanggal }}"></div></div>
                                <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="positif" {{ $f->jenis=='positif'?'selected':'' }}>Positif</option><option value="saran" {{ $f->jenis=='saran'?'selected':'' }}>Saran</option></select></div>
                                <div class="mb-3"><label class="form-label">Isi Feedback</label><textarea class="form-control" name="isi" rows="3">{{ $f->isi }}</textarea></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $f->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.feedback.destroy', $f->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $f->nama }} - {{ $f->tanggal }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-comment-dots fa-3x mb-3 d-block"></i><p>Belum ada data feedback</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.feedback.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Feedback</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Dari</label><input type="text" class="form-control" name="from"></div><div class="col-md-6"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div></div>
            <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option>Positif</option><option>Saran</option></select></div>
            <div class="mb-3"><label class="form-label">Isi Feedback</label><textarea class="form-control" name="isi" rows="3"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
