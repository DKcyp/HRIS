@extends('layouts.app')
@section('title', 'User Management - HRIS V2')
@section('page-title', 'Data User Management')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i>Data User Management</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus me-1"></i> Tambah User
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Status</th>
                        <th>Last Login</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $u->username }}</code></td>
                            <td><strong>{{ $u->nama }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge bg-primary">{{ $u->role }}</span></td>
                            <td class="text-center">
                                @if($u->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Non-aktif</span>
                                @endif
                            </td>
                            <td>{{ $u->last_login }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $u->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $u->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('users.update', $u->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit User</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username" value="{{ $u->username }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $u->nama }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{ $u->email }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Role</label>
                                                    <select class="form-select" name="role">
                                                        @foreach($roles as $r)
                                                            <option value="{{ $r->nama }}" {{ $u->role == $r->nama ? 'selected' : '' }}>{{ $r->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select" name="status">
                                                        <option value="aktif" {{ $u->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="non-aktif" {{ $u->status == 'non-aktif' ? 'selected' : '' }}>Non-aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteModal{{ $u->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus User</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                            <p class="fs-5">Yakin ingin menghapus user ini?</p>
                                            <p class="text-muted"><strong>{{ $u->nama }}</strong> ({{ $u->username }})</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-users-cog fa-3x mb-3 d-block"></i>
                                <p>Belum ada data user</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Tambah User Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
