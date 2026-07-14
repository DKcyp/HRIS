@extends('layouts.app')
@section('title', 'Penilaian Tahunan - HRIS V2')
@section('page-title', 'Data Penilaian Tahunan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Data Penilaian Tahunan</h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:120px;"><option>2024</option><option>2023</option><option>2022</option></select>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Tahun</th><th class="text-center">Avg Kerja</th><th class="text-center">Avg Sikap</th><th class="text-center">Avg Target</th><th class="text-center">Total</th><th class="text-center">Grade</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($tahunan as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $t->nik }}</code></td>
                        <td><strong>{{ $t->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $t->tahun }}</span></td>
                        <td class="text-center">{{ $t->avg_kerja }}</td>
                        <td class="text-center">{{ $t->avg_sikap }}</td>
                        <td class="text-center">{{ $t->avg_target }}</td>
                        <td class="text-center"><strong class="text-primary">{{ $t->total }}</strong></td>
                        <td class="text-center">
                            @if($t->grade=='A')<span class="badge bg-success">A</span>
                            @elseif($t->grade=='B')<span class="badge bg-info">B</span>
                            @elseif($t->grade=='C')<span class="badge bg-warning text-dark">C</span>
                            @else<span class="badge bg-danger">{{ $t->grade }}</span>@endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $t->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.tahunan.update', $t->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Penilaian Tahunan</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK</label><input type="text" class="form-control" name="nik" value="{{ $t->nik }}"></div><div class="col-md-6"><label class="form-label">Nama</label><input type="text" class="form-control" name="nama" value="{{ $t->nama }}"></div></div>
                                <div class="mb-3"><label class="form-label">Tahun</label><input type="number" class="form-control" name="tahun" value="{{ $t->tahun }}"></div>
                                <div class="row mb-3"><div class="col-md-3"><label class="form-label">Avg Kerja</label><input type="number" class="form-control" name="avg_kerja" value="{{ $t->avg_kerja }}"></div><div class="col-md-3"><label class="form-label">Avg Sikap</label><input type="number" class="form-control" name="avg_sikap" value="{{ $t->avg_sikap }}"></div><div class="col-md-3"><label class="form-label">Avg Target</label><input type="number" class="form-control" name="avg_target" value="{{ $t->avg_target }}"></div><div class="col-md-3"><label class="form-label">Grade</label><select class="form-select" name="grade"><option value="A" {{ $t->grade=='A'?'selected':'' }}>A</option><option value="B" {{ $t->grade=='B'?'selected':'' }}>B</option><option value="C" {{ $t->grade=='C'?'selected':'' }}>C</option><option value="D" {{ $t->grade=='D'?'selected':'' }}>D</option></select></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $t->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('performance.tahunan.destroy', $t->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $t->nama }} - {{ $t->tahun }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-calendar-alt fa-3x mb-3 d-block"></i><p>Belum ada data penilaian tahunan</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('performance.tahunan.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Penilaian Tahunan</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="row mb-3"><div class="col-md-6"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" required></div><div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" required></div></div>
            <div class="mb-3"><label class="form-label">Tahun</label><input type="number" class="form-control" name="tahun" value="{{ date('Y') }}"></div>
            <div class="row mb-3"><div class="col-md-3"><label class="form-label">Avg Kerja</label><input type="number" class="form-control" name="avg_kerja"></div><div class="col-md-3"><label class="form-label">Avg Sikap</label><input type="number" class="form-control" name="avg_sikap"></div><div class="col-md-3"><label class="form-label">Avg Target</label><input type="number" class="form-control" name="avg_target"></div><div class="col-md-3"><label class="form-label">Grade</label><select class="form-select" name="grade"><option>A</option><option>B</option><option>C</option><option>D</option></select></div></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
