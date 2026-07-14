@extends('layouts.app')
@section('title', 'Penilaian - HRIS V2')
@section('page-title', 'Data Penilaian Karyawan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Data Penilaian Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jabatan</th><th>Periode</th><th class="text-center">Kerja</th><th class="text-center">Sikap</th><th class="text-center">Target</th><th class="text-center">Total</th><th class="text-center">Grade</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($penilaians as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $p->nik }}</code></td>
                        <td><strong>{{ $p->nama }}</strong></td>
                        <td>{{ $p->jabatan }}</td>
                        <td><span class="badge bg-info">{{ $p->periode }}</span></td>
                        <td class="text-center">{{ $p->nilai_kerja }}</td>
                        <td class="text-center">{{ $p->nilai_sikap }}</td>
                        <td class="text-center">{{ $p->nilai_target }}</td>
                        <td class="text-center"><strong class="text-primary">{{ $p->total }}</strong></td>
                        <td class="text-center">
                            @if($p->grade=='A')<span class="badge bg-success">A</span>
                            @elseif($p->grade=='B')<span class="badge bg-info">B</span>
                            @elseif($p->grade=='C')<span class="badge bg-warning text-dark">C</span>
                            @else<span class="badge bg-danger">{{ $p->grade }}</span>@endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.index.update', $p->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Penilaian</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $p->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $p->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode" value="{{ $p->periode }}"></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai Kerja</label><input type="number" class="form-control" name="nilai_kerja" value="{{ $p->nilai_kerja }}"></div><div class="col-md-4"><label class="form-label">Nilai Sikap</label><input type="number" class="form-control" name="nilai_sikap" value="{{ $p->nilai_sikap }}"></div><div class="col-md-4"><label class="form-label">Nilai Target</label><input type="number" class="form-control" name="nilai_target" value="{{ $p->nilai_target }}"></div></div>
                                <div class="mb-3"><label class="form-label">Grade</label><select class="form-select" name="grade"><option value="A" {{ $p->grade=='A'?'selected':'' }}>A</option><option value="B" {{ $p->grade=='B'?'selected':'' }}>B</option><option value="C" {{ $p->grade=='C'?'selected':'' }}>C</option><option value="D" {{ $p->grade=='D'?'selected':'' }}>D</option></select></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.index.destroy', $p->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $p->nama }} - {{ $p->periode }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty<tr><td colspan="11" class="text-center py-5 text-muted"><i class="fas fa-chart-line fa-3x mb-3 d-block"></i><p>Belum ada data penilaian</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.index.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Penilaian</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode" placeholder="Contoh: Maret 2024"></div>
            <div class="row mb-3"><div class="col-md-4"><label class="form-label">Nilai Kerja</label><input type="number" class="form-control" name="nilai_kerja"></div><div class="col-md-4"><label class="form-label">Nilai Sikap</label><input type="number" class="form-control" name="nilai_sikap"></div><div class="col-md-4"><label class="form-label">Nilai Target</label><input type="number" class="form-control" name="nilai_target"></div></div>
            <div class="mb-3"><label class="form-label">Grade</label><select class="form-select" name="grade"><option>A</option><option>B</option><option>C</option><option>D</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
