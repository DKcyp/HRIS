@extends('layouts.app')

@section('title', 'Riwayat Jabatan - HRIS V2')
@section('page-title', 'Riwayat Jabatan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-history me-2"></i>
            Riwayat Jabatan Karyawan
        </h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm" placeholder="Cari nama/NIK..." style="width:220px;">
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
                        <th>Jabatan Lama</th>
                        <th class="text-center"><i class="fas fa-arrow-right"></i></th>
                        <th>Jabatan Baru</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $r->nik }}</code></td>
                        <td>{{ $r->nama }}</td>
                        <td><span class="badge bg-secondary">{{ $r->jabatan_lama }}</span></td>
                        <td class="text-center"><i class="fas fa-arrow-right text-primary"></i></td>
                        <td><span class="badge bg-success">{{ $r->jabatan_baru }}</span></td>
                        <td>{{ $r->tanggal }}</td>
                        <td>
                            @if($r->keterangan == 'Promosi')
                                <span class="badge bg-success">{{ $r->keterangan }}</span>
                            @elseif($r->keterangan == 'Mutasi')
                                <span class="badge bg-info">{{ $r->keterangan }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $r->keterangan }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-history fa-3x mb-3 d-block"></i>
                            <p>Belum ada riwayat jabatan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
