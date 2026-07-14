@extends('layouts.app')
@section('title', 'BPJS - HRIS V2')
@section('page-title', 'Data BPJS Karyawan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-heartbeat me-2"></i>Data BPJS Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>BPJS Kes</th><th>BPJS TK</th><th>JKM</th><th>JHT</th><th>JP</th><th>Total</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($bpjs as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $b->nik }}</code></td>
                        <td><strong>{{ $b->nama }}</strong></td>
                        <td class="text-end">Rp {{ number_format($b->bpjs_kesehatan,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($b->bpjs_ketenagakerjaan,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($b->jkm,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($b->jht,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($b->jp,0,',','.') }}</td>
                        <td class="text-end fw-bold text-primary">Rp {{ number_format($b->total,0,',','.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $b->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $b->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $b->id }}" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
                        <form action="{{ route('payroll.bpjs.update', $b->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit BPJS</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $b->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $b->nama }}"></div></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">BPJS Kesehatan</label><input type="number" class="form-control" name="bpjs_kesehatan" value="{{ $b->bpjs_kesehatan }}"></div><div class="col-md-4"><label class="form-label">BPJS Ketenagakerjaan</label><input type="number" class="form-control" name="bpjs_ketenagakerjaan" value="{{ $b->bpjs_ketenagakerjaan }}"></div><div class="col-md-4"><label class="form-label">JKM</label><input type="number" class="form-control" name="jkm" value="{{ $b->jkm }}"></div></div>
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">JHT</label><input type="number" class="form-control" name="jht" value="{{ $b->jht }}"></div><div class="col-md-6"><label class="form-label">JP</label><input type="number" class="form-control" name="jp" value="{{ $b->jp }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $b->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('payroll.bpjs.destroy', $b->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $b->nama }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-heartbeat fa-3x mb-3 d-block"></i><p>Belum ada data BPJS</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
    <form action="{{ route('payroll.bpjs.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah BPJS</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">BPJS Kesehatan</label><input type="number" class="form-control" name="bpjs_kesehatan"></div><div class="col-md-4"><label class="form-label">BPJS Ketenagakerjaan</label><input type="number" class="form-control" name="bpjs_ketenagakerjaan"></div><div class="col-md-4"><label class="form-label">JKM</label><input type="number" class="form-control" name="jkm"></div></div>
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">JHT</label><input type="number" class="form-control" name="jht"></div><div class="col-md-6"><label class="form-label">JP</label><input type="number" class="form-control" name="jp"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
