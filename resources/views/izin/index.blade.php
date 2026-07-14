@extends('layouts.app')

@section('title', 'Izin & Sakit - HRIS V2')
@section('page-title', 'Data Izin & Sakit')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-medical me-2"></i>Data Izin & Sakit</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jenis</th><th>Tanggal</th><th>Jam</th><th>Keterangan</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($izins as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $i->nik }}</code></td>
                        <td><strong>{{ $i->nama }}</strong></td>
                        <td><span class="badge bg-{{ $i->jenis=='Sakit'?'warning text-dark':'info' }}">{{ $i->jenis }}</span></td>
                        <td>{{ $i->tanggal }}</td>
                        <td>{{ $i->jam_mulai }} - {{ $i->jam_selesai }}</td>
                        <td>{{ $i->keterangan }}</td>
                        <td class="text-center">
                            @if($i->status=='disetujui')<span class="badge bg-success">Disetujui</span>
                            @elseif($i->status=='pending')<span class="badge bg-warning text-dark">Pending</span>
                            @else<span class="badge bg-danger">Ditolak</span>@endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $i->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $i->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $i->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('izin.index.update', $i->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Izin</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $i->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $i->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="Izin" {{ $i->jenis=='Izin'?'selected':'' }}>Izin</option><option value="Sakit" {{ $i->jenis=='Sakit'?'selected':'' }}>Sakit</option></select></div>
                                <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $i->tanggal }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" name="jam_mulai" value="{{ $i->jam_mulai }}"></div><div class="col-md-6"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" name="jam_selesai" value="{{ $i->jam_selesai }}"></div></div>
                                <div class="mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2">{{ $i->keterangan }}</textarea></div>
                                <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="pending" {{ $i->status=='pending'?'selected':'' }}>Pending</option><option value="disetujui" {{ $i->status=='disetujui'?'selected':'' }}>Disetujui</option><option value="ditolak" {{ $i->status=='ditolak'?'selected':'' }}>Ditolak</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $i->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('izin.index.destroy', $i->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Izin</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $i->nama }} - {{ $i->jenis }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="9" class="text-center py-5 text-muted"><i class="fas fa-file-medical fa-3x mb-3 d-block"></i><p>Belum ada data izin</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('izin.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Izin</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option>Izin</option><option>Sakit</option></select></div>
            <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" name="jam_mulai"></div><div class="col-md-6"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" name="jam_selesai"></div></div>
            <div class="mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
