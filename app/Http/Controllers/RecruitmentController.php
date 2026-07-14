<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index()
    {
        $lowongans = collect([
            (object)['id'=>1,'kode'=>'JOB-001','posisi'=>'Software Developer','departemen'=>'Software Development','jumlah'=>3,'gaji_min'=>5000000,'gaji_max'=>8000000,'tutup'=>'2024-03-31','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'JOB-002','posisi'=>'HR Staff','departemen'=>'Recruitment','jumlah'=>2,'gaji_min'=>4000000,'gaji_max'=>6000000,'tutup'=>'2024-04-15','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'JOB-003','posisi'=>'Accounting Staff','departemen'=>'Accounting','jumlah'=>1,'gaji_min'=>4500000,'gaji_max'=>6500000,'tutup'=>'2024-04-10','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'JOB-004','posisi'=>'Marketing Executive','departemen'=>'Digital Marketing','jumlah'=>2,'gaji_min'=>4000000,'gaji_max'=>7000000,'tutup'=>'2024-03-20','status'=>'ditutup'],
            (object)['id'=>5,'kode'=>'JOB-005','posisi'=>'Network Engineer','departemen'=>'Infrastructure','jumlah'=>1,'gaji_min'=>6000000,'gaji_max'=>9000000,'tutup'=>'2024-05-01','status'=>'aktif'],
        ]);

        return view('recruitment.index', compact('lowongans'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('recruitment.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.index')->with('success', 'Lowongan berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('recruitment.index')->with('success', 'Lowongan berhasil dihapus');
    }

    public function applicant()
    {
        $applicants = collect([
            (object)['id'=>1,'nama'=>'Andi Saputra','email'=>'andi@gmail.com','telepon'=>'081234567890','posisi'=>'Software Developer','tanggal Lamar'=>'2024-02-15','status'=>'dalam_review','pengalaman'=>'3 tahun'],
            (object)['id'=>2,'nama'=>'Rina Wijaya','email'=>'rina@gmail.com','telepon'=>'081234567891','posisi'=>'HR Staff','tanggal Lamar'=>'2024-02-18','status'=>'diterima','pengalaman'=>'2 tahun'],
            (object)['id'=>3,'nama'=>'Dimas Prayoga','email'=>'dimas@gmail.com','telepon'=>'081234567892','posisi'=>'Accounting Staff','tanggal Lamar'=>'2024-02-20','status'=>'interview','pengalaman'=>'1 tahun'],
            (object)['id'=>4,'nama'=>'Sari Dewi','email'=>'sari@gmail.com','telepon'=>'081234567893','posisi'=>'Marketing Executive','tanggal Lamar'=>'2024-02-22','status'=>'ditolak','pengalaman'=>'4 tahun'],
            (object)['id'=>5,'nama'=>'Fajar Nugroho','email'=>'fajar@gmail.com','telepon'=>'081234567894','posisi'=>'Software Developer','tanggal Lamar'=>'2024-02-25','status'=>'psikotes','pengalaman'=>'2 tahun'],
            (object)['id'=>6,'nama'=>'Maya Putri','email'=>'maya@gmail.com','telepon'=>'081234567895','posisi'=>'Network Engineer','tanggal Lamar'=>'2024-02-28','status'=>'dalam_review','pengalaman'=>'5 tahun'],
        ]);

        return view('recruitment.applicant', compact('applicants'));
    }

    public function applicantStore(Request $request)
    {
        return redirect()->route('recruitment.applicant')->with('success', 'Pelamar berhasil ditambahkan');
    }

    public function applicantUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.applicant')->with('success', 'Data pelamar berhasil diupdate');
    }

    public function applicantDestroy($id)
    {
        return redirect()->route('recruitment.applicant')->with('success', 'Pelamar berhasil dihapus');
    }

    public function interview()
    {
        $interviews = collect([
            (object)['id'=>1,'nama'=>'Dimas Prayoga','posisi'=>'Accounting Staff','tanggal'=>'2024-03-10','jam'=>'09:00','ruangan'=>'Meeting Room 1','interviewer'=>'Hendra Kusuma','status'=>'terjadwal','nilai'=>85],
            (object)['id'=>2,'nama'=>'Andi Saputra','posisi'=>'Software Developer','tanggal'=>'2024-03-11','jam'=>'10:00','ruangan'=>'Meeting Room 2','interviewer'=>'Budi Santoso','status'=>'selesai','nilai'=>90],
            (object)['id'=>3,'nama'=>'Rina Wijaya','posisi'=>'HR Staff','tanggal'=>'2024-03-12','jam'=>'14:00','ruangan'=>'Meeting Room 1','interviewer'=>'Siti Rahayu','status'=>'selesai','nilai'=>88],
            (object)['id'=>4,'nama'=>'Fajar Nugroho','posisi'=>'Software Developer','tanggal'=>'2024-03-15','jam'=>'09:00','ruangan'=>'Meeting Room 3','interviewer'=>'Budi Santoso','status'=>'terjadwal','nilai'=>null],
            (object)['id'=>5,'nama'=>'Maya Putri','posisi'=>'Network Engineer','tanggal'=>'2024-03-16','jam'=>'13:00','ruangan'=>'Meeting Room 2','interviewer'=>'Rizky Pratama','status'=>'dijadwalkan','nilai'=>null],
        ]);

        return view('recruitment.interview', compact('interviews'));
    }

    public function interviewStore(Request $request)
    {
        return redirect()->route('recruitment.interview')->with('success', 'Interview berhasil ditambahkan');
    }

    public function interviewUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.interview')->with('success', 'Data interview berhasil diupdate');
    }

    public function interviewDestroy($id)
    {
        return redirect()->route('recruitment.interview')->with('success', 'Interview berhasil dihapus');
    }

    public function offering()
    {
        $offerings = collect([
            (object)['id'=>1,'nama'=>'Rina Wijaya','posisi'=>'HR Staff','gaji_offered'=>5500000,'tanggal_offering'=>'2024-03-05','tanggal_respon'=>'2024-03-08','status'=>'diterima'],
            (object)['id'=>2,'nama'=>'Andi Saputra','posisi'=>'Software Developer','gaji_offered'=>7000000,'tanggal_offering'=>'2024-03-08','tanggal_respon'=>'2024-03-12','status'=>'diterima'],
            (object)['id'=>3,'nama'=>'Hendra Kusuma','posisi'=>'Finance Manager','gaji_offered'=>15000000,'tanggal_offering'=>'2024-03-10','tanggal_respon'=>null,'status'=>'menunggu'],
            (object)['id'=>4,'nama'=>'Sari Dewi','posisi'=>'Marketing Executive','gaji_offered'=>6000000,'tanggal_offering'=>'2024-03-12','tanggal_respon'=>'2024-03-14','status'=>'ditolak'],
        ]);

        return view('recruitment.offering', compact('offerings'));
    }

    public function offeringStore(Request $request)
    {
        return redirect()->route('recruitment.offering')->with('success', 'Offering berhasil ditambahkan');
    }

    public function offeringUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.offering')->with('success', 'Data offering berhasil diupdate');
    }

    public function offeringDestroy($id)
    {
        return redirect()->route('recruitment.offering')->with('success', 'Offering berhasil dihapus');
    }

    public function psikotes()
    {
        $psikotes = collect([
            (object)['id'=>1,'nama'=>'Fajar Nugroho','posisi'=>'Software Developer','tanggal'=>'2024-03-05','nilai_kognitif'=>85,'nilai_personality'=>78,'nilai_integritas'=>82,'status'=>'lulus'],
            (object)['id'=>2,'nama'=>'Andi Saputra','posisi'=>'Software Developer','tanggal'=>'2024-03-05','nilai_kognitif'=>90,'nilai_personality'=>85,'nilai_integritas'=>88,'status'=>'lulus'],
            (object)['id'=>3,'nama'=>'Maya Putri','posisi'=>'Network Engineer','tanggal'=>'2024-03-08','nilai_kognitif'=>75,'nilai_personality'=>80,'nilai_integritas'=>77,'status'=>'proses'],
            (object)['id'=>4,'nama'=>'Dimas Prayoga','posisi'=>'Accounting Staff','tanggal'=>'2024-03-10','nilai_kognitif'=>null,'nilai_personality'=>null,'nilai_integritas'=>null,'status'=>'terjadwal'],
        ]);

        return view('recruitment.psikotes', compact('psikotes'));
    }

    public function psikotesStore(Request $request)
    {
        return redirect()->route('recruitment.psikotes')->with('success', 'Psikotes berhasil ditambahkan');
    }

    public function psikotesUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.psikotes')->with('success', 'Data psikotes berhasil diupdate');
    }

    public function psikotesDestroy($id)
    {
        return redirect()->route('recruitment.psikotes')->with('success', 'Psikotes berhasil dihapus');
    }

    public function hiring()
    {
        $hirings = collect([
            (object)['id'=>1,'nama'=>'Rina Wijaya','nik'=>'EMP-009','posisi'=>'HR Staff','departemen'=>'Recruitment','tanggal_masuk'=>'2024-04-01','status'=>'onboarding'],
            (object)['id'=>2,'nama'=>'Andi Saputra','nik'=>'EMP-010','posisi'=>'Software Developer','departemen'=>'Software Development','tanggal_masuk'=>'2024-04-01','status'=>'onboarding'],
            (object)['id'=>3,'nama'=>'Budi Santoso','nik'=>'EMP-001','posisi'=>'Staff Developer','departemen'=>'Software Development','tanggal_masuk'=>'2022-03-15','status'=>'aktif'],
            (object)['id'=>4,'nama'=>'Siti Rahayu','nik'=>'EMP-002','posisi'=>'HR Manager','departemen'=>'Recruitment','tanggal_masuk'=>'2021-01-10','status'=>'aktif'],
        ]);

        return view('recruitment.hiring', compact('hirings'));
    }

    public function hiringStore(Request $request)
    {
        return redirect()->route('recruitment.hiring')->with('success', 'Hiring berhasil ditambahkan');
    }

    public function hiringUpdate(Request $request, $id)
    {
        return redirect()->route('recruitment.hiring')->with('success', 'Data hiring berhasil diupdate');
    }

    public function hiringDestroy($id)
    {
        return redirect()->route('recruitment.hiring')->with('success', 'Hiring berhasil dihapus');
    }
}
