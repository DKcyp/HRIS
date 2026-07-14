@extends('layouts.app')

@section('title', 'Interview - HRIS V2')
@section('page-title', 'Manajemen Interview')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-comments me-2"></i>
            Data Interview
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari interview..." style="width:220px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Interviewer</th>
                        <th class="text-center">Nilai</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interviews as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $i->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $i->posisi }}</span></td>
                        <td>{{ $i->tanggal }}</td>
                        <td>{{ $i->jam }}</td>
                        <td>{{ $i->ruangan }}</td>
                        <td>{{ $i->interviewer }}</td>
                        <td class="text-center">
                            @if($i->nilai)
                                <span class="badge bg-primary">{{ $i->nilai }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($i->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($i->status == 'terjadwal')
                                <span class="badge bg-warning text-dark">Terjadwal</span>
                            @else
                                <span class="badge bg-secondary">Dijadwalkan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $i->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $i->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $i->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.interview.update', $i->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Interview</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama" value="{{ $i->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Posisi</label>
                                            <input type="text" class="form-control" name="posisi" value="{{ $i->posisi }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="{{ $i->tanggal }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jam</label>
                                                <input type="time" class="form-control" name="jam" value="{{ $i->jam }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ruangan</label>
                                            <input type="text" class="form-control" name="ruangan" value="{{ $i->ruangan }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Interviewer</label>
                                            <input type="text" class="form-control" name="interviewer" value="{{ $i->interviewer }}">
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nilai</label>
                                                <input type="number" class="form-control" name="nilai" value="{{ $i->nilai }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="dijadwalkan" {{ $i->status == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                                    <option value="terjadwal" {{ $i->status == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                                                    <option value="selesai" {{ $i->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $i->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('recruitment.interview.destroy', $i->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Interview</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                        <p class="fs-5">Yakin ingin menghapus interview ini?</p>
                                        <p class="text-muted"><strong>{{ $i->nama }} - {{ $i->tanggal }}</strong></p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i> Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="fas fa-comments fa-3x mb-3 d-block"></i>
                            <p>Belum ada data interview</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('recruitment.interview.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Interview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jam</label>
                            <input type="time" class="form-control" name="jam">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruangan</label>
                        <input type="text" class="form-control" name="ruangan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Interviewer</label>
                        <input type="text" class="form-control" name="interviewer">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="terjadwal">Terjadwal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
