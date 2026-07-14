@extends('layouts.app')
@section('title', 'SOP - HRIS V2')
@section('page-title', 'Data SOP')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book me-2"></i>Data SOP</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Judul</th><th>Deskripsi</th><th>Versi</th><th>Tgl Efektif</th><th>Penanggung Jawab</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($sops as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->kode }}</code></td>
                        <td><strong>{{ $s->judul }}</strong></td>
                        <td>{{ Str::limit($s->deskripsi, 40) }}</td>
                        <td><span class="badge bg-primary">v{{ $s->versi }}</span></td>
                        <td>{{ $s->tanggal_efektif }}</td>
                        <td>{{ $s->penanggung_jawab }}</td>
                        <td class="text-center">@if($s->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.sop.update', $s->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit SOP</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $s->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Judul</label><input type="text" class="form-control" name="judul" value="{{ $s->judul }}"></div>
                                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2">{{ $s->deskripsi }}</textarea></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Versi</label><input type="text" class="form-control" name="versi" value="{{ $s->versi }}"></div><div class="col-md-4"><label class="form-label">Tgl Efektif</label><input type="date" class="form-control" name="tanggal_efektif" value="{{ $s->tanggal_efektif }}"></div><div class="col-md-4"><label class="form-label">Penanggung Jawab</label><input type="text" class="form-control" name="penanggung_jawab" value="{{ $s->penanggung_jawab }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.sop.destroy', $s->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $s->judul }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-book fa-3x mb-3 d-block"></i><p>Belum ada data SOP</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('dokumen.sop.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah SOP</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" class="form-control" name="judul" required></div>
            <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2"></textarea></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Versi</label><input type="text" class="form-control" name="versi"></div><div class="col-md-4"><label class="form-label">Tgl Efektif</label><input type="date" class="form-control" name="tanggal_efektif"></div><div class="col-md-4"><label class="form-label">Penanggung Jawab</label><input type="text" class="form-control" name="penanggung_jawab"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
