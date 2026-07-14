@extends('layouts.app')
@section('title', 'Target - HRIS V2')
@section('page-title', 'Data Target Kinerja')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-crosshairs me-2"></i>Data Target Kinerja</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Nama Target</th><th>Deskripsi</th><th class="text-center">Nilai Target</th><th>Satuan</th><th>Periode</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($targets as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $t->kode }}</code></td>
                        <td><strong>{{ $t->nama }}</strong></td>
                        <td>{{ $t->deskripsi }}</td>
                        <td class="text-center"><span class="badge bg-success">{{ number_format($t->nilai_target,0,',','.') }}</span></td>
                        <td>{{ $t->satuan }}</td>
                        <td><span class="badge bg-info">{{ $t->periode }}</span></td>
                        <td class="text-center">@if($t->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $t->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.target.update', $t->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Target</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $t->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Nama Target</label><input type="text" class="form-control" name="nama" value="{{ $t->nama }}"></div>
                                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2">{{ $t->deskripsi }}</textarea></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai Target</label><input type="number" class="form-control" name="nilai_target" value="{{ $t->nilai_target }}"></div><div class="col-md-4"><label class="form-label">Satuan</label><input type="text" class="form-control" name="satuan" value="{{ $t->satuan }}"></div><div class="col-md-4"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode" value="{{ $t->periode }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $t->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.target.destroy', $t->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $t->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-crosshairs fa-3x mb-3 d-block"></i><p>Belum ada data target</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.target.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Target</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Nama Target <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div>
            <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="2"></textarea></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai Target</label><input type="number" class="form-control" name="nilai_target"></div><div class="col-md-4"><label class="form-label">Satuan</label><input type="text" class="form-control" name="satuan"></div><div class="col-md-4"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
