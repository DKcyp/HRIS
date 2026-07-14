@extends('layouts.app')
@section('title', 'Tambah User - HRIS V2')
@section('page-title', 'Tambah User Baru')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Tambah User Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <select class="form-select" name="role" required>
                        @foreach($roles as $r)
                        <option value="{{ $r->nama }}">{{ $r->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="aktif">Aktif</option>
                        <option value="non-aktif">Non-aktif</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
