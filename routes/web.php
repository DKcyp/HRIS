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
    Route::post('/', [PerformanceController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [PerformanceController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [PerformanceController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/kpi', [PerformanceController::class, 'kpi'])->name('kpi');
    Route::post('/kpi', [PerformanceController::class, 'kpiStore'])->name('kpi.store');
    Route::put('/kpi/{id}', [PerformanceController::class, 'kpiUpdate'])->name('kpi.update');
    Route::delete('/kpi/{id}', [PerformanceController::class, 'kpiDestroy'])->name('kpi.destroy');

    Route::get('/assessment', [PerformanceController::class, 'assessment'])->name('assessment');
    Route::post('/assessment', [PerformanceController::class, 'assessmentStore'])->name('assessment.store');
    Route::put('/assessment/{id}', [PerformanceController::class, 'assessmentUpdate'])->name('assessment.update');
    Route::delete('/assessment/{id}', [PerformanceController::class, 'assessmentDestroy'])->name('assessment.destroy');

    Route::get('/bulanan', [PerformanceController::class, 'bulanan'])->name('bulanan');
    Route::post('/bulanan', [PerformanceController::class, 'bulananStore'])->name('bulanan.store');
    Route::put('/bulanan/{id}', [PerformanceController::class, 'bulananUpdate'])->name('bulanan.update');
    Route::delete('/bulanan/{id}', [PerformanceController::class, 'bulananDestroy'])->name('bulanan.destroy');

    Route::get('/tahunan', [PerformanceController::class, 'tahunan'])->name('tahunan');
    Route::post('/tahunan', [PerformanceController::class, 'tahunanStore'])->name('tahunan.store');
    Route::put('/tahunan/{id}', [PerformanceController::class, 'tahunanUpdate'])->name('tahunan.update');
    Route::delete('/tahunan/{id}', [PerformanceController::class, 'tahunanDestroy'])->name('tahunan.destroy');

    Route::get('/target', [PerformanceController::class, 'target'])->name('target');
    Route::post('/target', [PerformanceController::class, 'targetStore'])->name('target.store');
    Route::put('/target/{id}', [PerformanceController::class, 'targetUpdate'])->name('target.update');
    Route::delete('/target/{id}', [PerformanceController::class, 'targetDestroy'])->name('target.destroy');

    Route::get('/feedback', [PerformanceController::class, 'feedback'])->name('feedback');
    Route::post('/feedback', [PerformanceController::class, 'feedbackStore'])->name('feedback.store');
    Route::put('/feedback/{id}', [PerformanceController::class, 'feedbackUpdate'])->name('feedback.update');
    Route::delete('/feedback/{id}', [PerformanceController::class, 'feedbackDestroy'])->name('feedback.destroy');
});

// Training
Route::prefix('training')->name('training.')->group(function () {
    Route::get('/', [TrainingController::class, 'index'])->name('index');
    Route::post('/', [TrainingController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [TrainingController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [TrainingController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/peserta', [TrainingController::class, 'peserta'])->name('peserta');
    Route::post('/peserta', [TrainingController::class, 'pesertaStore'])->name('peserta.store');
    Route::put('/peserta/{id}', [TrainingController::class, 'pesertaUpdate'])->name('peserta.update');
    Route::delete('/peserta/{id}', [TrainingController::class, 'pesertaDestroy'])->name('peserta.destroy');

    Route::get('/sertifikat', [TrainingController::class, 'sertifikat'])->name('sertifikat');
    Route::post('/sertifikat', [TrainingController::class, 'sertifikatStore'])->name('sertifikat.store');
    Route::put('/sertifikat/{id}', [TrainingController::class, 'sertifikatUpdate'])->name('sertifikat.update');
    Route::delete('/sertifikat/{id}', [TrainingController::class, 'sertifikatDestroy'])->name('sertifikat.destroy');

    Route::get('/nilai', [TrainingController::class, 'nilai'])->name('nilai');
    Route::post('/nilai', [TrainingController::class, 'nilaiStore'])->name('nilai.store');
    Route::put('/nilai/{id}', [TrainingController::class, 'nilaiUpdate'])->name('nilai.update');
    Route::delete('/nilai/{id}', [TrainingController::class, 'nilaiDestroy'])->name('nilai.destroy');
});

// Asset Management
Route::prefix('asset')->name('asset.')->group(function () {
    Route::get('/', [AssetController::class, 'index'])->name('index');
    Route::post('/', [AssetController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [AssetController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [AssetController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/peminjaman', [AssetController::class, 'peminjaman'])->name('peminjaman');
    Route::post('/peminjaman', [AssetController::class, 'peminjamanStore'])->name('peminjaman.store');
    Route::put('/peminjaman/{id}', [AssetController::class, 'peminjamanUpdate'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [AssetController::class, 'peminjamanDestroy'])->name('peminjaman.destroy');

    Route::get('/pengembalian', [AssetController::class, 'pengembalian'])->name('pengembalian');
    Route::post('/pengembalian', [AssetController::class, 'pengembalianStore'])->name('pengembalian.store');
    Route::put('/pengembalian/{id}', [AssetController::class, 'pengembalianUpdate'])->name('pengembalian.update');
    Route::delete('/pengembalian/{id}', [AssetController::class, 'pengembalianDestroy'])->name('pengembalian.destroy');
});

// Pengumuman
Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
    Route::get('/', [PengumumanController::class, 'index'])->name('index');
    Route::post('/', [PengumumanController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [PengumumanController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [PengumumanController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/event', [PengumumanController::class, 'event'])->name('event');
    Route::post('/event', [PengumumanController::class, 'eventStore'])->name('event.store');
    Route::put('/event/{id}', [PengumumanController::class, 'eventUpdate'])->name('event.update');
    Route::delete('/event/{id}', [PengumumanController::class, 'eventDestroy'])->name('event.destroy');

    Route::get('/birthday', [PengumumanController::class, 'birthday'])->name('birthday');
    Route::post('/birthday', [PengumumanController::class, 'birthdayStore'])->name('birthday.store');
    Route::put('/birthday/{id}', [PengumumanController::class, 'birthdayUpdate'])->name('birthday.update');
    Route::delete('/birthday/{id}', [PengumumanController::class, 'birthdayDestroy'])->name('birthday.destroy');

    Route::get('/libur-nasional', [PengumumanController::class, 'liburNasional'])->name('libur-nasional');
    Route::post('/libur-nasional', [PengumumanController::class, 'liburNasionalStore'])->name('libur-nasional.store');
    Route::put('/libur-nasional/{id}', [PengumumanController::class, 'liburNasionalUpdate'])->name('libur-nasional.update');
    Route::delete('/libur-nasional/{id}', [PengumumanController::class, 'liburNasionalDestroy'])->name('libur-nasional.destroy');
});

// Dokumen
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/', [DokumenController::class, 'index'])->name('index');
    Route::post('/', [DokumenController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [DokumenController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [DokumenController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/sop', [DokumenController::class, 'sop'])->name('sop');
    Route::post('/sop', [DokumenController::class, 'sopStore'])->name('sop.store');
    Route::put('/sop/{id}', [DokumenController::class, 'sopUpdate'])->name('sop.update');
    Route::delete('/sop/{id}', [DokumenController::class, 'sopDestroy'])->name('sop.destroy');

    Route::get('/kontrak', [DokumenController::class, 'kontrak'])->name('kontrak');
    Route::post('/kontrak', [DokumenController::class, 'kontrakStore'])->name('kontrak.store');
    Route::put('/kontrak/{id}', [DokumenController::class, 'kontrakUpdate'])->name('kontrak.update');
    Route::delete('/kontrak/{id}', [DokumenController::class, 'kontrakDestroy'])->name('kontrak.destroy');

    Route::get('/pkwt', [DokumenController::class, 'pkwt'])->name('pkwt');
    Route::post('/pkwt', [DokumenController::class, 'pkwtStore'])->name('pkwt.store');
    Route::put('/pkwt/{id}', [DokumenController::class, 'pkwtUpdate'])->name('pkwt.update');
    Route::delete('/pkwt/{id}', [DokumenController::class, 'pkwtDestroy'])->name('pkwt.destroy');

    Route::get('/nda', [DokumenController::class, 'nda'])->name('nda');
    Route::post('/nda', [DokumenController::class, 'ndaStore'])->name('nda.store');
    Route::put('/nda/{id}', [DokumenController::class, 'ndaUpdate'])->name('nda.update');
    Route::delete('/nda/{id}', [DokumenController::class, 'ndaDestroy'])->name('nda.destroy');

    Route::get('/surat-peringatan', [DokumenController::class, 'suratPeringatan'])->name('surat-peringatan');
    Route::post('/surat-peringatan', [DokumenController::class, 'suratPeringatanStore'])->name('surat-peringatan.store');
    Route::put('/surat-peringatan/{id}', [DokumenController::class, 'suratPeringatanUpdate'])->name('surat-peringatan.update');
    Route::delete('/surat-peringatan/{id}', [DokumenController::class, 'suratPeringatanDestroy'])->name('surat-peringatan.destroy');
});

// Resign
Route::prefix('resign')->name('resign.')->group(function () {
    Route::get('/', [ResignController::class, 'index'])->name('index');
    Route::post('/', [ResignController::class, 'indexStore'])->name('index.store');
    Route::put('/{id}', [ResignController::class, 'indexUpdate'])->name('index.update');
    Route::delete('/{id}', [ResignController::class, 'indexDestroy'])->name('index.destroy');

    Route::get('/exit-interview', [ResignController::class, 'exitInterview'])->name('exit-interview');
    Route::post('/exit-interview', [ResignController::class, 'exitInterviewStore'])->name('exit-interview.store');
    Route::put('/exit-interview/{id}', [ResignController::class, 'exitInterviewUpdate'])->name('exit-interview.update');
    Route::delete('/exit-interview/{id}', [ResignController::class, 'exitInterviewDestroy'])->name('exit-interview.destroy');

    Route::get('/clearance', [ResignController::class, 'clearance'])->name('clearance');
    Route::post('/clearance', [ResignController::class, 'clearanceStore'])->name('clearance.store');
    Route::put('/clearance/{id}', [ResignController::class, 'clearanceUpdate'])->name('clearance.update');
    Route::delete('/clearance/{id}', [ResignController::class, 'clearanceDestroy'])->name('clearance.destroy');

    Route::get('/pengembalian-asset', [ResignController::class, 'pengembalianAsset'])->name('pengembalian-asset');
    Route::post('/pengembalian-asset', [ResignController::class, 'pengembalianAssetStore'])->name('pengembalian-asset.store');
    Route::put('/pengembalian-asset/{id}', [ResignController::class, 'pengembalianAssetUpdate'])->name('pengembalian-asset.update');
    Route::delete('/pengembalian-asset/{id}', [ResignController::class, 'pengembalianAssetDestroy'])->name('pengembalian-asset.destroy');
});

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
