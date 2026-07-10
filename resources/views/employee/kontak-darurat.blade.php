@extends('layouts.app')

@section('title', 'Kontak Darurat - HRIS V2')
@section('page-title', 'Kontak Darurat')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-phone-alt me-2"></i>
            Kontak Darurat Karyawan
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
                        <th>Nama Karyawan</th>
                        <th>Nama Kontak</th>
                        <th>Hubungan</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kontak as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $k->nik }}</code></td>
                        <td>{{ $k->nama }}</td>
                        <td><strong>{{ $k->kontak_nama }}</strong></td>
                        <td>
                            @if($k->hubungan == 'Istri' || $k->hubungan == 'Suami')
                                <span class="badge bg-pink" style="background:#e83e8c;">{{ $k->hubungan }}</span>
                            @elseif($k->hubungan == 'Ibu' || $k->hubungan == 'Ayah')
                                <span class="badge bg-purple" style="background:#6f42c1;">{{ $k->hubungan }}</span>
                            @else
                                <span class="badge bg-info">{{ $k->hubungan }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="tel:{{ $k->telepon }}" class="text-decoration-none">
                                <i class="fas fa-phone text-success me-1"></i> {{ $k->telepon }}
                            </a>
                        </td>
                        <td>{{ $k->alamat }}</td>
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
