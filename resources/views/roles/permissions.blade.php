@extends('layouts.app')
@section('title', 'Permissions - HRIS V2')
@section('page-title', 'Kelola Permission')

@section('content')
<div id="alert-container"></div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-key me-2"></i>Kelola Permission</h5>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-secondary me-1" onclick="navigateTo(event, '{{ route('roles.index') }}')"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            <button class="btn btn-sm btn-primary" onclick="openAddModal()"><i class="fas fa-plus me-1"></i> Tambah Permission</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Module</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Create</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="permission-table-body">
                    @forelse($permissions as $p)
                    <tr id="row-{{ $p->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $p->module }}</strong></td>
                        <td class="text-center">@if($p->read)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->create)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->update)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">@if($p->delete)<i class="fas fa-check-circle text-success"></i>@else<i class="fas fa-times-circle text-danger"></i>@endif</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" onclick="openEditModal({{ $p->id }}, '{{ addslashes($p->module) }}', {{ $p->read ? 'true' : 'false' }}, {{ $p->create ? 'true' : 'false' }}, {{ $p->update ? 'true' : 'false' }}, {{ $p->delete ? 'true' : 'false' }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="openDeleteModal({{ $p->id }}, '{{ addslashes($p->module) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr id="empty-row">
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-key fa-3x mb-3 d-block"></i>
                            <p>Belum ada data permission</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addForm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Permission Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Module <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="module" required placeholder="Contoh: Dashboard">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="read" value="1" id="add-read" checked>
                                <label class="form-check-label" for="add-read">Read</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="create" value="1" id="add-create" checked>
                                <label class="form-check-label" for="add-create">Create</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="update" value="1" id="add-update" checked>
                                <label class="form-check-label" for="add-update">Update</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="delete" value="1" id="add-delete" checked>
                                <label class="form-check-label" for="add-delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div id="add-errors"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Permission</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label">Module</label>
                        <input type="text" class="form-control" id="edit-module" required>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-read" value="1">
                                <label class="form-check-label" for="edit-read">Read</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-create" value="1">
                                <label class="form-check-label" for="edit-create">Create</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-update" value="1">
                                <label class="form-check-label" for="edit-update">Update</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit-delete" value="1">
                                <label class="form-check-label" for="edit-delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div id="edit-errors"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Permission</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                    <p class="fs-5">Yakin ingin menghapus permission ini?</p>
                    <p class="text-muted"><strong id="delete-module"></strong></p>
                    <input type="hidden" id="delete-id">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-3"><i class="fas fa-trash me-1"></i>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
(function(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const routeIndex = '{{ route("roles.permissions") }}';
    const routeStore = '{{ route("roles.permissions.store") }}';

    function showAlert(type, message) {
        const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
        document.getElementById('alert-container').innerHTML = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert"><i class="fas fa-' + icon + ' me-2"></i>' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
        setTimeout(() => { document.getElementById('alert-container').innerHTML = ''; }, 3000);
    }

    function clearErrors(prefix) { document.getElementById(prefix + '-errors').innerHTML = ''; }

    function showErrors(prefix, errors) {
        let html = '<div class="alert alert-danger"><ul class="mb-0">';
        for (const key in errors) { errors[key].forEach(msg => { html += '<li>' + msg + '</li>'; }); }
        html += '</ul></div>';
        document.getElementById(prefix + '-errors').innerHTML = html;
    }

    function reloadTable() {
        fetch(routeIndex, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newBody = doc.getElementById('permission-table-body');
            if (newBody) document.getElementById('permission-table-body').innerHTML = newBody.innerHTML;
        });
    }

    window.openAddModal = function() {
        document.getElementById('addForm').reset();
        document.getElementById('add-read').checked = true;
        document.getElementById('add-create').checked = true;
        document.getElementById('add-update').checked = true;
        document.getElementById('add-delete').checked = true;
        clearErrors('add');
        new bootstrap.Modal(document.getElementById('addModal')).show();
    };

    window.openEditModal = function(id, module, read, create, update, del) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-module').value = module;
        document.getElementById('edit-read').checked = read;
        document.getElementById('edit-create').checked = create;
        document.getElementById('edit-update').checked = update;
        document.getElementById('edit-delete').checked = del;
        clearErrors('edit');
        new bootstrap.Modal(document.getElementById('editModal')).show();
    };

    window.openDeleteModal = function(id, module) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-module').textContent = module;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    };

    document.getElementById('addForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var data = new FormData();
        data.append('module', document.querySelector('#addForm input[name="module"]').value);
        data.append('read', document.getElementById('add-read').checked ? '1' : '0');
        data.append('create', document.getElementById('add-create').checked ? '1' : '0');
        data.append('update', document.getElementById('add-update').checked ? '1' : '0');
        data.append('delete', document.getElementById('add-delete').checked ? '1' : '0');
        fetch(routeStore, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(json => {
            if (json.success) { bootstrap.Modal.getInstance(document.getElementById('addModal')).hide(); showAlert('success', json.message); reloadTable(); }
            else if (json.errors) { showErrors('add', json.errors); }
            else { showAlert('danger', json.message); }
        })
        .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
    });

    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var id = document.getElementById('edit-id').value;
        var data = new FormData();
        data.append('_method', 'PUT');
        data.append('module', document.getElementById('edit-module').value);
        data.append('read', document.getElementById('edit-read').checked ? '1' : '0');
        data.append('create', document.getElementById('edit-create').checked ? '1' : '0');
        data.append('update', document.getElementById('edit-update').checked ? '1' : '0');
        data.append('delete', document.getElementById('edit-delete').checked ? '1' : '0');
        fetch('/roles/permissions/' + id, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(json => {
            if (json.success) { bootstrap.Modal.getInstance(document.getElementById('editModal')).hide(); showAlert('success', json.message); reloadTable(); }
            else if (json.errors) { showErrors('edit', json.errors); }
            else { showAlert('danger', json.message); }
        })
        .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
    });

    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var id = document.getElementById('delete-id').value;
        var data = new FormData();
        data.append('_method', 'DELETE');
        fetch('/roles/permissions/' + id, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(json => {
            if (json.success) { bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide(); showAlert('success', json.message); reloadTable(); }
            else { showAlert('danger', json.message); }
        })
        .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
    });
})();
</script>
