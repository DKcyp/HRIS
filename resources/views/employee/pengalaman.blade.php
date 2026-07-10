@extends('layouts.app')

@section('title', 'Pengalaman Kerja - HRIS V2')
@section('page-title', 'Pengalaman Kerja')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-briefcase me-2"></i>
            Pengalaman Kerja Karyawan
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
                        <th>Perusahaan</th>
                        <th>Posisi</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Durasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengalaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $p->nik }}</code></td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->perusahaan }}</td>
                        <td>{{ $p->posisi }}</td>
                        <td>{{ $p->mulai }}</td>
                        <td>{{ $p->selesai }}</td>
                        <td><span class="badge bg-light text-dark">{{ $p->durasi }}</span></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
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
