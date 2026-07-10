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
        <button class="btn btn-primary" onclick="window.location='{{ route('employee.create') }}'">
            <i class="fas fa-plus me-1"></i> Tambah Karyawan
        </button>
    </div>
    <div class="card-body">
        <!-- Filter -->
        <div class="row mb-4">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Cari nama/NIK...">
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Semua Divisi</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>
                    <option>Marketing</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option>Aktif</option>
                    <option>Kontrak</option>
                    <option>Resign</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100"><i class="fas fa-search me-1"></i> Cari</button>
            </div>
        </div>
        
        <!-- Table -->
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
                <tbody>
                    @forelse($employees as $emp)
                    <tr>
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
                                <button type="button" class="btn btn-outline-info" title="Detail"
                                    onclick="showDetail('{{ $emp->nik }}','{{ $emp->nama }}','{{ $emp->divisi }}','{{ $emp->jabatan }}','{{ $emp->email }}','{{ $emp->telepon }}','{{ $emp->status }}','{{ $emp->tanggal_masuk }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning" title="Edit"
                                    onclick="showEdit('{{ $emp->id }}','{{ $emp->nik }}','{{ $emp->nama }}','{{ $emp->divisi }}','{{ $emp->jabatan }}','{{ $emp->email }}','{{ $emp->telepon }}','{{ $emp->status }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Hapus" onclick="confirmDelete('{{ $emp->nama }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            <p>Belum ada data karyawan</p>
                            <button class="btn btn-primary mt-2" onclick="window.location='{{ route('employee.create') }}'">
                                <i class="fas fa-plus me-1"></i> Tambah Karyawan Pertama
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">Menampilkan 1 - {{ count($employees) }} dari {{ count($employees) }} data</div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Detail Karyawan -->
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
                            <tr>
                                <td class="text-muted" width="140">Divisi</td>
                                <td>: <strong id="detailDivisi"></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jabatan</td>
                                <td>: <strong id="detailJabatan"></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td>: <span id="detailEmail"></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Telepon</td>
                                <td>: <span id="detailTelepon"></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td>: <span id="detailStatus"></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Masuk</td>
                                <td>: <span id="detailMasuk"></span></td>
                            </tr>
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

<!-- Modal Edit Karyawan -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" id="editNik" name="nik" readonly style="background:#f0f0f0;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Divisi <span class="text-danger">*</span></label>
                            <select class="form-select" id="editDivisi" name="divisi" required>
                                <option value="IT">IT</option>
                                <option value="HRD">HRD</option>
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editJabatan" name="jabatan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editTelepon" name="telepon" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="aktif">Aktif</option>
                                <option value="kontrak">Kontrak</option>
                                <option value="resign">Resign</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                </div>
            </form>
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
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteEmployee()"><i class="fas fa-trash me-1"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showDetail(nik, nama, divisi, jabatan, email, telepon, status, tanggalMasuk) {
        document.getElementById('detailAvatar').textContent = nama.charAt(0);
        document.getElementById('detailNama').textContent = nama;
        document.getElementById('detailNik').textContent = nik;
        document.getElementById('detailDivisi').textContent = divisi;
        document.getElementById('detailJabatan').textContent = jabatan;
        document.getElementById('detailEmail').textContent = email;
        document.getElementById('detailTelepon').textContent = telepon;
        document.getElementById('detailMasuk').textContent = tanggalMasuk;
        
        var statusEl = document.getElementById('detailStatus');
        if (status === 'aktif') {
            statusEl.innerHTML = '<span class="badge bg-success">Aktif</span>';
        } else if (status === 'kontrak') {
            statusEl.innerHTML = '<span class="badge bg-warning text-dark">Kontrak</span>';
        } else {
            statusEl.innerHTML = '<span class="badge bg-danger">Resign</span>';
        }
        
        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }
    
    function showEdit(id, nik, nama, divisi, jabatan, email, telepon, status) {
        document.getElementById('editId').value = id;
        document.getElementById('editNik').value = nik;
        document.getElementById('editNama').value = nama;
        document.getElementById('editDivisi').value = divisi;
        document.getElementById('editJabatan').value = jabatan;
        document.getElementById('editEmail').value = email;
        document.getElementById('editTelepon').value = telepon;
        document.getElementById('editStatus').value = status;
        document.getElementById('editForm').action = '/employee/' + id;
        
        new bootstrap.Modal(document.getElementById('editModal')).show();
    }
    
    function confirmDelete(nama) {
        document.getElementById('deleteNama').textContent = nama;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
    
    function deleteEmployee() {
        // Logic hapus
        alert('Karyawan berhasil dihapus');
        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
    }
</script>
@endpush
