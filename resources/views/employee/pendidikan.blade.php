@extends('layouts.app')

@section('title', 'Pendidikan - HRIS V2')
@section('page-title', 'Riwayat Pendidikan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-graduation-cap me-2"></i>
            Riwayat Pendidikan Karyawan
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
                        <th>Jenjang</th>
                        <th>Institusi</th>
                        <th>Jurusan</th>
                        <th class="text-center">Tahun Lulus</th>
                        <th class="text-center">IPK</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendidikan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $p->nik }}</code></td>
                        <td>{{ $p->nama }}</td>
                        <td>
                            @if($p->jenjang == 'S2')
                                <span class="badge bg-purple" style="background:#6f42c1;">{{ $p->jenjang }}</span>
                            @elseif($p->jenjang == 'S1')
                                <span class="badge bg-primary">{{ $p->jenjang }}</span>
                            @else
                                <span class="badge bg-info">{{ $p->jenjang }}</span>
                            @endif
                        </td>
                        <td>{{ $p->institusi }}</td>
                        <td>{{ $p->jurusan }}</td>
                        <td class="text-center">{{ $p->tahun_lulus }}</td>
                        <td class="text-center">
                            @if($p->ipk >= 3.8)
                                <span class="badge bg-success">{{ $p->ipk }}</span>
                            @elseif($p->ipk >= 3.5)
                                <span class="badge bg-primary">{{ $p->ipk }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $p->ipk }}</span>
                            @endif
                        </td>
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
