<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResignController extends Controller
{
    public function index()
    {
        $resigns = collect([
            (object)['id'=>1,'nik'=>'EMP-010','nama'=>'Dodi Firmansyah','jabatan'=>'Staff HRD','divisi'=>'HRD','tanggal_pengajuan'=>'2024-03-15','tanggal_terakhir'=>'2024-04-15','alasan'=>'Mendapatkan pekerjaan baru','status'=>'disetujui','approval'=>'Direktur HRD'],
            (object)['id'=>2,'nik'=>'EMP-011','nama'=>'Maya Putri','jabatan'=>'Staff Marketing','divisi'=>'Marketing','tanggal_pengajuan'=>'2024-04-01','tanggal_terakhir'=>'2024-05-01','alasan'=>'Pindah domisili','status'=>'pending','approval'=>'Menunggu'],
            (object)['id'=>3,'nik'=>'EMP-012','nama'=>'Fajar Nugroho','jabatan'=>'Staff IT','divisi'=>'IT','tanggal_pengajuan'=>'2024-03-20','tanggal_terakhir'=>'2024-04-20','alasan'=>'Melanjutkan pendidikan','status'=>'disetujui','approval'=>'IT Manager'],
            (object)['id'=>4,'nik'=>'EMP-013','nama'=>'Lina Marlina','jabatan'=>'Staff Finance','divisi'=>'Finance','tanggal_pengajuan'=>'2024-04-05','tanggal_terakhir'=>'2024-05-05','alasan'=>'Alasan keluarga','status'=>'pending','approval'=>'Menunggu'],
            (object)['id'=>5,'nik'=>'EMP-014','nama'=>'Rio Saputra','jabatan'=>'Staff Marketing','divisi'=>'Marketing','tanggal_pengajuan'=>'2024-02-01','tanggal_terakhir'=>'2024-03-01','alasan'=>'Kepentingan pribadi','status'=>'ditolak','approval'=>'Direktur Marketing'],
        ]);

        return view('resign.index', compact('resigns'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('resign.index')->with('success', 'Data pengajuan resign berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('resign.index')->with('success', 'Data pengajuan resign berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('resign.index')->with('success', 'Data pengajuan resign berhasil dihapus');
    }

    public function exitInterview()
    {
        $interviews = collect([
            (object)['id'=>1,'nik'=>'EMP-010','nama'=>'Dodi Firmansyah','jabatan'=>'Staff HRD','tanggal_exit'=>'2024-04-15',' interviewer'=>'Hendra Kusuma','hasil'=>'Puas dengan pekerjaan, alasan resign untuk pengembangan karir','rekomendasi'=>'Perlu perbaikan komunikasi antar divisi','status'=>'selesai'],
            (object)['id'=>2,'nik'=>'EMP-012','nama'=>'Fajar Nugroho','jabatan'=>'Staff IT','tanggal_exit'=>'2024-04-20','interviewer'=>'Budi Setiawan','hasil'=>'Puas dengan lingkungan kerja','rekomendasi'=>'Tingkatkan program mentoring','status'=>'selesai'],
            (object)['id'=>3,'nik'=>'EMP-015','nama'=>'Agus Setiawan','jabatan'=>'Staff Finance','tanggal_exit'=>'2024-03-15','interviewer'=>'Rina Wulandari','hasil'=>'Kurang puas dengan sistem yang ada','rekomendasi'=>'Perlu pembaruan sistem','status'=>'selesai'],
            (object)['id'=>4,'nik'=>'EMP-016','nama'=>'Sinta Permata','jabatan'=>'Staff Marketing','tanggal_exit'=>'2024-04-25','interviewer'=>'Dewi Lestari','hasil'=>'Belum diwawancarai','rekomendasi'=>'-','status'=>'belum'],
            (object)['id'=>5,'nik'=>'EMP-017','nama'=>'Yoga Pratama','jabatan'=>'Staff HRD','tanggal_exit'=>'2024-05-01','interviewer'=>'Hendra Kusuma','hasil'=>'Belum diwawancarai','rekomendasi'=>'-','status'=>'belum'],
        ]);

        return view('resign.exit-interview', compact('interviews'));
    }

    public function exitInterviewStore(Request $request)
    {
        return redirect()->route('resign.exit-interview')->with('success', 'Data exit interview berhasil ditambahkan');
    }

    public function exitInterviewUpdate(Request $request, $id)
    {
        return redirect()->route('resign.exit-interview')->with('success', 'Data exit interview berhasil diupdate');
    }

    public function exitInterviewDestroy($id)
    {
        return redirect()->route('resign.exit-interview')->with('success', 'Data exit interview berhasil dihapus');
    }

    public function clearance()
    {
        $clearances = collect([
            (object)['id'=>1,'nik'=>'EMP-010','nama'=>'Dodi Firmansyah','jabatan'=>'Staff HRD','divisi'=>'HRD','tanggal_clearance'=>'2024-04-15','it_clean'=>'Ya','finance_clean'=>'Ya','hrd_clean'=>'Ya','office_clean'=>'Ya','status'=>'lengkap'],
            (object)['id'=>2,'nik'=>'EMP-012','nama'=>'Fajar Nugroho','jabatan'=>'Staff IT','divisi'=>'IT','tanggal_clearance'=>'2024-04-20','it_clean'=>'Ya','finance_clean'=>'Ya','hrd_clean'=>'Belum','office_clean'=>'Ya','status'=>'belum_lengkap'],
            (object)['id'=>3,'nik'=>'EMP-015','nama'=>'Agus Setiawan','jabatan'=>'Staff Finance','divisi'=>'Finance','tanggal_clearance'=>'2024-03-15','it_clean'=>'Ya','finance_clean'=>'Ya','hrd_clean'=>'Ya','office_clean'=>'Ya','status'=>'lengkap'],
            (object)['id'=>4,'nik'=>'EMP-016','nama'=>'Sinta Permata','jabatan'=>'Staff Marketing','divisi'=>'Marketing','tanggal_clearance'=>'2024-04-25','it_clean'=>'Belum','finance_clean'=>'Belum','hrd_clean'=>'Belum','office_clean'=>'Belum','status'=>'belum_lengkap'],
            (object)['id'=>5,'nik'=>'EMP-017','nama'=>'Yoga Pratama','jabatan'=>'Staff HRD','divisi'=>'HRD','tanggal_clearance'=>'2024-05-01','it_clean'=>'Belum','finance_clean'=>'Belum','hrd_clean'=>'Belum','office_clean'=>'Belum','status'=>'belum_lengkap'],
        ]);

        return view('resign.clearance', compact('clearances'));
    }

    public function clearanceStore(Request $request)
    {
        return redirect()->route('resign.clearance')->with('success', 'Data clearance berhasil ditambahkan');
    }

    public function clearanceUpdate(Request $request, $id)
    {
        return redirect()->route('resign.clearance')->with('success', 'Data clearance berhasil diupdate');
    }

    public function clearanceDestroy($id)
    {
        return redirect()->route('resign.clearance')->with('success', 'Data clearance berhasil dihapus');
    }

    public function pengembalianAsset()
    {
        $returns = collect([
            (object)['id'=>1,'nik'=>'EMP-010','nama'=>'Dodi Firmansyah','jabatan'=>'Staff HRD','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-001','tanggal_kembali'=>'2024-04-15','kondisi_kembali'=>'baik','keterangan'=>'Tidak ada kerusakan','status'=>'diterima'],
            (object)['id'=>2,'nik'=>'EMP-012','nama'=>'Fajar Nugroho','jabatan'=>'Staff IT','asset'=>'Laptop Dell Inspiron','kode_asset'=>'AST-006','tanggal_kembali'=>'2024-04-20','kondisi_kembali'=>'baik','keterangan'=>'Normal','status'=>'diterima'],
            (object)['id'=>3,'nik'=>'EMP-015','nama'=>'Agus Setiawan','jabatan'=>'Staff Finance','asset'=>'Printer HP LaserJet','kode_asset'=>'AST-002','tanggal_kembali'=>'2024-03-15','kondisi_kembali'=>'baik','keterangan'=>'Sesuai kondisi','status'=>'diterima'],
            (object)['id'=>4,'nik'=>'EMP-016','nama'=>'Sinta Permata','jabatan'=>'Staff Marketing','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-007','tanggal_kembali'=>'2024-04-25','kondisi_kembali'=>'rusak_ringan','keterangan'=>'Goresan pada layar','status'=>'pending'],
            (object)['id'=>5,'nik'=>'EMP-017','nama'=>'Yoga Pratama','jabatan'=>'Staff HRD','asset'=>'Kursi Ergonomis','kode_asset'=>'AST-004','tanggal_kembali'=>'2024-05-01','kondisi_kembali'=>'baik','keterangan'=>'Normal','status'=>'pending'],
        ]);

        return view('resign.pengembalian-asset', compact('returns'));
    }

    public function pengembalianAssetStore(Request $request)
    {
        return redirect()->route('resign.pengembalian-asset')->with('success', 'Data pengembalian asset berhasil ditambahkan');
    }

    public function pengembalianAssetUpdate(Request $request, $id)
    {
        return redirect()->route('resign.pengembalian-asset')->with('success', 'Data pengembalian asset berhasil diupdate');
    }

    public function pengembalianAssetDestroy($id)
    {
        return redirect()->route('resign.pengembalian-asset')->with('success', 'Data pengembalian asset berhasil dihapus');
    }
}
