@extends('layouts.app')
@section('title', 'Semua Dokumen - HRIS V2')
@section('page-title', 'Data Semua Dokumen')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-folder-open me-2"></i>Data Semua Dokumen</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Judul</th><th>Jenis</th><th>Kategori</th><th>File</th><th>Uploader</th><th>Tanggal</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($documents as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $d->kode }}</code></td>
                        <td><strong>{{ $d->judul }}</strong></td>
                        <td><span class="badge bg-info">{{ $d->jenis }}</span></td>
                        <td>{{ $d->kategori }}</td>
                        <td><a href="#" class="text-decoration-none"><i class="fas fa-file-pdf me-1"></i>{{ $d->file }}</a></td>
                        <td>{{ $d->uploader }}</td>
                        <td>{{ $d->tanggal }}</td>
                        <td class="text-center">@if($d->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $d->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.index.update', $d->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Dokumen</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $d->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Judul</label><input type="text" class="form-control" name="judul" value="{{ $d->judul }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="SOP" @if($d->jenis=='SOP')selected@endif>SOP</option><option value="Kontrak" @if($d->jenis=='Kontrak')selected@endif>Kontrak</option><option value="PKWT" @if($d->jenis=='PKWT')selected@endif>PKWT</option><option value="NDA" @if($d->jenis=='NDA')selected@endif>NDA</option><option value="Surat Peringatan" @if($d->jenis=='Surat Peringatan')selected@endif>Surat Peringatan</option></select></div><div class="col-md-6"><label class="form-label">Kategori</label><input type="text" class="form-control" name="kategori" value="{{ $d->kategori }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Uploader</label><input type="text" class="form-control" name="uploader" value="{{ $d->uploader }}"></div><div class="col-md-6"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $d->tanggal }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $d->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.index.destroy', $d->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $d->judul }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-folder-open fa-3x mb-3 d-block"></i><p>Belum ada data dokumen</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('dokumen.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Dokumen</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" class="form-control" name="judul" required></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="SOP">SOP</option><option value="Kontrak">Kontrak</option><option value="PKWT">PKWT</option><option value="NDA">NDA</option><option value="Surat Peringatan">Surat Peringatan</option></select></div><div class="col-md-6"><label class="form-label">Kategori</label><input type="text" class="form-control" name="kategori"></div></div>
            <div class="mb-3"><label class="form-label">File</label><input type="file" class="form-control" name="file"></div>
            <div class="mb-3"><label class="form-label">Uploader</label><input type="text" class="form-control" name="uploader"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
