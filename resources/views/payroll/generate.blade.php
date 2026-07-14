@extends('layouts.app')
@section('title', 'Generate Payroll - HRIS V2')
@section('page-title', 'Generate Payroll')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center"><h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Generate Payroll</h5></div>
            <div class="card-body p-4">
                <form action="{{ route('payroll.generate.store') }}" method="POST">@csrf
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Periode Bulan <span class="text-danger">*</span></label>
                            <select class="form-select" name="bulan" required>
                                <option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option>
                                <option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option>
                                <option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option>
                                <option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Periode Tahun <span class="text-danger">*</span></label>
                            <select class="form-select" name="tahun" required>
                                <option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>Generate payroll akan menghitung gaji karyawan berdasarkan data kehadiran, tunjangan, bonus, dan potongan yang sudah terdaftar.</div>
                    <div class="d-grid"><button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-play me-2"></i>Generate Payroll Sekarang</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
