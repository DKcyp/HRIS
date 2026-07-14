@extends('layouts.app')
@section('title', 'Event - HRIS V2')
@section('page-title', 'Data Event')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Data Event</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Judul</th><th>Deskripsi</th><th>Tgl Mulai</th><th>Tgl Selesai</th><th>Lokasi</th><th>Peserta</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($events as $e)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $e->kode }}</code></td>
                        <td><strong>{{ $e->judul }}</strong></td>
                        <td>{{ Str::limit($e->deskripsi, 40) }}</td>
                        <td>{{ $e->tanggal_mulai }}</td>
                        <td>{{ $e->tanggal_selesai }}</td>
                        <td>{{ $e->lokasi }}</td>
                        <td>{{ $e->peserta }}</td>
                        <td class="text-center">@if($e->status=='aktif')<span class="badge bg-success">Aktif</span>@elseif($e->status=='selesai')<span class="badge bg-secondary">Selesai</span>@else<span class="badge bg-warning">Draft</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $e->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $e->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $e->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('pengumuman.event.update', $e->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Event</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $e->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Judul</label><input type="text" class="form-control" name="judul" value="{{ $e->judul }}"></div>
                                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2">{{ $e->deskripsi }}</textarea></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Mulai</label><input type="date" class="form-control" name="tanggal_mulai" value="{{ $e->tanggal_mulai }}"></div><div class="col-md-6"><label class="form-label">Tgl Selesai</label><input type="date" class="form-control" name="tanggal_selesai" value="{{ $e->tanggal_selesai }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi" value="{{ $e->lokasi }}"></div><div class="col-md-6"><label class="form-label">Peserta</label><input type="text" class="form-control" name="peserta" value="{{ $e->peserta }}"></div></div>
                                <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="aktif" {{ $e->status=='aktif' ? 'selected' : '' }}>Aktif</option><option value="selesai" {{ $e->status=='selesai' ? 'selected' : '' }}>Selesai</option><option value="draft" {{ $e->status=='draft' ? 'selected' : '' }}>Draft</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $e->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('pengumuman.event.destroy', $e->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $e->judul }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-calendar-day fa-3x mb-3 d-block"></i><p>Belum ada data event</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('pengumuman.event.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Event</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" class="form-control" name="judul" required></div>
            <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2"></textarea></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Mulai</label><input type="date" class="form-control" name="tanggal_mulai"></div><div class="col-md-6"><label class="form-label">Tgl Selesai</label><input type="date" class="form-control" name="tanggal_selesai"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi"></div><div class="col-md-6"><label class="form-label">Peserta</label><input type="text" class="form-control" name="peserta"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
