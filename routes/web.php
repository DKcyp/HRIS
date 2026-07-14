<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserManagementController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Employee Management
Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/riwayat-jabatan', [EmployeeController::class, 'riwayatJabatan'])->name('riwayat-jabatan');
    Route::get('/riwayat-gaji', [EmployeeController::class, 'riwayatGaji'])->name('riwayat-gaji');
    Route::get('/pendidikan', [EmployeeController::class, 'pendidikan'])->name('pendidikan');
    Route::get('/pengalaman', [EmployeeController::class, 'pengalaman'])->name('pengalaman');
    Route::get('/sertifikat', [EmployeeController::class, 'sertifikat'])->name('sertifikat');
    Route::get('/dokumen', [EmployeeController::class, 'dokumen'])->name('dokumen');
    Route::get('/kontak-darurat', [EmployeeController::class, 'kontakDarurat'])->name('kontak-darurat');
    Route::get('/status', [EmployeeController::class, 'status'])->name('status');
});
Route::resource('employee', EmployeeController::class);
Route::pattern('employee', '[0-9]+');

// Organisasi
Route::prefix('organisasi')->name('organisasi.')->group(function () {
    Route::get('/division', [OrganisasiController::class, 'division'])->name('division');
    Route::post('/division', [OrganisasiController::class, 'divisionStore'])->name('division.store');
    Route::put('/division/{id}', [OrganisasiController::class, 'divisionUpdate'])->name('division.update');
    Route::delete('/division/{id}', [OrganisasiController::class, 'divisionDestroy'])->name('division.destroy');

    Route::get('/department', [OrganisasiController::class, 'department'])->name('department');
    Route::post('/department', [OrganisasiController::class, 'departmentStore'])->name('department.store');
    Route::put('/department/{id}', [OrganisasiController::class, 'departmentUpdate'])->name('department.update');
    Route::delete('/department/{id}', [OrganisasiController::class, 'departmentDestroy'])->name('department.destroy');

    Route::get('/position', [OrganisasiController::class, 'position'])->name('position');
    Route::post('/position', [OrganisasiController::class, 'positionStore'])->name('position.store');
    Route::put('/position/{id}', [OrganisasiController::class, 'positionUpdate'])->name('position.update');
    Route::delete('/position/{id}', [OrganisasiController::class, 'positionDestroy'])->name('position.destroy');

    Route::get('/grade', [OrganisasiController::class, 'grade'])->name('grade');
    Route::post('/grade', [OrganisasiController::class, 'gradeStore'])->name('grade.store');
    Route::put('/grade/{id}', [OrganisasiController::class, 'gradeUpdate'])->name('grade.update');
    Route::delete('/grade/{id}', [OrganisasiController::class, 'gradeDestroy'])->name('grade.destroy');

    Route::get('/location', [OrganisasiController::class, 'location'])->name('location');
    Route::post('/location', [OrganisasiController::class, 'locationStore'])->name('location.store');
    Route::put('/location/{id}', [OrganisasiController::class, 'locationUpdate'])->name('location.update');
    Route::delete('/location/{id}', [OrganisasiController::class, 'locationDestroy'])->name('location.destroy');

    Route::get('/shift', [OrganisasiController::class, 'shift'])->name('shift');
    Route::post('/shift', [OrganisasiController::class, 'shiftStore'])->name('shift.store');
    Route::put('/shift/{id}', [OrganisasiController::class, 'shiftUpdate'])->name('shift.update');
    Route::delete('/shift/{id}', [OrganisasiController::class, 'shiftDestroy'])->name('shift.destroy');
});

// Recruitment
Route::prefix('recruitment')->name('recruitment.')->group(function () {
    Route::get('/', [RecruitmentController::class, 'index'])->name('index');
    Route::post('/', [RecruitmentController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [RecruitmentController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [RecruitmentController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/applicant', [RecruitmentController::class, 'applicant'])->name('applicant');
    Route::post('/applicant', [RecruitmentController::class, 'applicantStore'])->name('applicant.store');
    Route::put('/applicant/{id}', [RecruitmentController::class, 'applicantUpdate'])->name('applicant.update');
    Route::delete('/applicant/{id}', [RecruitmentController::class, 'applicantDestroy'])->name('applicant.destroy');

    Route::get('/interview', [RecruitmentController::class, 'interview'])->name('interview');
    Route::post('/interview', [RecruitmentController::class, 'interviewStore'])->name('interview.store');
    Route::put('/interview/{id}', [RecruitmentController::class, 'interviewUpdate'])->name('interview.update');
    Route::delete('/interview/{id}', [RecruitmentController::class, 'interviewDestroy'])->name('interview.destroy');

    Route::get('/offering', [RecruitmentController::class, 'offering'])->name('offering');
    Route::post('/offering', [RecruitmentController::class, 'offeringStore'])->name('offering.store');
    Route::put('/offering/{id}', [RecruitmentController::class, 'offeringUpdate'])->name('offering.update');
    Route::delete('/offering/{id}', [RecruitmentController::class, 'offeringDestroy'])->name('offering.destroy');

    Route::get('/psikotes', [RecruitmentController::class, 'psikotes'])->name('psikotes');
    Route::post('/psikotes', [RecruitmentController::class, 'psikotesStore'])->name('psikotes.store');
    Route::put('/psikotes/{id}', [RecruitmentController::class, 'psikotesUpdate'])->name('psikotes.update');
    Route::delete('/psikotes/{id}', [RecruitmentController::class, 'psikotesDestroy'])->name('psikotes.destroy');

    Route::get('/hiring', [RecruitmentController::class, 'hiring'])->name('hiring');
    Route::post('/hiring', [RecruitmentController::class, 'hiringStore'])->name('hiring.store');
    Route::put('/hiring/{id}', [RecruitmentController::class, 'hiringUpdate'])->name('hiring.update');
    Route::delete('/hiring/{id}', [RecruitmentController::class, 'hiringDestroy'])->name('hiring.destroy');
});

// Attendance
Route::prefix('attendance')->name('attendance.')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('index');
    Route::post('/', [AttendanceController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [AttendanceController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [AttendanceController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/checkin', [AttendanceController::class, 'checkin'])->name('checkin');
    Route::post('/checkin', [AttendanceController::class, 'storeCheckin'])->name('checkin.store');

    Route::get('/overtime', [AttendanceController::class, 'overtime'])->name('overtime');
    Route::post('/overtime', [AttendanceController::class, 'overtimeStore'])->name('overtime.store');
    Route::put('/overtime/{id}', [AttendanceController::class, 'overtimeUpdate'])->name('overtime.update');
    Route::delete('/overtime/{id}', [AttendanceController::class, 'overtimeDestroy'])->name('overtime.destroy');

    Route::get('/terlambat', [AttendanceController::class, 'terlambat'])->name('terlambat');
    Route::post('/terlambat', [AttendanceController::class, 'terlambatStore'])->name('terlambat.store');
    Route::put('/terlambat/{id}', [AttendanceController::class, 'terlambatUpdate'])->name('terlambat.update');
    Route::delete('/terlambat/{id}', [AttendanceController::class, 'terlambatDestroy'])->name('terlambat.destroy');

    Route::get('/riwayat', [AttendanceController::class, 'riwayat'])->name('riwayat');
    Route::post('/riwayat', [AttendanceController::class, 'riwayatStore'])->name('riwayat.store');
    Route::put('/riwayat/{id}', [AttendanceController::class, 'riwayatUpdate'])->name('riwayat.update');
    Route::delete('/riwayat/{id}', [AttendanceController::class, 'riwayatDestroy'])->name('riwayat.destroy');
});

// Leave Management
Route::prefix('leave')->name('leave.')->group(function () {
    Route::get('/', [LeaveController::class, 'index'])->name('index');
    Route::post('/', [LeaveController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [LeaveController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [LeaveController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/approval', [LeaveController::class, 'approval'])->name('approval');
    Route::post('/approval', [LeaveController::class, 'approvalStore'])->name('approval.store');

    Route::get('/jenis', [LeaveController::class, 'jenis'])->name('jenis');
    Route::post('/jenis', [LeaveController::class, 'jenisStore'])->name('jenis.store');
    Route::put('/jenis/{id}', [LeaveController::class, 'jenisUpdate'])->name('jenis.update');
    Route::delete('/jenis/{id}', [LeaveController::class, 'jenisDestroy'])->name('jenis.destroy');

    Route::get('/sisa', [LeaveController::class, 'sisa'])->name('sisa');
    Route::get('/history', [LeaveController::class, 'history'])->name('history');
});

// Izin & Sakit
Route::prefix('izin')->name('izin.')->group(function () {
    Route::get('/', [IzinController::class, 'index'])->name('index');
    Route::post('/', [IzinController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [IzinController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [IzinController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/surat-dokter', [IzinController::class, 'suratDokter'])->name('surat-dokter');
    Route::post('/surat-dokter', [IzinController::class, 'suratDokterStore'])->name('surat-dokter.store');
    Route::put('/surat-dokter/{id}', [IzinController::class, 'suratDokterUpdate'])->name('surat-dokter.update');
    Route::delete('/surat-dokter/{id}', [IzinController::class, 'suratDokterDestroy'])->name('surat-dokter.destroy');

    Route::get('/approval', [IzinController::class, 'approval'])->name('approval');
    Route::post('/approval', [IzinController::class, 'approvalStore'])->name('approval.store');

    Route::get('/history', [IzinController::class, 'history'])->name('history');
});

// Payroll
Route::prefix('payroll')->name('payroll.')->group(function () {
    Route::get('/', [PayrollController::class, 'index'])->name('index');
    Route::post('/', [PayrollController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [PayrollController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [PayrollController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/slip', [PayrollController::class, 'slip'])->name('slip');
    Route::post('/slip', [PayrollController::class, 'slipStore'])->name('slip.store');

    Route::get('/generate', [PayrollController::class, 'generate'])->name('generate');
    Route::post('/generate', [PayrollController::class, 'generateStore'])->name('generate.store');

    Route::get('/gaji-pokok', [PayrollController::class, 'gajiPokok'])->name('gaji-pokok');
    Route::post('/gaji-pokok', [PayrollController::class, 'gajiPokokStore'])->name('gaji-pokok.store');
    Route::put('/gaji-pokok/{id}', [PayrollController::class, 'gajiPokokUpdate'])->name('gaji-pokok.update');
    Route::delete('/gaji-pokok/{id}', [PayrollController::class, 'gajiPokokDestroy'])->name('gaji-pokok.destroy');

    Route::get('/tunjangan', [PayrollController::class, 'tunjangan'])->name('tunjangan');
    Route::post('/tunjangan', [PayrollController::class, 'tunjanganStore'])->name('tunjangan.store');
    Route::put('/tunjangan/{id}', [PayrollController::class, 'tunjanganUpdate'])->name('tunjangan.update');
    Route::delete('/tunjangan/{id}', [PayrollController::class, 'tunjanganDestroy'])->name('tunjangan.destroy');

    Route::get('/bonus', [PayrollController::class, 'bonus'])->name('bonus');
    Route::post('/bonus', [PayrollController::class, 'bonusStore'])->name('bonus.store');
    Route::put('/bonus/{id}', [PayrollController::class, 'bonusUpdate'])->name('bonus.update');
    Route::delete('/bonus/{id}', [PayrollController::class, 'bonusDestroy'])->name('bonus.destroy');

    Route::get('/potongan', [PayrollController::class, 'potongan'])->name('potongan');
    Route::post('/potongan', [PayrollController::class, 'potonganStore'])->name('potongan.store');
    Route::put('/potongan/{id}', [PayrollController::class, 'potonganUpdate'])->name('potongan.update');
    Route::delete('/potongan/{id}', [PayrollController::class, 'potonganDestroy'])->name('potongan.destroy');

    Route::get('/bpjs', [PayrollController::class, 'bpjs'])->name('bpjs');
    Route::post('/bpjs', [PayrollController::class, 'bpjsStore'])->name('bpjs.store');
    Route::put('/bpjs/{id}', [PayrollController::class, 'bpjsUpdate'])->name('bpjs.update');
    Route::delete('/bpjs/{id}', [PayrollController::class, 'bpjsDestroy'])->name('bpjs.destroy');

    Route::get('/pajak', [PayrollController::class, 'pajak'])->name('pajak');
    Route::post('/pajak', [PayrollController::class, 'pajakStore'])->name('pajak.store');
    Route::put('/pajak/{id}', [PayrollController::class, 'pajakUpdate'])->name('pajak.update');
    Route::delete('/pajak/{id}', [PayrollController::class, 'pajakDestroy'])->name('pajak.destroy');

    Route::get('/rekap', [PayrollController::class, 'rekap'])->name('rekap');
    Route::post('/rekap', [PayrollController::class, 'rekapStore'])->name('rekap.store');
    Route::put('/rekap/{id}', [PayrollController::class, 'rekapUpdate'])->name('rekap.update');
    Route::delete('/rekap/{id}', [PayrollController::class, 'rekapDestroy'])->name('rekap.destroy');
});

// Performance
Route::prefix('performance')->name('performance.')->group(function () {
    Route::get('/', [PerformanceController::class, 'index'])->name('index');
    Route::get('/kpi', [PerformanceController::class, 'kpi'])->name('kpi');
    Route::get('/assessment', [PerformanceController::class, 'assessment'])->name('assessment');
    Route::get('/bulanan', [PerformanceController::class, 'bulanan'])->name('bulanan');
    Route::get('/tahunan', [PerformanceController::class, 'tahunan'])->name('tahunan');
    Route::get('/target', [PerformanceController::class, 'target'])->name('target');
    Route::get('/feedback', [PerformanceController::class, 'feedback'])->name('feedback');
});

// Training
Route::prefix('training')->name('training.')->group(function () {
    Route::get('/peserta', [TrainingController::class, 'peserta'])->name('peserta');
    Route::get('/sertifikat', [TrainingController::class, 'sertifikat'])->name('sertifikat');
    Route::get('/nilai', [TrainingController::class, 'nilai'])->name('nilai');
});
Route::resource('training', TrainingController::class);
Route::pattern('training', '[0-9]+');

// Asset Management
Route::prefix('asset')->name('asset.')->group(function () {
    Route::get('/peminjaman', [AssetController::class, 'peminjaman'])->name('peminjaman');
    Route::get('/pengembalian', [AssetController::class, 'pengembalian'])->name('pengembalian');
});
Route::resource('asset', AssetController::class);
Route::pattern('asset', '[0-9]+');

// Pengumuman
Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
    Route::get('/event', [PengumumanController::class, 'event'])->name('event');
    Route::get('/birthday', [PengumumanController::class, 'birthday'])->name('birthday');
    Route::get('/libur-nasional', [PengumumanController::class, 'liburNasional'])->name('libur-nasional');
});
Route::resource('pengumuman', PengumumanController::class);
Route::pattern('pengumuman', '[0-9]+');

// Dokumen
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/sop', [DokumenController::class, 'sop'])->name('sop');
    Route::get('/kontrak', [DokumenController::class, 'kontrak'])->name('kontrak');
    Route::get('/pkwt', [DokumenController::class, 'pkwt'])->name('pkwt');
    Route::get('/nda', [DokumenController::class, 'nda'])->name('nda');
    Route::get('/surat-peringatan', [DokumenController::class, 'suratPeringatan'])->name('surat-peringatan');
});
Route::resource('dokumen', DokumenController::class);
Route::pattern('dokumen', '[0-9]+');

// Resign
Route::prefix('resign')->name('resign.')->group(function () {
    Route::get('/exit-interview', [ResignController::class, 'exitInterview'])->name('exit-interview');
    Route::get('/clearance', [ResignController::class, 'clearance'])->name('clearance');
    Route::get('/pengembalian-asset', [ResignController::class, 'pengembalianAsset'])->name('pengembalian-asset');
});
Route::resource('resign', ResignController::class);
Route::pattern('resign', '[0-9]+');

// Laporan
Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('index');
    Route::get('/attendance', [LaporanController::class, 'attendance'])->name('attendance');
    Route::get('/leave', [LaporanController::class, 'leave'])->name('leave');
    Route::get('/payroll', [LaporanController::class, 'payroll'])->name('payroll');
    Route::get('/employee', [LaporanController::class, 'employee'])->name('employee');
    Route::get('/turnover', [LaporanController::class, 'turnover'])->name('turnover');
    Route::get('/lembur', [LaporanController::class, 'lembur'])->name('lembur');
});

// User Management
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
});

// Roles & Permissions
Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/', [UserManagementController::class, 'roles'])->name('index');
    Route::get('/permissions', [UserManagementController::class, 'permissions'])->name('permissions');
});
