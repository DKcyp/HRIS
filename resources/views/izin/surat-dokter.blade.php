@extends('layouts.app')

@section('title', 'Surat Dokter - HRIS V2')
@section('page-title', 'Data Surat Dokter')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-prescription me-2"></i>Data Surat Dokter</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Tanggal</th><th>Nama Dokter</th><th>Rumah Sakit</th><th>Diagnosa</th><th>File</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($surats as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->nik }}</code></td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td>{{ $s->tanggal }}</td>
                        <td>{{ $s->nama_dokter }}</td>
                        <td>{{ $s->rumah_sakit }}</td>
                        <td>{{ $s->diagnosa }}</td>
                        <td><a href="#" class="text-primary"><i class="fas fa-file-pdf me-1"></i>{{ $s->file }}</a></td>
                        <td class="text-center">@if($s->status=='verified')<span class="badge bg-success">Verified</span>@else<span class="badge bg-warning text-dark">Pending</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $s->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('izin.surat-dokter.update', $s->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Surat Dokter</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $s->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $s->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $s->tanggal }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Nama Dokter</label><input type="text" class="form-control" name="nama_dokter" value="{{ $s->nama_dokter }}"></div><div class="col-md-6"><label class="form-label">Rumah Sakit</label><input type="text" class="form-control" name="rumah_sakit" value="{{ $s->rumah_sakit }}"></div></div>
                                <div class="mb-3"><label class="form-label">Diagnosa</label><input type="text" class="form-control" name="diagnosa" value="{{ $s->diagnosa }}"></div>
                                <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="pending" {{ $s->status=='pending'?'selected':'' }}>Pending</option><option value="verified" {{ $s->status=='verified'?'selected':'' }}>Verified</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('izin.surat-dokter.destroy', $s->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Surat Dokter</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $s->nama }} - {{ $s->tanggal }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-file-prescription fa-3x mb-3 d-block"></i><p>Belum ada data surat dokter</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('izin.surat-dokter.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Surat Dokter</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Nama Dokter</label><input type="text" class="form-control" name="nama_dokter"></div><div class="col-md-6"><label class="form-label">Rumah Sakit</label><input type="text" class="form-control" name="rumah_sakit"></div></div>
            <div class="mb-3"><label class="form-label">Diagnosa</label><input type="text" class="form-control" name="diagnosa"></div>
            <div class="mb-3"><label class="form-label">File Surat</label><input type="file" class="form-control" name="file"></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
