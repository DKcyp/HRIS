@extends('layouts.app')
@section('title', 'Role & Permission - HRIS V2')
@section('page-title', 'Data Role & Permission')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Data Role & Permission</h5>
        <a href="{{ route('roles.permissions') }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-key me-1"></i> Kelola Permission</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Nama Role</th><th>Deskripsi</th><th class="text-center">Jumlah User</th><th>Permission</th></tr></thead>
                <tbody>
                    @forelse($roles as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $r->nama }}</strong></td>
                        <td>{{ $r->deskripsi }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $r->jumlah_user }}</span></td>
                        <td><small class="text-muted">{{ $r->permissions }}</small></td>
                    </tr>
                    @empty<tr><td colspan="5" class="text-center py-5 text-muted"><i class="fas fa-user-shield fa-3x mb-3 d-block"></i><p>Belum ada data role</p></td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
