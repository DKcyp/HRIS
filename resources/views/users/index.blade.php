@extends('layouts.app')
@section('title', 'User Management - HRIS V2')
@section('page-title', 'Data User Management')

@section('content')
<div id="alert-container"></div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i>Data User Management</h5>
        <button class="btn btn-sm btn-primary" onclick="openAddModal()">
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
                <tbody id="user-table-body">
                    @forelse($users as $u)
                        <tr id="row-{{ $u->id }}">
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
                                <button class="btn btn-sm btn-outline-info me-1" onclick="openEditModal({{ $u->id }}, '{{ $u->username }}', '{{ $u->nama }}', '{{ $u->email }}', '{{ $u->role }}', '{{ $u->status }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="openDeleteModal({{ $u->id }}, '{{ $u->nama }}', '{{ $u->username }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addForm">
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
                                <option value="Super Admin">Super Admin</option>
                                <option value="HRD Manager">HRD Manager</option>
                                <option value="Payroll Staff">Payroll Staff</option>
                                <option value="Finance Manager">Finance Manager</option>
                                <option value="IT Admin">IT Admin</option>
                                <option value="Employee" selected>Employee</option>
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
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit-username" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit-nama" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                            <input type="password" class="form-control" id="edit-password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select" id="edit-role" required>
                                <option value="Super Admin">Super Admin</option>
                                <option value="HRD Manager">HRD Manager</option>
                                <option value="Payroll Staff">Payroll Staff</option>
                                <option value="Finance Manager">Finance Manager</option>
                                <option value="IT Admin">IT Admin</option>
                                <option value="Employee">Employee</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="edit-status" required>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-aktif</option>
                            </select>
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
                    <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                    <p class="fs-5">Yakin ingin menghapus user ini?</p>
                    <p class="text-muted"><strong id="delete-nama"></strong> (<span id="delete-username"></span>)</p>
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

<script>
(function(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function showAlert(type, message) {
        const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
        const html = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="fas fa-${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        document.getElementById('alert-container').innerHTML = html;
        setTimeout(() => {
            document.getElementById('alert-container').innerHTML = '';
        }, 3000);
    }

    function clearErrors(prefix) {
        document.getElementById(prefix + '-errors').innerHTML = '';
    }

    function showErrors(prefix, errors) {
        let html = '<div class="alert alert-danger"><ul class="mb-0">';
        for (const key in errors) {
            errors[key].forEach(msg => {
                html += '<li>' + msg + '</li>';
            });
        }
        html += '</ul></div>';
        document.getElementById(prefix + '-errors').innerHTML = html;
    }

    function reloadTable() {
        fetch('{{ route("users.index") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newBody = doc.getElementById('user-table-body');
            if (newBody) {
                document.getElementById('user-table-body').innerHTML = newBody.innerHTML;
            }
        });
    }

    window.openAddModal = function() {
        document.getElementById('addForm').reset();
        clearErrors('add');
        new bootstrap.Modal(document.getElementById('addModal')).show();
    };

    window.openEditModal = function(id, username, nama, email, role, status) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-username').value = username;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-role').value = role;
        document.getElementById('edit-status').value = status;
        document.getElementById('edit-password').value = '';
        clearErrors('edit');
        new bootstrap.Modal(document.getElementById('editModal')).show();
    };

    window.openDeleteModal = function(id, nama, username) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-nama').textContent = nama;
        document.getElementById('delete-username').textContent = username;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    };

    // Add User
    var addForm = document.getElementById('addForm');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            fetch('{{ route("users.store") }}', {
                method: 'POST',
                body: data,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(json => {
                if (json.success) {
                    bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                    showAlert('success', json.message);
                    reloadTable();
                } else if (json.errors) {
                    showErrors('add', json.errors);
                } else {
                    showAlert('danger', json.message);
                }
            })
            .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
        });
    }

    // Edit User
    var editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var id = document.getElementById('edit-id').value;
            var data = new FormData();
            data.append('_method', 'PUT');
            data.append('username', document.getElementById('edit-username').value);
            data.append('nama', document.getElementById('edit-nama').value);
            data.append('email', document.getElementById('edit-email').value);
            data.append('role', document.getElementById('edit-role').value);
            data.append('status', document.getElementById('edit-status').value);
            var password = document.getElementById('edit-password').value;
            if (password) data.append('password', password);
            fetch('/users/' + id, {
                method: 'POST',
                body: data,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(json => {
                if (json.success) {
                    bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                    showAlert('success', json.message);
                    reloadTable();
                } else if (json.errors) {
                    showErrors('edit', json.errors);
                } else {
                    showAlert('danger', json.message);
                }
            })
            .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
        });
    }

    // Delete User
    var deleteForm = document.getElementById('deleteForm');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var id = document.getElementById('delete-id').value;
            var data = new FormData();
            data.append('_method', 'DELETE');
            fetch('/users/' + id, {
                method: 'POST',
                body: data,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(json => {
                if (json.success) {
                    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                    showAlert('success', json.message);
                    reloadTable();
                } else {
                    showAlert('danger', json.message);
                }
            })
            .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
        });
    }
})();
</script>
@endsection
