@extends('layouts.app')

@section('title', 'Tambah Karyawan - HRIS V2')
@section('page-title', 'Tambah Karyawan Baru')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-user-plus me-2"></i>
            Form Tambah Karyawan
        </h5>
        <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary" onclick="navigateTo(event, '{{ route('employee.index') }}')">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div id="formAlert" class="alert d-none" role="alert"></div>
        <form id="createForm">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Data Diri</h6>
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nik" placeholder="EMP-XXX" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Kota Kelahiran">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Agama</label>
                    <select class="form-select" name="agama">
                        <option value="">Pilih</option>
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status Nikah</label>
                    <select class="form-select" name="status_nikah">
                        <option value="">Pilih</option>
                        <option>Belum Nikah</option>
                        <option>Nikah</option>
                        <option>Cerai</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Golongan Darah</label>
                    <select class="form-select" name="golongan_darah">
                        <option value="">Pilih</option>
                        <option>A</option>
                        <option>B</option>
                        <option>AB</option>
                        <option>O</option>
                    </select>
                </div>
            </div>

            <h6 class="text-primary mb-3"><i class="fas fa-phone me-2"></i>Kontak</h6>
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="email@hris.com" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="telepon" placeholder="08XXXXXXXXXX" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. BPJS</label>
                    <input type="text" class="form-control" name="no_bpjs" placeholder="Nomor BPJS">
                </div>
            </div>

            <h6 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Alamat</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat lengkap"></textarea>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-control" name="kota" placeholder="Kota">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Provinsi</label>
                    <input type="text" class="form-control" name="provinsi" placeholder="Provinsi">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" name="kode_pos" placeholder="XXXXXX">
                </div>
            </div>

            <h6 class="text-primary mb-3"><i class="fas fa-briefcase me-2"></i>Kepegawaian</h6>
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Divisi <span class="text-danger">*</span></label>
                    <select class="form-select" name="divisi" required>
                        <option value="">Pilih Divisi</option>
                        <option>IT</option>
                        <option>HRD</option>
                        <option>Finance</option>
                        <option>Marketing</option>
                        <option>Operasional</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Departemen <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="departemen" placeholder="Departemen" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Grade</label>
                    <input type="text" class="form-control" name="grade" placeholder="Grade">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lokasi Kerja</label>
                    <input type="text" class="form-control" name="lokasi_kerja" placeholder="Lokasi Kerja">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status Kepegawaian <span class="text-danger">*</span></label>
                    <select class="form-select" name="status_kepegawaian" required>
                        <option value="">Pilih</option>
                        <option>Tetap</option>
                        <option>Kontrak</option>
                        <option>Probation</option>
                        <option>Freelance</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_masuk" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Kontrak Habis</label>
                    <input type="date" class="form-control" name="tanggal_kontrak_habis">
                </div>
            </div>

            <h6 class="text-primary mb-3"><i class="fas fa-id-card me-2"></i>Dokumen</h6>
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. KTP</label>
                    <input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. NPWP</label>
                    <input type="text" class="form-control" name="no_npwp" placeholder="Nomor NPWP">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. KK</label>
                    <input type="text" class="form-control" name="no_kk" placeholder="Nomor Kartu Keluarga">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="kontrak">Kontrak</option>
                        <option value="resign">Resign</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary px-4" onclick="navigateTo(event, '{{ route('employee.index') }}')">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="reset" class="btn btn-outline-warning px-4">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('createForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const alertBox = document.getElementById('formAlert');
        const submitBtn = form.querySelector('button[type="submit"]');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
        alertBox.classList.add('d-none');

        try {
            const formData = new FormData(form);
            const res = await fetch('{{ route("employee.store") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const result = await res.json();
            if (result.success) {
                alertBox.className = 'alert alert-success';
                alertBox.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + result.message;
                alertBox.classList.remove('d-none');
                form.reset();
                setTimeout(() => { navigateTo(null, '{{ route("employee.index") }}'); }, 1500);
            } else {
                let errors = '';
                if (result.errors) {
                    Object.values(result.errors).forEach(arr => { errors += arr.join(', '); });
                }
                alertBox.className = 'alert alert-danger';
                alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + (result.message || 'Gagal menyimpan') + (errors ? ': ' + errors : '');
                alertBox.classList.remove('d-none');
            }
        } catch(ex) {
            alertBox.className = 'alert alert-danger';
            alertBox.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Error: ' + ex.message;
            alertBox.classList.remove('d-none');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save me-1"></i> Simpan';
        }
    });
</script>
@endsection
