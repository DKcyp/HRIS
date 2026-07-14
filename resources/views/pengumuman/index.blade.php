@extends('layouts.app')
@section('title', 'News - HRIS V2')
@section('page-title', 'Data Pengumuman')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Data Pengumuman</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Judul</th><th>Isi</th><th>Pengirim</th><th>Tanggal</th><th class="text-center">Kategori</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($news as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $n->kode }}</code></td>
                        <td><strong>{{ $n->judul }}</strong></td>
                        <td>{{ Str::limit($n->isi, 50) }}</td>
                        <td>{{ $n->pengirim }}</td>
                        <td>{{ $n->tanggal }}</td>
                        <td class="text-center"><span class="badge bg-info">{{ $n->kategori }}</span></td>
                        <td class="text-center">@if($n->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Draft</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $n->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $n->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $n->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('pengumuman.index.update', $n->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Pengumuman</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $n->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Judul</label><input type="text" class="form-control" name="judul" value="{{ $n->judul }}"></div>
                                <div class="mb-3"><label class="form-label">Isi</label><textarea class="form-control" name="isi" rows="3">{{ $n->isi }}</textarea></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Pengirim</label><input type="text" class="form-control" name="pengirim" value="{{ $n->pengirim }}"></div><div class="col-md-6"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $n->tanggal }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kategori</label><select class="form-select" name="kategori"><option value="Penting" @if($n->kategori=='Penting')selected@endif>Penting</option><option value="Pengumuman" @if($n->kategori=='Pengumuman')selected@endif>Pengumuman</option><option value="Training" @if($n->kategori=='Training')selected@endif>Training</option><option value="Teknis" @if($n->kategori=='Teknis')selected@endif>Teknis</option></select></div><div class="col-md-6"><label class="form-label">Status</label><select class="form-select" name="status"><option value="aktif" @if($n->status=='aktif')selected@endif>Aktif</option><option value="draft" @if($n->status=='draft')selected@endif>Draft</option></select></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $n->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('pengumuman.index.destroy', $n->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $n->judul }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-bullhorn fa-3x mb-3 d-block"></i><p>Belum ada data pengumuman</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('pengumuman.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Pengumuman</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" class="form-control" name="judul" required></div>
            <div class="mb-3"><label class="form-label">Isi</label><textarea class="form-control" name="isi" rows="3"></textarea></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Pengirim</label><input type="text" class="form-control" name="pengirim"></div><div class="col-md-6"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div></div>
            <div class="mb-3"><label class="form-label">Kategori</label><select class="form-select" name="kategori"><option value="Penting">Penting</option><option value="Pengumuman">Pengumuman</option><option value="Training">Training</option><option value="Teknis">Teknis</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
