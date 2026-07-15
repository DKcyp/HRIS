@extends('layouts.app')

@section('title', 'Data Karyawan - HRIS V2')
@section('page-title', 'Data Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-users me-2"></i>
            Daftar Karyawan
        </h5>
        <button class="btn btn-primary" onclick="navigateTo(event, '{{ route('employee.create') }}')">
            <i class="fas fa-plus me-1"></i> Tambah Karyawan
        </button>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari nama/NIK..." oninput="filterTable()">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filterDivisi" onchange="filterTable()">
                    <option value="">Semua Divisi</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>
                    <option>Marketing</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filterStatus" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="kontrak">Kontrak</option>
                    <option value="resign">Resign</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100" onclick="filterTable()"><i class="fas fa-search me-1"></i> Cari</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="employeeTable">
                <thead class="table-light">
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody id="employeeTableBody">
                    @forelse($employees as $emp)
                    <tr data-nik="{{ $emp->nik }}" data-nama="{{ $emp->nama }}" data-divisi="{{ $emp->divisi }}" data-status="{{ $emp->status }}">
                        <td><code>{{ $emp->nik }}</code></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div style="width:35px;height:35px;border-radius:50%;background:#4e73df;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:0.85rem;margin-right:10px;">
                                    {{ strtoupper(substr($emp->nama,0,1)) }}
                                </div>
                                {{ $emp->nama }}
                            </div>
                        </td>
                        <td>{{ $emp->divisi }}</td>
                        <td>{{ $emp->jabatan }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->telepon }}</td>
                        <td>
                            @if($emp->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($emp->status == 'kontrak')
                                <span class="badge bg-warning text-dark">Kontrak</span>
                            @else
                                <span class="badge bg-danger">Resign</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-info" title="Detail" onclick="showDetail({{ $emp->id }})"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-outline-warning" title="Edit" onclick="showEdit({{ $emp->id }})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-danger" title="Hapus" onclick="confirmDelete({{ $emp->id }},'{{ addslashes($emp->nama) }}')"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            <p>Belum ada data karyawan</p>
                            <button class="btn btn-primary mt-2" onclick="navigateTo(event, '{{ route('employee.create') }}')">
                                <i class="fas fa-plus me-1"></i> Tambah Karyawan Pertama
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted" id="tableInfo">Menampilkan {{ count($employees) }} dari {{ count($employees) }} data</div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-user me-2"></i>Detail Karyawan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <div id="detailAvatar" style="width:100px;height:100px;border-radius:50%;background:#4e73df;color:#fff;display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:700;margin:0 auto 10px;"></div>
                        <h5 id="detailNama" class="mb-1"></h5>
                        <code id="detailNik"></code>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless mb-0">
                            <tr><td class="text-muted" width="140">Divisi</td><td>: <strong id="detailDivisi"></strong></td></tr>
                            <tr><td class="text-muted">Jabatan</td><td>: <strong id="detailJabatan"></strong></td></tr>
                            <tr><td class="text-muted">Email</td><td>: <span id="detailEmail"></span></td></tr>
                            <tr><td class="text-muted">Telepon</td><td>: <span id="detailTelepon"></span></td></tr>
                            <tr><td class="text-muted">Status</td><td>: <span id="detailStatus"></span></td></tr>
                            <tr><td class="text-muted">Tanggal Masuk</td><td>: <span id="detailMasuk"></span></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editFormBody"></div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div style="width:60px;height:60px;border-radius:50%;background:#f8d7da;color:#dc3545;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin:0 auto 15px;">
                    <i class="fas fa-trash"></i>
                </div>
                <h6>Hapus Karyawan?</h6>
                <p class="text-muted mb-0">Anda yakin ingin menghapus <strong id="deleteNama"></strong>?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-sm" id="btnDeleteConfirm"><i class="fas fa-trash me-1"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteId = null;

    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const divisi = document.getElementById('filterDivisi').value;
        const status = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('#employeeTableBody tr[data-nik]');
        let visible = 0;
        rows.forEach(row => {
            const nama = row.dataset.nama.toLowerCase();
            const nik = row.dataset.nik.toLowerCase();
            const d = row.dataset.divisi;
            const s = row.dataset.status;
            const matchSearch = !search || nama.includes(search) || nik.includes(search);
            const matchDivisi = !divisi || d === divisi;
            const matchStatus = !status || s === status;
            const show = matchSearch && matchDivisi && matchStatus;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('tableInfo').textContent = `Menampilkan ${visible} dari ${rows.length} data`;
    }

    async function showDetail(id) {
        try {
            const res = await fetch('/employee/' + id, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await res.json();
            if (!data.success) return;
            const e = data.data;
            document.getElementById('detailAvatar').textContent = e.nama ? e.nama.charAt(0) : '?';
            document.getElementById('detailNama').textContent = e.nama;
            document.getElementById('detailNik').textContent = e.nik;
            document.getElementById('detailDivisi').textContent = e.divisi;
            document.getElementById('detailJabatan').textContent = e.jabatan;
            document.getElementById('detailEmail').textContent = e.email;
            document.getElementById('detailTelepon').textContent = e.telepon;
            document.getElementById('detailMasuk').textContent = e.tanggal_masuk;
            let badge = '';
            if (e.status === 'aktif') badge = '<span class="badge bg-success">Aktif</span>';
            else if (e.status === 'kontrak') badge = '<span class="badge bg-warning text-dark">Kontrak</span>';
            else badge = '<span class="badge bg-danger">Resign</span>';
            document.getElementById('detailStatus').innerHTML = badge;
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        } catch(ex) { console.error(ex); }
    }

    async function showEdit(id) {
        try {
            const res = await fetch('/employee/' + id, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await res.json();
            if (!data.success) return;
            const e = data.data;
            document.getElementById('editFormBody').innerHTML = `
                <form id="editForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">NIK <span class="text-danger">*</span></label><input type="text" class="form-control" name="nik" value="${e.nik}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control" name="nama" value="${e.nama}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Tempat Lahir</label><input type="text" class="form-control" name="tempat_lahir" value="${e.tempat_lahir || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Tanggal Lahir</label><input type="date" class="form-control" name="tanggal_lahir" value="${e.tanggal_lahir || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label><select class="form-select" name="jenis_kelamin" required><option value="L" ${e.jenis_kelamin==='L'?'selected':''}>Laki-laki</option><option value="P" ${e.jenis_kelamin==='P'?'selected':''}>Perempuan</option></select></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="email" value="${e.email}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Telepon <span class="text-danger">*</span></label><input type="text" class="form-control" name="telepon" value="${e.telepon}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Divisi <span class="text-danger">*</span></label><select class="form-select" name="divisi" required><option value="IT" ${e.divisi==='IT'?'selected':''}>IT</option><option value="HRD" ${e.divisi==='HRD'?'selected':''}>HRD</option><option value="Finance" ${e.divisi==='Finance'?'selected':''}>Finance</option><option value="Marketing" ${e.divisi==='Marketing'?'selected':''}>Marketing</option></select></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Departemen <span class="text-danger">*</span></label><input type="text" class="form-control" name="departemen" value="${e.departemen}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Jabatan <span class="text-danger">*</span></label><input type="text" class="form-control" name="jabatan" value="${e.jabatan}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Grade</label><input type="text" class="form-control" name="grade" value="${e.grade || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Lokasi Kerja</label><input type="text" class="form-control" name="lokasi_kerja" value="${e.lokasi_kerja || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Status Kepegawaian <span class="text-danger">*</span></label><input type="text" class="form-control" name="status_kepegawaian" value="${e.status_kepegawaian}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label><input type="date" class="form-control" name="tanggal_masuk" value="${e.tanggal_masuk}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Tanggal Kontrak Habis</label><input type="date" class="form-control" name="tanggal_kontrak_habis" value="${e.tanggal_kontrak_habis || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">No. KTP</label><input type="text" class="form-control" name="no_ktp" value="${e.no_ktp || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">No. NPWP</label><input type="text" class="form-control" name="no_npwp" value="${e.no_npwp || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">No. KK</label><input type="text" class="form-control" name="no_kk" value="${e.no_kk || ''}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Status <span class="text-danger">*</span></label><select class="form-select" name="status" required><option value="aktif" ${e.status==='aktif'?'selected':''}>Aktif</option><option value="kontrak" ${e.status==='kontrak'?'selected':''}>Kontrak</option><option value="resign" ${e.status==='resign'?'selected':''}>Resign</option></select></div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            `;
            document.getElementById('editForm').addEventListener('submit', async function(ev) {
                ev.preventDefault();
                const formData = new FormData(this);
                try {
                    const res = await fetch('/employee/' + id, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await res.json();
                    if (result.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                        location.reload();
                    } else {
                        let errors = '';
                        if (result.errors) Object.values(result.errors).forEach(arr => { errors += arr.join(', '); });
                        alert(result.message + (errors ? ': ' + errors : ''));
                    }
                } catch(ex) { alert('Error: ' + ex.message); }
            });
            new bootstrap.Modal(document.getElementById('editModal')).show();
        } catch(ex) { console.error(ex); }
    }

    function confirmDelete(id, nama) {
        deleteId = id;
        document.getElementById('deleteNama').textContent = nama;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    document.getElementById('btnDeleteConfirm').addEventListener('click', async function() {
        if (!deleteId) return;
        try {
            const res = await fetch('/employee/' + deleteId, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' }
            });
            const result = await res.json();
            if (result.success) {
                bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                location.reload();
            } else {
                alert(result.message || 'Gagal menghapus');
            }
        } catch(ex) { alert('Error: ' + ex.message); }
    });
</script>
@endsection
