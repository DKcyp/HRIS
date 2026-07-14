@extends('layouts.app')
@section('title', 'Pengajuan Resign - HRIS V2')
@section('page-title', 'Data Pengajuan Resign')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-door-open me-2"></i>Data Pengajuan Resign</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Divisi</th><th>Tgl Pengajuan</th><th>Tgl Terakhir</th><th>Alasan</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($resigns as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $r->nik }}</code></td>
                        <td><strong>{{ $r->nama }}</strong></td>
                        <td>{{ $r->jabatan }}</td>
                        <td>{{ $r->divisi }}</td>
                        <td>{{ $r->tanggal_pengajuan }}</td>
                        <td>{{ $r->tanggal_terakhir }}</td>
                        <td>{{ Str::limit($r->alasan, 30) }}</td>
                        <td class="text-center">@if($r->status=='disetujui')<span class="badge bg-success">Disetujui</span>@elseif($r->status=='pending')<span class="badge bg-warning">Pending</span>@else<span class="badge bg-danger">Ditolak</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $r->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.index.update', $r->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Pengajuan Resign</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $r->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $r->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $r->jabatan }}"></div><div class="col-md-6"><label class="form-label">Divisi</label><input type="text" class="form-control" name="divisi" value="{{ $r->divisi }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Pengajuan</label><input type="date" class="form-control" name="tanggal_pengajuan" value="{{ $r->tanggal_pengajuan }}"></div><div class="col-md-6"><label class="form-label">Tgl Terakhir</label><input type="date" class="form-control" name="tanggal_terakhir" value="{{ $r->tanggal_terakhir }}"></div></div>
                                <div class="mb-3"><label class="form-label">Alasan</label><textarea class="form-control" name="alasan" rows="2">{{ $r->alasan }}</textarea></div>
                                <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="disetujui" {{ $r->status=='disetujui' ? 'selected' : '' }}>Disetujui</option><option value="pending" {{ $r->status=='pending' ? 'selected' : '' }}>Pending</option><option value="ditolak" {{ $r->status=='ditolak' ? 'selected' : '' }}>Ditolak</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.index.destroy', $r->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $r->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-door-open fa-3x mb-3 d-block"></i><p>Belum ada data pengajuan resign</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('resign.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Pengajuan Resign</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div><div class="col-md-6"><label class="form-label">Divisi</label><input type="text" class="form-control" name="divisi"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Pengajuan</label><input type="date" class="form-control" name="tanggal_pengajuan"></div><div class="col-md-6"><label class="form-label">Tgl Terakhir</label><input type="date" class="form-control" name="tanggal_terakhir"></div></div>
            <div class="mb-3"><label class="form-label">Alasan</label><textarea class="form-control" name="alasan" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
