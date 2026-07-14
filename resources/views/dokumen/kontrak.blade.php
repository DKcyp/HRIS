@extends('layouts.app')
@section('title', 'Kontrak - HRIS V2')
@section('page-title', 'Data Kontrak Kerja')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-contract me-2"></i>Data Kontrak Kerja</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Tgl Mulai</th><th>Tgl Akhir</th><th>Durasi</th><th>Jenis</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($contracts as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $c->kode }}</code></td>
                        <td><code>{{ $c->nik }}</code></td>
                        <td><strong>{{ $c->nama }}</strong></td>
                        <td>{{ $c->jabatan }}</td>
                        <td>{{ $c->tanggal_mulai }}</td>
                        <td>{{ $c->tanggal_akhir }}</td>
                        <td><span class="badge bg-info">{{ $c->durasi }}</span></td>
                        <td><span class="badge bg-primary">{{ $c->jenis }}</span></td>
                        <td class="text-center">@if($c->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $c->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $c->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $c->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.kontrak.update', $c->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Kontrak</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $c->kode }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $c->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $c->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $c->jabatan }}"></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Tgl Mulai</label><input type="date" class="form-control" name="tanggal_mulai" value="{{ $c->tanggal_mulai }}"></div><div class="col-md-4"><label class="form-label">Tgl Akhir</label><input type="date" class="form-control" name="tanggal_akhir" value="{{ $c->tanggal_akhir }}"></div><div class="col-md-4"><label class="form-label">Durasi</label><input type="text" class="form-control" name="durasi" value="{{ $c->durasi }}"></div></div>
                                <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="PKWT" {{ $c->jenis=='PKWT' ? 'selected' : '' }}>PKWT</option><option value="PKWTT" {{ $c->jenis=='PKWTT' ? 'selected' : '' }}>PKWTT</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $c->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.kontrak.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $c->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="11" class="text-center py-5 text-muted"><i class="fas fa-file-contract fa-3x mb-3 d-block"></i><p>Belum ada data kontrak</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('dokumen.kontrak.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Kontrak</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Tgl Mulai</label><input type="date" class="form-control" name="tanggal_mulai"></div><div class="col-md-4"><label class="form-label">Tgl Akhir</label><input type="date" class="form-control" name="tanggal_akhir"></div><div class="col-md-4"><label class="form-label">Durasi</label><input type="text" class="form-control" name="durasi"></div></div>
            <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="PKWT">PKWT</option><option value="PKWTT">PKWTT</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
