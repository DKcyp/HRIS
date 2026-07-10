@extends('layouts.app')

@section('title', 'Dokumen Karyawan - HRIS V2')
@section('page-title', 'Dokumen Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-id-card me-2"></i>
            Dokumen Karyawan (KTP, KK, NPWP, BPJS)
        </h5>
        <button class="btn btn-primary btn-sm">
            <i class="fas fa-upload me-1"></i> Upload Dokumen
        </button>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" class="form-control form-control-sm" placeholder="Cari nama/NIK...">
            </div>
            <div class="col-md-2">
                <select class="form-select form-select-sm">
                    <option value="">Semua Jenis</option>
                    <option>KTP</option>
                    <option>KK</option>
                    <option>NPWP</option>
                    <option>BPJS</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option>Verified</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Dokumen</th>
                        <th>File</th>
                        <th>Tanggal Upload</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumen as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $d->nik }}</code></td>
                        <td>{{ $d->nama }}</td>
                        <td>
                            @if($d->jenis == 'KTP')
                                <span class="badge bg-primary"><i class="fas fa-id-card me-1"></i>KTP</span>
                            @elseif($d->jenis == 'KK')
                                <span class="badge bg-info"><i class="fas fa-users me-1"></i>KK</span>
                            @elseif($d->jenis == 'NPWP')
                                <span class="badge bg-success"><i class="fas fa-file-invoice me-1"></i>NPWP</span>
                            @else
                                <span class="badge bg-warning text-dark"><i class="fas fa-heartbeat me-1"></i>BPJS</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-file-pdf text-danger me-1"></i> {{ $d->file }}
                            </a>
                        </td>
                        <td>{{ $d->tanggal_upload }}</td>
                        <td>
                            @if($d->status == 'verified')
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Verified</span>
                            @else
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Pending</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-info" title="Download"><i class="fas fa-download"></i></button>
                                <button class="btn btn-outline-success" title="Verifikasi"><i class="fas fa-check"></i></button>
                                <button class="btn btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
