@extends('layouts.app')
@section('title', 'Permissions - HRIS V2')
@section('page-title', 'Kelola Permission')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-key me-2"></i>Kelola Permission</h5>
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light"><tr><th>No</th><th>Module</th><th class="text-center">Read</th><th class="text-center">Create</th><th class="text-center">Update</th><th class="text-center">Delete</th></tr></thead>
                <tbody>
                    @forelse($permissions as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $p->module }}</strong></td>
                        <td class="text-center">@if($p->read)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->create)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->update)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->delete)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-key fa-3x mb-3 d-block"></i><p>Belum ada data permission</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
