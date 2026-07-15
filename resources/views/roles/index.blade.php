@extends('layouts.app')
@section('title', 'Role & Permission - HRIS V2')
@section('page-title', 'Data Role & Permission')

@section('content')
<div id="alert-container"></div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Data Role & Permission</h5>
        <div>
            <a href="{{ route('roles.permissions') }}" class="btn btn-sm btn-outline-primary me-1" onclick="navigateTo(event, '{{ route('roles.permissions') }}')"><i class="fas fa-key me-1"></i> Kelola Permission</a>
            <button class="btn btn-sm btn-primary" onclick="openAddModal()"><i class="fas fa-plus me-1"></i> Tambah Role</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Role</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah User</th>
                        <th class="text-center">Jumlah Permission</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="role-table-body">
                    @forelse($roles as $r)
                    <tr id="row-{{ $r->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $r->nama }}</strong></td>
                        <td>{{ $r->deskripsi ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $r->user_auths_count }}</span></td>
                        <td class="text-center"><span class="badge bg-info">{{ $r->permissions_count }}</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-info me-1" onclick="openEditModal({{ $r->id }}, '{{ addslashes($r->nama) }}', '{{ addslashes($r->deskripsi ?? '') }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="openDeleteModal({{ $r->id }}, '{{ addslashes($r->nama) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr id="empty-row">
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-user-shield fa-3x mb-3 d-block"></i>
                            <p>Belum ada data role</p>
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
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Tambah Role Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
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
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Role</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="edit-nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit-deskripsi" rows="3"></textarea>
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
                    <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Role</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                    <p class="fs-5">Yakin ingin menghapus role ini?</p>
                    <p class="text-muted"><strong id="delete-nama"></strong></p>
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
    const routeIndex = '{{ route("roles.index") }}';
    const routeStore = '{{ route("roles.store") }}';

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
            const newBody = doc.getElementById('role-table-body');
            if (newBody) document.getElementById('role-table-body').innerHTML = newBody.innerHTML;
        });
    }

    window.openAddModal = function() {
        document.getElementById('addForm').reset();
        clearErrors('add');
        new bootstrap.Modal(document.getElementById('addModal')).show();
    };

    window.openEditModal = function(id, nama, deskripsi) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-deskripsi').value = deskripsi;
        clearErrors('edit');
        new bootstrap.Modal(document.getElementById('editModal')).show();
    };

    window.openDeleteModal = function(id, nama) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-nama').textContent = nama;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    };

    document.getElementById('addForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
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
        data.append('nama', document.getElementById('edit-nama').value);
        data.append('deskripsi', document.getElementById('edit-deskripsi').value);
        fetch('/roles/' + id, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' } })
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
        fetch('/roles/' + id, { method: 'POST', body: data, headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(json => {
            if (json.success) { bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide(); showAlert('success', json.message); reloadTable(); }
            else { showAlert('danger', json.message); }
        })
        .catch(() => showAlert('danger', 'Terjadi kesalahan jaringan'));
    });
})();
</script>
