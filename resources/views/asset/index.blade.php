@extends('layouts.app')
@section('title', 'Data Asset - HRIS V2')
@section('page-title', 'Data Asset')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-laptop me-2"></i>Data Asset</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode</th><th>Nama Asset</th><th>Kategori</th><th>Merek</th><th>Model</th><th>Tahun</th><th>Kondisi</th><th>Lokasi</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($assets as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $a->kode }}</code></td>
                        <td><strong>{{ $a->nama }}</strong></td>
                        <td>{{ $a->kategori }}</td>
                        <td>{{ $a->merek }}</td>
                        <td>{{ $a->model }}</td>
                        <td>{{ $a->tahun }}</td>
                        <td>@if($a->kondisi=='baik')<span class="badge bg-success">Baik</span>@elseif($a->kondisi=='rusak_ringan')<span class="badge bg-warning">Rusak Ringan</span>@else<span class="badge bg-danger">Rusak Berat</span>@endif</td>
                        <td>{{ $a->lokasi }}</td>
                        <td class="text-center">@if($a->status=='tersedia')<span class="badge bg-success">Tersedia</span>@else<span class="badge bg-warning">Dipinjam</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $a->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $a->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('asset.index.update', $a->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Asset</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="mb-3"><label class="form-label">Kode</label><input type="text" class="form-control" name="kode" value="{{ $a->kode }}"></div>
                                <div class="mb-3"><label class="form-label">Nama Asset</label><input type="text" class="form-control" name="nama" value="{{ $a->nama }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kategori</label><select class="form-select" name="kategori"><option value="Elektonik" @if($a->kategori=='Elektonik')selected@endif>Elektonik</option><option value="Furniture" @if($a->kategori=='Furniture')selected@endif>Furniture</option><option value="Kendaraan" @if($a->kategori=='Kendaraan')selected@endif>Kendaraan</option></select></div><div class="col-md-6"><label class="form-label">Merek</label><input type="text" class="form-control" name="merek" value="{{ $a->merek }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Model</label><input type="text" class="form-control" name="model" value="{{ $a->model }}"></div><div class="col-md-6"><label class="form-label">Tahun</label><input type="number" class="form-control" name="tahun" value="{{ $a->tahun }}"></div></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Kondisi</label><select class="form-select" name="kondisi"><option value="baik" @if($a->kondisi=='baik')selected@endif>Baik</option><option value="rusak_ringan" @if($a->kondisi=='rusak_ringan')selected@endif>Rusak Ringan</option><option value="rusak_berat" @if($a->kondisi=='rusak_berat')selected@endif>Rusak Berat</option></select></div><div class="col-md-4"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi" value="{{ $a->lokasi }}"></div><div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status"><option value="tersedia" @if($a->status=='tersedia')selected@endif>Tersedia</option><option value="dipinjam" @if($a->status=='dipinjam')selected@endif>Dipinjam</option></select></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $a->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('asset.index.destroy', $a->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $a->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="11" class="text-center py-5 text-muted"><i class="fas fa-laptop fa-3x mb-3 d-block"></i><p>Belum ada data asset</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('asset.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Asset</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Kode <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode" required></div>
            <div class="mb-3"><label class="form-label">Nama Asset <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kategori</label><select class="form-select" name="kategori"><option value="Elektonik">Elektonik</option><option value="Furniture">Furniture</option><option value="Kendaraan">Kendaraan</option></select></div><div class="col-md-6"><label class="form-label">Merek</label><input type="text" class="form-control" name="merek"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Model</label><input type="text" class="form-control" name="model"></div><div class="col-md-6"><label class="form-label">Tahun</label><input type="number" class="form-control" name="tahun"></div></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Kondisi</label><select class="form-select" name="kondisi"><option value="baik">Baik</option><option value="rusak_ringan">Rusak Ringan</option><option value="rusak_berat">Rusak Berat</option></select></div><div class="col-md-4"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi"></div><div class="col-md-4"><label class="form-label">Harga</label><input type="number" class="form-control" name="harga"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
