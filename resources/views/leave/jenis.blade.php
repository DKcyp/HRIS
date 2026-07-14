@extends('layouts.app')

@section('title', 'Jenis Cuti - HRIS V2')
@section('page-title', 'Manajemen Jenis Cuti')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Data Jenis Cuti</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Nama Jenis</th><th class="text-center">Jumlah Hari</th><th>Deskripsi</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($jenis as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $j->kode }}</code></td>
                        <td><strong>{{ $j->nama }}</strong></td>
                        <td class="text-center"><span class="badge bg-primary">{{ $j->jumlah_hari }} hari</span></td>
                        <td>{{ $j->deskripsi }}</td>
                        <td class="text-center">@if($j->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $j->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $j->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $j->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('leave.jenis.update', $j->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Jenis Cuti</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $j->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Nama Jenis</label><input type="text" class="form-control" name="nama" value="{{ $j->nama }}"></div>
                                <div class="mb-3"><label class="form-label">Jumlah Hari</label><input type="number" class="form-control" name="jumlah_hari" value="{{ $j->jumlah_hari }}"></div>
                                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2">{{ $j->deskripsi }}</textarea></div>
                                <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="aktif" {{ $j->status=='aktif'?'selected':'' }}>Aktif</option><option value="non-aktif" {{ $j->status=='non-aktif'?'selected':'' }}>Non-aktif</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $j->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('leave.jenis.destroy', $j->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Jenis Cuti</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $j->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-tags fa-3x mb-3 d-block"></i><p>Belum ada data jenis cuti</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('leave.jenis.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Jenis Cuti</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Nama Jenis <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div>
            <div class="mb-3"><label class="form-label">Jumlah Hari</label><input type="number" class="form-control" name="jumlah_hari"></div>
            <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2"></textarea></div>
            <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="aktif">Aktif</option><option value="non-aktif">Non-aktif</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
