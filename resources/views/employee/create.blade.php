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
        <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            
            <!-- Data Diri -->
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

            <!-- Kontak -->
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
                    <input type="text" class="form-control" name="bpjs" placeholder="Nomor BPJS">
                </div>
            </div>

            <!-- Alamat -->
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

            <!-- Kepegawaian -->
            <h6 class="text-primary mb-3"><i class="fas fa-briefcase me-2"></i>Kepegawaian</h6>
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Divisi <span class="text-danger">*</span></label>
                    <select class="form-select" name="divisi_id" required>
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
                    <select class="form-select" name="departemen_id" required>
                        <option value="">Pilih Departemen</option>
                        <option>Development</option>
                        <option>HRGA</option>
                        <option>Accounting</option>
                        <option>Digital Marketing</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                    <select class="form-select" name="jabatan_id" required>
                        <option value="">Pilih Jabatan</option>
                        <option>Staff</option>
                        <option>Senior Staff</option>
                        <option>Supervisor</option>
                        <option>Manager</option>
                        <option>Director</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Grade</label>
                    <select class="form-select" name="grade_id">
                        <option value="">Pilih Grade</option>
                        <option>Grade 1</option>
                        <option>Grade 2</option>
                        <option>Grade 3</option>
                        <option>Grade 4</option>
                        <option>Grade 5</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lokasi Kerja</label>
                    <select class="form-select" name="location_id">
                        <option value="">Pilih Lokasi</option>
                        <option>Kantor Pusat - Jakarta</option>
                        <option>Kantor Cabang - Bandung</option>
                        <option>Remote</option>
                    </select>
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

            <!-- Dokumen -->
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
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Karyawan</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                </div>
            </div>

            <!-- Submit -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary px-4">
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
@endsection
