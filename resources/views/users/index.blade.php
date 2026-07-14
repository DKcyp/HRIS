@extends('layouts.app')
@section('title', 'User Management - HRIS V2')
@section('page-title', 'Data User Management')

@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i>Data User Management</h5>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Tambah User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Username</th><th>Nama</th><th>Email</th><th>Role</th><th class="text-center">Status</th><th>Last Login</th></tr></thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $u->username }}</code></td>
                        <td><strong>{{ $u->nama }}</strong></td>
                        <td>{{ $u->email }}</td>
                        <td><span class="badge bg-primary">{{ $u->role }}</span></td>
                        <td class="text-center">@if($u->status=='aktif')<span class="badge bg-success">Aktif</span>@else<span class="badge bg-danger">Non-aktif</span>@endif</td>
                        <td>{{ $u->last_login }}</td>
                    </tr>
                    @empty<tr><td colspan="7" class="text-center py-5 text-muted"><i class="fas fa-users-cog fa-3x mb-3 d-block"></i><p>Belum ada data user</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
