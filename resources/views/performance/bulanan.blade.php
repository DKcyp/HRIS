@extends('layouts.app')
@section('title', 'Penilaian Bulanan - HRIS V2')
@section('page-title', 'Data Penilaian Bulanan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-month me-2"></i>Data Penilaian Bulanan</h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;"><option>Semua Bulan</option><option>Maret 2024</option><option>Februari 2024</option><option>Januari 2024</option></select>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Bulan</th><th class="text-center">Target</th><th class="text-center">Realisasi</th><th class="text-center">%</th><th class="text-center">Nilai</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($bulanan as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $b->nik }}</code></td>
                        <td><strong>{{ $b->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $b->bulan }}</span></td>
                        <td class="text-center">{{ $b->target_kerja }}</td>
                        <td class="text-center">{{ $b->realisasi_kerja }}</td>
                        <td class="text-center"><span class="badge bg-{{ $b->persentase>=100?'success':'warning text-dark' }}">{{ $b->persentase }}%</span></td>
                        <td class="text-center"><strong class="text-primary">{{ $b->nilai }}</strong></td>
                        <td class="text-center">@if($b->status=='tercapai')<span class="badge bg-success">Tercapai</span>@else<span class="badge bg-warning text-dark">Hampir Tercapai</span>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $b->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $b->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $b->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.bulanan.update', $b->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Penilaian</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $b->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $b->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Bulan</label><input type="text" class="form-control" name="bulan" value="{{ $b->bulan }}"></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Target</label><input type="number" class="form-control" name="target_kerja" value="{{ $b->target_kerja }}"></div><div class="col-md-4"><label class="form-label">Realisasi</label><input type="number" class="form-control" name="realisasi_kerja" value="{{ $b->realisasi_kerja }}"></div><div class="col-md-4"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai" value="{{ $b->nilai }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $b->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.bulanan.destroy', $b->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $b->nama }} - {{ $b->bulan }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-calendar-month fa-3x mb-3 d-block"></i><p>Belum ada data penilaian bulanan</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.bulanan.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Penilaian Bulanan</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Bulan</label><input type="text" class="form-control" name="bulan" placeholder="Contoh: Maret 2024"></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Target</label><input type="number" class="form-control" name="target_kerja"></div><div class="col-md-4"><label class="form-label">Realisasi</label><input type="number" class="form-control" name="realisasi_kerja"></div><div class="col-md-4"><label class="form-label">Nilai</label><input type="number" class="form-control" name="nilai"></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
