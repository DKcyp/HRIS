@extends('layouts.app')
@section('title', 'Gaji Pokok - HRIS V2')
@section('page-title', 'Data Gaji Pokok')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-coins me-2"></i>Data Gaji Pokok</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Grade</th><th>Gaji Pokok</th><th>Effective Date</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($gajiPokoks as $g)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $g->nik }}</code></td>
                        <td><strong>{{ $g->nama }}</strong></td>
                        <td>{{ $g->jabatan }}</td>
                        <td><span class="badge bg-info">{{ $g->grade }}</span></td>
                        <td class="text-end fw-bold text-success">Rp {{ number_format($g->gaji_pokok,0,',','.') }}</td>
                        <td>{{ $g->effective_date }}</td>
                        <td class="text-center">@if($g->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Non-aktif</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $g->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $g->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $g->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('payroll.gaji-pokok.update', $g->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Gaji Pokok</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $g->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $g->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $g->jabatan }}"></div><div class="col-md-4"><label class="form-label">Grade</label><input type="text" class="form-control" name="grade" value="{{ $g->grade }}"></div><div class="col-md-4"><label class="form-label">Gaji Pokok</label><input type="number" class="form-control" name="gaji_pokok" value="{{ $g->gaji_pokok }}"></div></div>
                                <div class="mb-3"><label class="form-label">Effective Date</label><input type="date" class="form-control" name="effective_date" value="{{ $g->effective_date }}"></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $g->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('payroll.gaji-pokok.destroy', $g->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $g->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-coins fa-3x mb-3 d-block"></i><p>Belum ada data gaji pokok</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('payroll.gaji-pokok.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Gaji Pokok</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div><div class="col-md-4"><label class="form-label">Grade</label><input type="text" class="form-control" name="grade"></div><div class="col-md-4"><label class="form-label">Gaji Pokok</label><input type="number" class="form-control" name="gaji_pokok"></div></div>
            <div class="mb-3"><label class="form-label">Effective Date</label><input type="date" class="form-control" name="effective_date"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
