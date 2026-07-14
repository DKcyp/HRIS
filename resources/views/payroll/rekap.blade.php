@extends('layouts.app')
@section('title', 'Rekap Payroll - HRIS V2')
@section('page-title', 'Rekap Payroll')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Rekap Payroll</h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;"><option>Semua Periode</option><option>Maret 2024</option><option>Februari 2024</option></select>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus me-1"></i> Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Periode</th><th class="text-center">Karyawan</th><th>Total Gaji Pokok</th><th>Total Tunjangan</th><th>Total Bonus</th><th>Total Potongan</th><th>Grand Total</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($rekaps as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $r->periode }}</strong></td>
                        <td class="text-center"><span class="badge bg-info">{{ $r->total_karyawan }} orang</span></td>
                        <td class="text-end">Rp {{ number_format($r->total_gaji_pokok,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($r->total_tunjangan,0,',','.') }}</td>
                        <td class="text-end text-success">+Rp {{ number_format($r->total_bonus,0,',','.') }}</td>
                        <td class="text-end text-danger">-Rp {{ number_format($r->total_potongan+$r->total_bpjs+$r->total_pajak,0,',','.') }}</td>
                        <td class="text-end fw-bold text-primary">Rp {{ number_format($r->grand_total,0,',','.') }}</td>
                        <td class="text-center">
                            @if($r->status=='selesai')<span class="badge bg-success">Selesai</span>
                            @elseif($r->status=='diproses')<span class="badge bg-warning text-dark">Diproses</span>
                            @else<span class="badge bg-secondary">Draft</span>@endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $r->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
                        <form action="{{ route('payroll.rekap.update', $r->id) }}" method="POST">@csrf @method('PUT')
                            <div class="modal-header bg-info text-white"><h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Rekap</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body">
                                <div class="row mb-3"><div class="col-md-6"><label class="form-label">Periode</label><input type="text" class="form-control" name="periode" value="{{ $r->periode }}"></div><div class="col-md-6"><label class="form-label">Status</label><select class="form-select" name="status"><option value="draft" {{ $r->status=='draft'?'selected':'' }}>Draft</option><option value="diproses" {{ $r->status=='diproses'?'selected':'' }}>Diproses</option><option value="selesai" {{ $r->status=='selesai'?'selected':'' }}>Selesai</option></select></div></div>
                                <div class="row mb-3"><div class="col-md-4"><label class="form-label">Total Gaji Pokok</label><input type="number" class="form-control" name="total_gaji_pokok" value="{{ $r->total_gaji_pokok }}"></div><div class="col-md-4"><label class="form-label">Total Tunjangan</label><input type="number" class="form-control" name="total_tunjangan" value="{{ $r->total_tunjangan }}"></div><div class="col-md-4"><label class="form-label">Total Bonus</label><input type="number" class="form-control" name="total_bonus" value="{{ $r->total_bonus }}"></div></div>
                            </div>
                            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button></div>
                        </form>
                    </div></div></div>
                    <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
                        <form action="{{ route('payroll.rekap.destroy', $r->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
                            <div class="modal-body text-center py-4"><i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i><p class="fs-5">Yakin ingin menghapus?</p><p class="text-muted"><strong>{{ $r->periode }}</strong></p></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button></div>
                        </form>
                    </div></div></div>
                    @empty
                    <tr><td colspan="10" class="text-center py-5 text-muted"><i class="fas fa-file-alt fa-3x mb-3 d-block"></i><p>Belum ada data rekap payroll</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('payroll.rekap.store') }}" method="POST">@csrf
        <div class="modal-header bg-primary text-white"><h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Rekap</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Periode <span class="text-danger">*</span></label><input type="text" class="form-control" name="periode" placeholder="Contoh: Maret 2024" required></div>
            <div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status"><option value="draft">Draft</option><option value="diproses">Diproses</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button></div>
    </form>
</div></div></div>
@endsection
