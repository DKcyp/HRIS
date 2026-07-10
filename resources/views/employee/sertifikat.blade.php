@extends('layouts.app')

@section('title', 'Sertifikat - HRIS V2')
@section('page-title', 'Sertifikat Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-certificate me-2"></i>
            Sertifikat Karyawan
        </h5>
        <button class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Sertifikat</th>
                        <th>Lembaga</th>
                        <th>Tanggal</th>
                        <th>Expired</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sertifikat as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $s->nik }}</code></td>
                        <td>{{ $s->nama }}</td>
                        <td><strong>{{ $s->sertifikat }}</strong></td>
                        <td>{{ $s->lembaga }}</td>
                        <td>{{ $s->tanggal }}</td>
                        <td>{{ $s->expired }}</td>
                        <td>
                            @if(now()->format('Y-m-d') > $s->expired)
                                <span class="badge bg-danger">Expired</span>
                            @elseif(now()->diffInMonths(now()->copy()->parse($s->expired)) <= 3)
                                <span class="badge bg-warning text-dark">Hampir Habis</span>
                            @else
                                <span class="badge bg-success">Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-info" title="Lihat"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></button>
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
