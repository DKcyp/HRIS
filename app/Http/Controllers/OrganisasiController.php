<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function division()
    {
        $divisions = collect([
            (object)['id'=>1,'kode'=>'DIV-001','nama'=>'Information Technology','deskripsi'=>'Divisi yang mengelola seluruh infrastruktur dan pengembangan teknologi informasi','jumlah_karyawan'=>12,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'DIV-002','nama'=>'Human Resource Development','deskripsi'=>'Divisi yang mengelola sumber daya manusia dan pengembangan SDM','jumlah_karyawan'=>8,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'DIV-003','nama'=>'Finance & Accounting','deskripsi'=>'Divisi yang mengelola keuangan dan akuntansi perusahaan','jumlah_karyawan'=>10,'status'=>'aktif'],
            (object)['id'=>4,'kode'=>'DIV-004','nama'=>'Marketing','deskripsi'=>'Divisi yang mengelola pemasaran dan promosi produk','jumlah_karyawan'=>15,'status'=>'aktif'],
            (object)['id'=>5,'kode'=>'DIV-005','nama'=>'Operations','deskripsi'=>'Divisi yang mengelola operasional harian perusahaan','jumlah_karyawan'=>20,'status'=>'aktif'],
            (object)['id'=>6,'kode'=>'DIV-006','nama'=>'Legal & Compliance','deskripsi'=>'Divisi yang mengelola aspek hukum dan kepatuhan','jumlah_karyawan'=>5,'status'=>'aktif'],
        ]);

        return view('organisasi.division', compact('divisions'));
    }

    public function divisionStore(Request $request)
    {
        return redirect()->route('organisasi.division')->with('success', 'Data divisi berhasil ditambahkan');
    }

    public function divisionUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.division')->with('success', 'Data divisi berhasil diupdate');
    }

    public function divisionDestroy($id)
    {
        return redirect()->route('organisasi.division')->with('success', 'Data divisi berhasil dihapus');
    }

    public function department()
    {
        $departments = collect([
            (object)['id'=>1,'kode'=>'DEPT-001','nama'=>'Software Development','divisi'=>'Information Technology','kepala'=>'Budi Santoso','jumlah_karyawan'=>8,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'DEPT-002','nama'=>'Infrastructure','divisi'=>'Information Technology','kepala'=>'Rizky Pratama','jumlah_karyawan'=>4,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'DEPT-003','nama'=>'Recruitment','divisi'=>'Human Resource Development','kepala'=>'Putri Amelia','jumlah_karyawan'=>4,'status'=>'aktif'],
            (object)['id'=>4,'kode'=>'DEPT-004','nama'=>'Training & Development','divisi'=>'Human Resource Development','kepala'=>'Siti Rahayu','jumlah_karyawan'=>4,'status'=>'aktif'],
            (object)['id'=>5,'kode'=>'DEPT-005','nama'=>'Accounting','divisi'=>'Finance & Accounting','kepala'=>'Hendra Kusuma','jumlah_karyawan'=>5,'status'=>'aktif'],
            (object)['id'=>6,'kode'=>'DEPT-006','nama'=>'Tax & Treasury','divisi'=>'Finance & Accounting','kepala'=>'Andi Wijaya','jumlah_karyawan'=>5,'status'=>'aktif'],
            (object)['id'=>7,'kode'=>'DEPT-007','nama'=>'Digital Marketing','divisi'=>'Marketing','kepala'=>'Dewi Lestari','jumlah_karyawan'=>8,'status'=>'aktif'],
            (object)['id'=>8,'kode'=>'DEPT-008','nama'=>'Brand Management','divisi'=>'Marketing','kepala'=>'Maya Sari','jumlah_karyawan'=>7,'status'=>'aktif'],
        ]);

        return view('organisasi.department', compact('departments'));
    }

    public function departmentStore(Request $request)
    {
        return redirect()->route('organisasi.department')->with('success', 'Data departemen berhasil ditambahkan');
    }

    public function departmentUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.department')->with('success', 'Data departemen berhasil diupdate');
    }

    public function departmentDestroy($id)
    {
        return redirect()->route('organisasi.department')->with('success', 'Data departemen berhasil dihapus');
    }

    public function position()
    {
        $positions = collect([
            (object)['id'=>1,'kode'=>'POS-001','nama'=>'Chief Technology Officer','level'=>'C-Level','deskripsi'=>'Penanggung jawab seluruh strategi dan operasional teknologi perusahaan','jumlah_karyawan'=>1,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'POS-002','nama'=>'IT Manager','level'=>'Manager','deskripsi'=>'Mengelola tim dan operasional departemen IT','jumlah_karyawan'=>2,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'POS-003','nama'=>'Senior Developer','level'=>'Senior','deskripsi'=>'Developer senior yang bertanggung jawab atas arsitektur dan kode','jumlah_karyawan'=>3,'status'=>'aktif'],
            (object)['id'=>4,'kode'=>'POS-004','nama'=>'Staff Developer','level'=>'Staff','deskripsi'=>'Developer yang bertanggung jawab atas pengembangan fitur','jumlah_karyawan'=>5,'status'=>'aktif'],
            (object)['id'=>5,'kode'=>'POS-005','nama'=>'HR Manager','level'=>'Manager','deskripsi'=>'Mengelola seluruh operasional sumber daya manusia','jumlah_karyawan'=>1,'status'=>'aktif'],
            (object)['id'=>6,'kode'=>'POS-006','nama'=>'HR Staff','level'=>'Staff','deskripsi'=>'Staff yang menangani administrasi dan operasional HRD','jumlah_karyawan'=>4,'status'=>'aktif'],
            (object)['id'=>7,'kode'=>'POS-007','nama'=>'Finance Manager','level'=>'Manager','deskripsi'=>'Mengelola operasional keuangan dan akuntansi','jumlah_karyawan'=>1,'status'=>'aktif'],
            (object)['id'=>8,'kode'=>'POS-008','nama'=>'Accounting Staff','level'=>'Staff','deskripsi'=>'Staff yang menangani pencatatan dan pelaporan akuntansi','jumlah_karyawan'=>5,'status'=>'aktif'],
            (object)['id'=>9,'kode'=>'POS-009','nama'=>'Marketing Manager','level'=>'Manager','deskripsi'=>'Mengelola strategi dan operasional pemasaran','jumlah_karyawan'=>1,'status'=>'aktif'],
            (object)['id'=>10,'kode'=>'POS-010','nama'=>'Marketing Staff','level'=>'Staff','deskripsi'=>'Staff yang menangani eksekusi kegiatan pemasaran','jumlah_karyawan'=>8,'status'=>'aktif'],
        ]);

        return view('organisasi.position', compact('positions'));
    }

    public function positionStore(Request $request)
    {
        return redirect()->route('organisasi.position')->with('success', 'Data jabatan berhasil ditambahkan');
    }

    public function positionUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.position')->with('success', 'Data jabatan berhasil diupdate');
    }

    public function positionDestroy($id)
    {
        return redirect()->route('organisasi.position')->with('success', 'Data jabatan berhasil dihapus');
    }

    public function grade()
    {
        $grades = collect([
            (object)['id'=>1,'kode'=>'GRD-001','nama'=>'Grade 1','min_gaji'=>4000000,'max_gaji'=>6000000,'deskripsi'=>'Entry level untuk staff junior','jumlah_karyawan'=>15,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'GRD-002','nama'=>'Grade 2','min_gaji'=>6000000,'max_gaji'=>8000000,'deskripsi'=>'Level staff dengan pengalaman 2-3 tahun','jumlah_karyawan'=>20,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'GRD-003','nama'=>'Grade 3','min_gaji'=>8000000,'max_gaji'=>11000000,'deskripsi'=>'Level senior staff dengan pengalaman 4-5 tahun','jumlah_karyawan'=>12,'status'=>'aktif'],
            (object)['id'=>4,'kode'=>'GRD-004','nama'=>'Grade 4','min_gaji'=>11000000,'max_gaji'=>15000000,'deskripsi'=>'Level supervisor atau team lead','jumlah_karyawan'=>8,'status'=>'aktif'],
            (object)['id'=>5,'kode'=>'GRD-005','nama'=>'Grade 5','min_gaji'=>15000000,'max_gaji'=>20000000,'deskripsi'=>'Level manager','jumlah_karyawan'=>5,'status'=>'aktif'],
            (object)['id'=>6,'kode'=>'GRD-006','nama'=>'Grade 6','min_gaji'=>20000000,'max_gaji'=>30000000,'deskripsi'=>'Level senior manager atau director','jumlah_karyawan'=>3,'status'=>'aktif'],
            (object)['id'=>7,'kode'=>'GRD-007','nama'=>'Grade 7','min_gaji'=>30000000,'max_gaji'=>50000000,'deskripsi'=>'Level VP atau C-Level','jumlah_karyawan'=>2,'status'=>'aktif'],
        ]);

        return view('organisasi.grade', compact('grades'));
    }

    public function gradeStore(Request $request)
    {
        return redirect()->route('organisasi.grade')->with('success', 'Data grade berhasil ditambahkan');
    }

    public function gradeUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.grade')->with('success', 'Data grade berhasil diupdate');
    }

    public function gradeDestroy($id)
    {
        return redirect()->route('organisasi.grade')->with('success', 'Data grade berhasil dihapus');
    }

    public function location()
    {
        $locations = collect([
            (object)['id'=>1,'kode'=>'LOC-001','nama'=>'Kantor Pusat Jakarta','alamat'=>'Jl. Sudirman No. 123, Jakarta Selatan','kota'=>'Jakarta','kode_pos'=>'12190','telepon'=>'(021) 12345678','jumlah_karyawan'=>50,'status'=>'aktif'],
            (object)['id'=>2,'kode'=>'LOC-002','nama'=>'Kantor Cabang Bandung','alamat'=>'Jl. Asia Afrika No. 45, Bandung','kota'=>'Bandung','kode_pos'=>'40111','telepon'=>'(022) 87654321','jumlah_karyawan'=>20,'status'=>'aktif'],
            (object)['id'=>3,'kode'=>'LOC-003','nama'=>'Kantor Cabang Surabaya','alamat'=>'Jl. Pemuda No. 67, Surabaya','kota'=>'Surabaya','kode_pos'=>'60275','telepon'=>'(031) 11223344','jumlah_karyawan'=>15,'status'=>'aktif'],
            (object)['id'=>4,'kode'=>'LOC-004','nama'=>'Kantor Cabang Yogyakarta','alamat'=>'Jl. Malioboro No. 89, Yogyakarta','kota'=>'Yogyakarta','kode_pos'=>'55211','telepon'=>'(0274) 55667788','jumlah_karyawan'=>10,'status'=>'aktif'],
            (object)['id'=>5,'kode'=>'LOC-005','nama'=>'Gudang Sentral','alamat'=>'Jl. Raya Bekasi Km. 20, Jakarta Timur','kota'=>'Jakarta','kode_pos'=>'13910','telepon'=>'(021) 99887766','jumlah_karyawan'=>8,'status'=>'aktif'],
        ]);

        return view('organisasi.location', compact('locations'));
    }

    public function locationStore(Request $request)
    {
        return redirect()->route('organisasi.location')->with('success', 'Data lokasi berhasil ditambahkan');
    }

    public function locationUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.location')->with('success', 'Data lokasi berhasil diupdate');
    }

    public function locationDestroy($id)
    {
        return redirect()->route('organisasi.location')->with('success', 'Data lokasi berhasil dihapus');
    }

    public function shift()
    {
        $shifts = collect([
            (object)['id'=>1,'kode'=>'SFT-001','nama'=>'Shift Pagi','jam_mulai'=>'08:00','jam_selesai'=>'17:00','jam_istirahat'=>'12:00 - 13:00','total_jam'=>8,'keterangan'=>'Jam kerja standar','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'SFT-002','nama'=>'Shift Siang','jam_mulai'=>'12:00','jam_selesai'=>'21:00','jam_istirahat'=>'16:00 - 17:00','total_jam'=>8,'keterangan'=>'Untuk operasional siang/malam','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'SFT-003','nama'=>'Shift Malam','jam_mulai'=>'21:00','jam_selesai'=>'06:00','jam_istirahat'=>'01:00 - 02:00','total_jam'=>8,'keterangan'=>'Untuk operasional 24 jam','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'SFT-004','nama'=>'Shift Fleksibel','jam_mulai'=>'07:00','jam_selesai'=>'16:00','jam_istirahat'=>'11:00 - 12:00','total_jam'=>8,'keterangan'=>'Jam kerja fleksibel dengan toleransi ±1 jam','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'SFT-005','nama'=>'Shift Weekend','jam_mulai'=>'08:00','jam_selesai'=>'17:00','jam_istirahat'=>'12:00 - 13:00','total_jam'=>8,'keterangan'=>'Untuk operasional hari Sabtu & Minggu','status'=>'aktif'],
            (object)['id'=>6,'kode'=>'SFT-006','nama'=>'Shift Parsial','jam_mulai'=>'08:00','jam_selesai'=>'13:00','jam_istirahat'=>'-','total_jam'=>5,'keterangan'=>'Untuk karyawan paruh waktu','status'=>'aktif'],
        ]);

        return view('organisasi.shift', compact('shifts'));
    }

    public function shiftStore(Request $request)
    {
        return redirect()->route('organisasi.shift')->with('success', 'Data shift berhasil ditambahkan');
    }

    public function shiftUpdate(Request $request, $id)
    {
        return redirect()->route('organisasi.shift')->with('success', 'Data shift berhasil diupdate');
    }

    public function shiftDestroy($id)
    {
        return redirect()->route('organisasi.shift')->with('success', 'Data shift berhasil dihapus');
    }
}
