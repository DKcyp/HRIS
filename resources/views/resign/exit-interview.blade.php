@extends('layouts.app')
@section('title', 'Exit Interview - HRIS V2')
@section('page-title', 'Data Exit Interview')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-comments me-2"></i>Data Exit Interview</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Tgl Exit</th><th>Interviewer</th><th>Hasil</th><th>Rekomendasi</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($interviews as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $i->nik }}</code></td>
                        <td><strong>{{ $i->nama }}</strong></td>
                        <td>{{ $i->jabatan }}</td>
                        <td>{{ $i->tanggal_exit }}</td>
                        <td>{{ $i->interviewer }}</td>
                        <td>{{ Str::limit($i->hasil, 40) }}</td>
                        <td>{{ Str::limit($i->rekomendasi, 30) }}</td>
                        <td class="text-center">@if($i->status=='selesai')<span class="badge bg-success">Selesai</span>@else<span class="badge bg-warning">Belum</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $i->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $i->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $i->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.exit-interview.update', $i->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Exit Interview</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $i->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $i->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $i->jabatan }}"></div><div class="col-md-6"><label class="form-label">Tgl Exit</label><input type="date" class="form-control" name="tanggal_exit" value="{{ $i->tanggal_exit }}"></div></div>
                                <div class="mb-3"><label class="form-label">Interviewer</label><input type="text" class="form-control" name="interviewer" value="{{ $i->interviewer }}"></div>
                                <div class="mb-3"><label class="form-label">Hasil</label><textarea class="form-control" name="hasil" rows="2">{{ $i->hasil }}</textarea></div>
                                <div class="mb-3"><label class="form-label">Rekomendasi</label><textarea class="form-control" name="rekomendasi" rows="2">{{ $i->rekomendasi }}</textarea></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $i->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.exit-interview.destroy', $i->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $i->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-comments fa-3x mb-3 d-block"></i><p>Belum ada data exit interview</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('resign.exit-interview.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Exit Interview</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div><div class="col-md-6"><label class="form-label">Tgl Exit</label><input type="date" class="form-control" name="tanggal_exit"></div></div>
            <div class="mb-3"><label class="form-label">Interviewer</label><input type="text" class="form-control" name="interviewer"></div>
            <div class="mb-3"><label class="form-label">Hasil</label><textarea class="form-control" name="hasil" rows="2"></textarea></div>
            <div class="mb-3"><label class="form-label">Rekomendasi</label><textarea class="form-control" name="rekomendasi" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
