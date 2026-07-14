@extends('layouts.app')
@section('title', 'NDA - HRIS V2')
@section('page-title', 'Data NDA (Non-Disclosure Agreement)')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-shield me-2"></i>Data NDA</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Tgl Tandatangan</th><th>Masa Berlaku</th><th>Jenis</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($ndas as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $n->kode }}</code></td>
                        <td><code>{{ $n->nik }}</code></td>
                        <td><strong>{{ $n->nama }}</strong></td>
                        <td>{{ $n->jabatan }}</td>
                        <td>{{ $n->tanggal_tandatangan }}</td>
                        <td><span class="badge bg-info">{{ $n->masa_berlaku }}</span></td>
                        <td><span class="badge bg-primary">{{ $n->jenis }}</span></td>
                        <td class="text-center">@if($n->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-danger">Kadaluarsa</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $n->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $n->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $n->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.nda.update', $n->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit NDA</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $n->kode }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $n->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $n->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan" value="{{ $n->jabatan }}"></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Tgl Tandatangan</label><input type="date" class="form-control" name="tanggal_tandatangan" value="{{ $n->tanggal_tandatangan }}"></div><div class="col-md-4"><label class="form-label">Masa Berlaku</label><input type="text" class="form-control" name="masa_berlaku" value="{{ $n->masa_berlaku }}"></div><div class="col-md-4"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="Confidentiality" @if($n->jenis=='Confidentiality')selected@endif>Confidentiality</option><option value="Non-Disclosure" @if($n->jenis=='Non-Disclosure')selected@endif>Non-Disclosure</option></select></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $n->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('dokumen.nda.destroy', $n->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $n->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-file-shield fa-3x mb-3 d-block"></i><p>Belum ada data NDA</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('dokumen.nda.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah NDA</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Jabatan</label><input type="text" class="form-control" name="jabatan"></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Tgl Tandatangan</label><input type="date" class="form-control" name="tanggal_tandatangan"></div><div class="col-md-4"><label class="form-label">Masa Berlaku</label><input type="text" class="form-control" name="masa_berlaku"></div><div class="col-md-4"><label class="form-label">Jenis</label><select class="form-select" name="jenis"><option value="Confidentiality">Confidentiality</option><option value="Non-Disclosure">Non-Disclosure</option></select></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
