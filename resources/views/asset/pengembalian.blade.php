@extends('layouts.app')
@section('title', 'Pengembalian Asset - HRIS V2')
@section('page-title', 'Data Pengembalian Asset')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-undo-alt me-2"></i>Data Pengembalian Asset</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Kode Pinjam</th><th>Asset</th><th>Peminjam</th><th>NIK</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Kondisi</th><th>Keterangan</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($returns as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $r->kode_pinjam }}</code></td>
                        <td><strong>{{ $r->asset }}</strong><br><small class="text-muted">{{ $r->kode_asset }}</small></td>
                        <td>{{ $r->peminjam }}</td>
                        <td><code>{{ $r->nik }}</code></td>
                        <td>{{ $r->tanggal_pinjam }}</td>
                        <td>{{ $r->tanggal_kembali }}</td>
                        <td>@if($r->kondisi_kembali=='baik')<span class="badge bg-success">Baik</span>@else<span class="badge bg-warning">Rusak Ringan</span>@endif</td>
                        <td>{{ $r->keterangan }}</td>
                        <td class="text-center">@if($r->status=='diterima')<span class="badge bg-success">Diterima</span>@else<span class="badge bg-warning">Pending</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $r->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('asset.pengembalian.update', $r->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Pengembalian</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kode Pinjam</label><input type="text" class="form-control" name="kode_pinjam" value="{{ $r->kode_pinjam }}"></div><div class="col-md-6"><label class="form-label">Kode Asset</label><input type="text" class="form-control" name="kode_asset" value="{{ $r->kode_asset }}"></div></div>
                                <div class="mb-3"><label class="form-label">Asset</label><input type="text" class="form-control" name="asset" value="{{ $r->asset }}"></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Peminjam</label><input type="text" class="form-control" name="peminjam" value="{{ $r->peminjam }}"></div><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $r->nik }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Pinjam</label><input type="date" class="form-control" name="tanggal_pinjam" value="{{ $r->tanggal_pinjam }}"></div><div class="col-md-6"><label class="form-label">Tgl Kembali</label><input type="date" class="form-control" name="tanggal_kembali" value="{{ $r->tanggal_kembali }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kondisi</label><select class="form-select" name="kondisi_kembali"><option value="baik" @if($r->kondisi_kembali=='baik')selected@endif>Baik</option><option value="rusak_ringan" @if($r->kondisi_kembali=='rusak_ringan')selected@endif>Rusak Ringan</option></select></div><div class="col-md-6"><label class="form-label">Status</label><select class="form-select" name="status"><option value="diterima" @if($r->status=='diterima')selected@endif>Diterima</option><option value="pending" @if($r->status=='pending')selected@endif>Pending</option></select></div></div>
                                <div class="mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2">{{ $r->keterangan }}</textarea></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('asset.pengembalian.destroy', $r->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $r->kode_pinjam }} - {{ $r->asset }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="11" class="text-center py-5 text-muted"><i class="fas fa-undo-alt fa-3x mb-3 d-block"></i><p>Belum ada data pengembalian</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('asset.pengembalian.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Pengembalian</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kode Pinjam <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode_pinjam" required></div><div class="col-md-6"><label class="form-label">Kode Asset <span class="text-danger">*</span></label><input type="text" class="form-control" name="kode_asset" required></div></div>
            <div class="mb-3"><label class="form-label">Asset <span class="text-danger">*</span></label><input type="text" class="form-control" name="asset" required></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Peminjam</label><input type="text" class="form-control" name="peminjam"></div><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Tgl Pinjam</label><input type="date" class="form-control" name="tanggal_pinjam"></div><div class="col-md-6"><label class="form-label">Tgl Kembali</label><input type="date" class="form-control" name="tanggal_kembali"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">Kondisi</label><select class="form-select" name="kondisi_kembali"><option value="baik">Baik</option><option value="rusak_ringan">Rusak Ringan</option></select></div><div class="col-md-6"><label class="form-label">Keterangan</label><input type="text" class="form-control" name="keterangan"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
