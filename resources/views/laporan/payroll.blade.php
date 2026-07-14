@extends('layouts.app')
@section('title', 'Laporan Payroll - HRIS V2')
@section('page-title', 'Laporan Payroll Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Laporan Payroll Karyawan</h5>
        <button class="btn btn-sm btn-outline-success"><i class="fas fa-download me-1"></i> Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Divisi</th><th class="text-end">Gaji Pokok</th><th class="text-end">Tunjangan</th><th class="text-end">Bonus</th><th class="text-end">Potongan</th><th class="text-end">BPJS</th><th class="text-end">Pajak</th><th class="text-end">Total</th></tr></thead>
                <tbody>
                    @forelse($payrolls as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $p->nik }}</code></td>
                        <td><strong>{{ $p->nama }}</strong></td>
                        <td>{{ $p->divisi }}</td>
                        <td class="text-end">Rp {{ number_format($p->gaji_pokok,0,',','.') }}</td>
                        <td class="text-end">Rp {{ number_format($p->tunjangan,0,',','.') }}</td>
                        <td class="text-end"><span class="text-success">+Rp {{ number_format($p->bonus,0,',','.') }}</span></td>
                        <td class="text-end"><span class="text-danger">-Rp {{ number_format($p->potongan,0,',','.') }}</span></td>
                        <td class="text-end"><span class="text-danger">-Rp {{ number_format($p->bpjs,0,',','.') }}</span></td>
                        <td class="text-end"><span class="text-danger">-Rp {{ number_format($p->pajak,0,',','.') }}</span></td>
                        <td class="text-end"><strong>Rp {{ number_format($p->total,0,',','.') }}</strong></td>
                    </tr>
                    @empty
                    <tr><td colspan="11" class="text-center py-5 text-muted"><i class="fas fa-money-bill-wave fa-3x mb-3 d-block"></i><p>Belum ada data payroll</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
