<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = collect([
            (object)['id'=>1,'kode'=>'TRN-001','nama'=>'Pelatihan Leadership','deskripsi'=>'Pelatihan kepemimpinan untuk level manager','trainer'=>'Dr. Ahmad Fauzi','tanggal_mulai'=>'2024-04-01','tanggal_selesai'=>'2024-04-03','lokasi'=>'Meeting Room A','kuota'=>20,'peserta'=>15,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'TRN-002','nama'=>'Training Public Speaking','deskripsi'=>'Pelatihan teknik presentasi dan berbicara di depan umum','trainer'=>'Rina Wulandari','tanggal_mulai'=>'2024-04-10','tanggal_selesai'=>'2024-04-10','lokasi'=>'Auditorium','kuota'=>30,'peserta'=>28,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'TRN-003','nama'=>'Workshop Digital Marketing','deskripsi'=>'Workshop strategi digital marketing terkini','trainer'=>'Budi Setiawan','tanggal_mulai'=>'2024-04-15','tanggal_selesai'=>'2024-04-16','lokasi'=>'Training Center','kuota'=>25,'peserta'=>25,'status'=>'penuh'],
            (object)['id'=>4,'kode'=>'TRN-004','nama'=>'Sertifikasi ISO 9001','deskripsi'=>'Persiapan sertifikasi ISO 9001 Quality Management','trainer'=>'Ir. Suharto','tanggal_mulai'=>'2024-05-01','tanggal_selesai'=>'2024-05-05','lokasi'=>'Hotel Grand Mercure','kuota'=>15,'peserta'=>8,'status'=>'draft'],
            (object)['id'=>5,'kode'=>'TRN-005','nama'=>'Safety Induction','deskripsi'=>'Pelatihan keselamatan kerja untuk karyawan baru','trainer'=>'HSE Department','tanggal_mulai'=>'2024-04-05','tanggal_selesai'=>'2024-04-05','lokasi'=>'Ruang Rapat B','kuota'=>50,'peserta'=>42,'status'=>'aktif'],
        ]);

        return view('training.index', compact('trainings'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('training.index')->with('success', 'Data jadwal training berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('training.index')->with('success', 'Data jadwal training berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('training.index')->with('success', 'Data jadwal training berhasil dihapus');
    }

    public function peserta()
    {
        $participants = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'Marketing','jabatan'=>'Staff','training'=>'Pelatihan Leadership','tanggal'=>'2024-04-01','status'=>'hadir','nilai'=>85],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','jabatan'=>'Supervisor','training'=>'Training Public Speaking','tanggal'=>'2024-04-10','status'=>'hadir','nilai'=>90],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','jabatan'=>'Staff','training'=>'Workshop Digital Marketing','tanggal'=>'2024-04-15','status'=>'hadir','nilai'=>78],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','jabatan'=>'Manager','training'=>'Pelatihan Leadership','tanggal'=>'2024-04-01','status'=>'hadir','nilai'=>88],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','jabatan'=>'Staff','training'=>'Safety Induction','tanggal'=>'2024-04-05','status'=>'tidak_hadir','nilai'=>null],
        ]);

        return view('training.peserta', compact('participants'));
    }

    public function pesertaStore(Request $request)
    {
        return redirect()->route('training.peserta')->with('success', 'Data peserta berhasil ditambahkan');
    }

    public function pesertaUpdate(Request $request, $id)
    {
        return redirect()->route('training.peserta')->with('success', 'Data peserta berhasil diupdate');
    }

    public function pesertaDestroy($id)
    {
        return redirect()->route('training.peserta')->with('success', 'Data peserta berhasil dihapus');
    }

    public function sertifikat()
    {
        $certificates = collect([
            (object)['id'=>1,'kode'=>'SRT-001','nama'=>'Sertifikat Leadership','nik'=>'EMP-001','nama_karyawan'=>'Budi Santoso','training'=>'Pelatihan Leadership','tanggal_terbit'=>'2024-04-03','tanggal_kadaluarsa'=>'2027-04-03','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'SRT-002','nama'=>'Sertifikat Public Speaking','nik'=>'EMP-002','nama_karyawan'=>'Siti Rahayu','training'=>'Training Public Speaking','tanggal_terbit'=>'2024-04-10','tanggal_kadaluarsa'=>'2027-04-10','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'SRT-003','nama'=>'Sertifikat Digital Marketing','nik'=>'EMP-003','nama_karyawan'=>'Andi Wijaya','training'=>'Workshop Digital Marketing','tanggal_terbit'=>'2024-04-16','tanggal_kadaluarsa'=>'2027-04-16','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'SRT-004','nama'=>'Sertifikat Safety Induction','nik'=>'EMP-004','nama_karyawan'=>'Dewi Lestari','training'=>'Safety Induction','tanggal_terbit'=>'2024-04-05','tanggal_kadaluarsa'=>'2026-04-05','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'SRT-005','nama'=>'ISO 9001 Internal Auditor','nik'=>'EMP-005','nama_karyawan'=>'Rizky Pratama','training'=>'Sertifikasi ISO 9001','tanggal_terbit'=>'2024-03-01','tanggal_kadaluarsa'=>'2026-03-01','status'=>'kadaluarsa'],
        ]);

        return view('training.sertifikat', compact('certificates'));
    }

    public function sertifikatStore(Request $request)
    {
        return redirect()->route('training.sertifikat')->with('success', 'Data sertifikat berhasil ditambahkan');
    }

    public function sertifikatUpdate(Request $request, $id)
    {
        return redirect()->route('training.sertifikat')->with('success', 'Data sertifikat berhasil diupdate');
    }

    public function sertifikatDestroy($id)
    {
        return redirect()->route('training.sertifikat')->with('success', 'Data sertifikat berhasil dihapus');
    }

    public function nilai()
    {
        $scores = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','training'=>'Pelatihan Leadership','nilai'=>85,'grade'=>'A','keterangan'=>'Sangat Baik','tanggal'=>'2024-04-03'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','training'=>'Training Public Speaking','nilai'=>90,'grade'=>'A','keterangan'=>'Excellent','tanggal'=>'2024-04-10'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','training'=>'Workshop Digital Marketing','nilai'=>78,'grade'=>'B+','keterangan'=>'Baik','tanggal'=>'2024-04-16'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','training'=>'Pelatihan Leadership','nilai'=>88,'grade'=>'A','keterangan'=>'Sangat Baik','tanggal'=>'2024-04-03'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','training'=>'Safety Induction','nilai'=>72,'grade'=>'B','keterangan'=>'Cukup','tanggal'=>'2024-04-05'],
        ]);

        return view('training.nilai', compact('scores'));
    }

    public function nilaiStore(Request $request)
    {
        return redirect()->route('training.nilai')->with('success', 'Data nilai berhasil ditambahkan');
    }

    public function nilaiUpdate(Request $request, $id)
    {
        return redirect()->route('training.nilai')->with('success', 'Data nilai berhasil diupdate');
    }

    public function nilaiDestroy($id)
    {
        return redirect()->route('training.nilai')->with('success', 'Data nilai berhasil dihapus');
    }
}
