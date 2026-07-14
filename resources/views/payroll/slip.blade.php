@extends('layouts.app')
@section('title', 'Slip Gaji - HRIS V2')
@section('page-title', 'Slip Gaji Karyawan')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Slip Gaji Karyawan</h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;"><option>Maret 2024</option><option>Februari 2024</option><option>Januari 2024</option></select>
            <button class="btn btn-sm btn-primary"><i class="fas fa-print me-1"></i> Print</button>
        </div>
    </div>
    <div class="card-body">
        @forelse($slips as $s)
        <div class="card mb-4 border">
            <div class="card-header bg-light"><div class="d-flex justify-content-between align-items-center"><h6 class="mb-0"><strong>{{ $s->nama }}</strong> ({{ $s->nik }})</h6><span class="badge bg-primary">{{ $s->periode }}</span></div></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-success"><i class="fas fa-plus-circle me-1"></i> Pendapatan</h6>
                        <table class="table table-sm"><tbody>
                            <tr><td>Gaji Pokok</td><td class="text-end">Rp {{ number_format($s->gaji_pokok,0,',','.') }}</td></tr>
                            <tr><td>Tunjangan</td><td class="text-end">Rp {{ number_format($s->tunjangan,0,',','.') }}</td></tr>
                            <tr><td>Bonus</td><td class="text-end">Rp {{ number_format($s->bonus,0,',','.') }}</td></tr>
                            <tr class="table-success fw-bold"><td>Total Pendapatan</td><td class="text-end">Rp {{ number_format($s->gaji_pokok+$s->tunjangan+$s->bonus,0,',','.') }}</td></tr>
                        </tbody></table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-danger"><i class="fas fa-minus-circle me-1"></i> Potongan</h6>
                        <table class="table table-sm"><tbody>
                            <tr><td>Potongan</td><td class="text-end">Rp {{ number_format($s->potongan,0,',','.') }}</td></tr>
                            <tr><td>BPJS</td><td class="text-end">Rp {{ number_format($s->bpjs,0,',','.') }}</td></tr>
                            <tr><td>Pajak</td><td class="text-end">Rp {{ number_format($s->pajak,0,',','.') }}</td></tr>
                            <tr class="table-danger fw-bold"><td>Total Potongan</td><td class="text-end">Rp {{ number_format($s->potongan+$s->bpjs+$s->pajak,0,',','.') }}</td></tr>
                        </tbody></table>
                    </div>
                </div>
                <hr>
                <div class="text-end"><h5>GAJI BERSIH: <span class="text-primary">Rp {{ number_format($s->total,0,',','.') }}</span></h5></div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted"><i class="fas fa-receipt fa-3x mb-3 d-block"></i><p>Belum ada slip gaji</p></div>
        @endforelse
    </div>
</div>
@endsection
