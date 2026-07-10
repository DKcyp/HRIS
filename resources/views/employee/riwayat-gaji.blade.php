@extends('layouts.app')

@section('title', 'Riwayat Gaji - HRIS V2')
@section('page-title', 'Riwayat Gaji')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-money-bill-wave me-2"></i>
            Riwayat Gaji Karyawan
        </h5>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;">
                <option>Januari 2024</option>
                <option>Februari 2024</option>
                <option>Maret 2024</option>
            </select>
            <input type="text" class="form-control form-control-sm" placeholder="Cari nama/NIK..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Periode</th>
                        <th class="text-end">Gaji Pokok</th>
                        <th class="text-end">Tunjangan</th>
                        <th class="text-end">Bonus</th>
                        <th class="text-end">Potongan</th>
                        <th class="text-end"><strong>Total</strong></th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gaji as $g)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $g->nik }}</code></td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->periode }}</td>
                        <td class="text-end">Rp {{ number_format($g->gaji_pokok,0,',','.') }}</td>
                        <td class="text-end text-success">+ Rp {{ number_format($g->tunjangan,0,',','.') }}</td>
                        <td class="text-end text-success">+ Rp {{ number_format($g->bonus,0,',','.') }}</td>
                        <td class="text-end text-danger">- Rp {{ number_format($g->potongan,0,',','.') }}</td>
                        <td class="text-end"><strong>Rp {{ number_format($g->total,0,',','.') }}</strong></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info" title="Lihat Slip Gaji">
                                <i class="fas fa-receipt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format($gaji->sum('gaji_pokok'),0,',','.') }}</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format($gaji->sum('tunjangan'),0,',','.') }}</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format($gaji->sum('bonus'),0,',','.') }}</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format($gaji->sum('potongan'),0,',','.') }}</strong></td>
                        <td class="text-end"><strong class="text-primary">Rp {{ number_format($gaji->sum('total'),0,',','.') }}</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
