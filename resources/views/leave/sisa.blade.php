@extends('layouts.app')

@section('title', 'Sisa Cuti - HRIS V2')
@section('page-title', 'Sisa Cuti Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Data Sisa Cuti Karyawan</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari karyawan..." style="width:200px;">
            <button class="btn btn-sm btn-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>NIK</th><th>Nama</th><th>Jenis Cuti</th><th class="text-center">Total</th><th class="text-center">Terpakai</th><th class="text-center">Sisa</th><th class="text-center">Persentase</th></tr></thead>
                <tbody>
                    @forelse($sisa as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->nik }}</code></td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td><span class="badge bg-info">{{ $s->jenis }}</span></td>
                        <td class="text-center">{{ $s->total }}</td>
                        <td class="text-center"><span class="badge bg-warning text-dark">{{ $s->terpakai }}</span></td>
                        <td class="text-center"><span class="badge bg-success">{{ $s->sisa }}</span></td>
                        <td class="text-center">
                            @php $persen = ($s->total > 0) ? ($s->sisa / $s->total) * 100 : 0; @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar @if($persen > 50) bg-success @elseif($persen > 25) bg-warning @else bg-danger @endif" style="width: {{ $persen }}%">{{ round($persen) }}%</div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="fas fa-chart-pie fa-3x mb-3 d-block"></i><p>Belum ada data sisa cuti</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
