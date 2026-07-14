@extends('layouts.app')
@section('title', 'Clearance - HRIS V2')
@section('page-title', 'Data Clearance')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Data Clearance</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Divisi</th><th>Tgl Clearance</th><th class="text-center">IT</th><th class="text-center">Finance</th><th class="text-center">HRD</th><th class="text-center">Office</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($clearances as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $c->nik }}</code></td>
                        <td><strong>{{ $c->nama }}</strong></td>
                        <td>{{ $c->jabatan }}</td>
                        <td>{{ $c->divisi }}</td>
                        <td>{{ $c->tanggal_clearance }}</td>
                        <td class="text-center">@if($c->it_clean=='Ya')<span class="badge bg-success">Ya</span>@else<span class="badge bg-danger">Belum</span>@endif</td>
                        <td class="text-center">@if($c->finance_clean=='Ya')<span class="badge bg-success">Ya</span>@else<span class="badge bg-danger">Belum</span>@endif</td>
                        <td class="text-center">@if($c->hrd_clean=='Ya')<span class="badge bg-success">Ya</span>@else<span class="badge bg-danger">Belum</span>@endif</td>
                        <td class="text-center">@if($c->office_clean=='Ya')<span class="badge bg-success">Ya</span>@else<span class="badge bg-danger">Belum</span>@endif</td>
                        <td class="text-center">@if($c->status=='lengkap')<span class="badge bg-success">Lengkap</span>@else<span class="badge bg-warning">Belum Lengkap</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $c->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $c->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $c->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.clearance.update', $c->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Clearance</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $c->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $c->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $c->jabatan }}"></div><div class="col-md-6"><label class="form-label">Divisi</label><input type="text" class="form-control" name="divisi" value="{{ $c->divisi }}"></div></div>
                                <div class="mb-3"><label class="form-label">Tgl Clearance</label><input type="date" class="form-control" name="tanggal_clearance" value="{{ $c->tanggal_clearance }}"></div>
                                <div class="row mb-3"><div class="col-md-3"><label class="form-label">IT</label><select class="form-select" name="it_clean"><option value="Ya" {{ $c->it_clean=='Ya' ? 'selected' : '' }}>Ya</option><option value="Belum" {{ $c->it_clean=='Belum' ? 'selected' : '' }}>Belum</option></select></div><div class="col-md-3"><label class="form-label">Finance</label><select class="form-select" name="finance_clean"><option value="Ya" {{ $c->finance_clean=='Ya' ? 'selected' : '' }}>Ya</option><option value="Belum" {{ $c->finance_clean=='Belum' ? 'selected' : '' }}>Belum</option></select></div><div class="col-md-3"><label class="form-label">HRD</label><select class="form-select" name="hrd_clean"><option value="Ya" {{ $c->hrd_clean=='Ya' ? 'selected' : '' }}>Ya</option><option value="Belum" {{ $c->hrd_clean=='Belum' ? 'selected' : '' }}>Belum</option></select></div><div class="col-md-3"><label class="form-label">Office</label><select class="form-select" name="office_clean"><option value="Ya" {{ $c->office_clean=='Ya' ? 'selected' : '' }}>Ya</option><option value="Belum" {{ $c->office_clean=='Belum' ? 'selected' : '' }}>Belum</option></select></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $c->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('resign.clearance.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $c->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="12" class="text-center py-5 text-muted"><i class="fas fa-clipboard-check fa-3x mb-3 d-block"></i><p>Belum ada data clearance</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('resign.clearance.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Clearance</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div><div class="col-md-6"><label class="form-label">Divisi</label><input type="text" class="form-control" name="divisi"></div></div>
            <div class="mb-3"><label class="form-label">Tgl Clearance</label><input type="date" class="form-control" name="tanggal_clearance"></div>
            <div class="row mb-3"><div class="col-md-3"><label class="form-label">IT</label><select class="form-select" name="it_clean"><option value="Ya">Ya</option><option value="Belum">Belum</option></select></div><div class="col-md-3"><label class="form-label">Finance</label><select class="form-select" name="finance_clean"><option value="Ya">Ya</option><option value="Belum">Belum</option></select></div><div class="col-md-3"><label class="form-label">HRD</label><select class="form-select" name="hrd_clean"><option value="Ya">Ya</option><option value="Belum">Belum</option></select></div><div class="col-md-3"><label class="form-label">Office</label><select class="form-select" name="office_clean"><option value="Ya">Ya</option><option value="Belum">Belum</option></select></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
