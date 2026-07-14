<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $penilaians = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jabatan'=>'Staff Developer','periode'=>'Maret 2024','nilai_kerja'=>85,'nilai_sikap'=>90,'nilai_target'=>80,'total'=>85,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jabatan'=>'HR Manager','periode'=>'Maret 2024','nilai_kerja'=>92,'nilai_sikap'=>95,'nilai_target'=>88,'total'=>92,'grade'=>'A','status'=>'selesai'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jabatan'=>'Staff Accounting','periode'=>'Maret 2024','nilai_kerja'=>78,'nilai_sikap'=>82,'nilai_target'=>75,'total'=>78,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','jabatan'=>'Marketing Manager','periode'=>'Maret 2024','nilai_kerja'=>88,'nilai_sikap'=>85,'nilai_target'=>90,'total'=>88,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>5,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','jabatan'=>'Finance Manager','periode'=>'Maret 2024','nilai_kerja'=>95,'nilai_sikap'=>92,'nilai_target'=>93,'total'=>93,'grade'=>'A','status'=>'selesai'],
        ]);

        return view('performance.index', compact('penilaians'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('performance.index')->with('success', 'Data penilaian berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('performance.index')->with('success', 'Data penilaian berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('performance.index')->with('success', 'Data penilaian berhasil dihapus');
    }

    public function kpi()
    {
        $kpis = collect([
            (object)['id'=>1,'kode'=>'KPI-001','nama'=>'Pencapaian Target Penjualan','deskripsi'=>'Mencapai target penjualan bulanan minimal 100%','bobot'=>30,'target'=>100,'satuan'=>'%','periode'=>'Maret 2024','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'KPI-002','nama'=>'Kualitas Pekerjaan','deskripsi'=>'Menjaga kualitas pekerjaan sesuai standar','bobot'=>25,'target'=>90,'satuan'=>'%','periode'=>'Maret 2024','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'KPI-003','nama'=>'Ketepatan Waktu','deskripsi'=>'Menyelesaikan pekerjaan tepat waktu','bobot'=>20,'target'=>95,'satuan'=>'%','periode'=>'Maret 2024','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'KPI-004','nama'=>'Efisiensi Biaya','deskripsi'=>'Mengoptimalkan pengeluaran biaya operasional','bobot'=>15,'target'=>85,'satuan'=>'%','periode'=>'Maret 2024','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'KPI-005','nama'=>'Kepuasan Pelanggan','deskripsi'=>'Mempertahankan kepuasan pelanggan minimal 90%','bobot'=>10,'target'=>90,'satuan'=>'%','periode'=>'Maret 2024','status'=>'aktif'],
        ]);

        return view('performance.kpi', compact('kpis'));
    }

    public function kpiStore(Request $request)
    {
        return redirect()->route('performance.kpi')->with('success', 'Data KPI berhasil ditambahkan');
    }

    public function kpiUpdate(Request $request, $id)
    {
        return redirect()->route('performance.kpi')->with('success', 'Data KPI berhasil diupdate');
    }

    public function kpiDestroy($id)
    {
        return redirect()->route('performance.kpi')->with('success', 'Data KPI berhasil dihapus');
    }

    public function assessment()
    {
        $assessments = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','assessor'=>'Hendra Kusuma','periode'=>'Maret 2024','tanggal'=>'2024-03-31','nilai'=>85,'komentar'=>'Kinerja sangat baik, perlu peningkatan di aspek komunikasi','status'=>'selesai'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','assessor'=>'Direktur HRD','periode'=>'Maret 2024','tanggal'=>'2024-03-31','nilai'=>92,'komentar'=>'Performa excellent, layak dipromosikan','status'=>'selesai'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','assessor'=>'Hendra Kusuma','periode'=>'Maret 2024','tanggal'=>'2024-03-31','nilai'=>78,'komentar'=>'Perlu peningkatan di aspek ketepatan waktu','status'=>'selesai'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','assessor'=>'Direktur Marketing','periode'=>'Maret 2024','tanggal'=>'2024-03-31','nilai'=>88,'komentar'=>'Strategi pemasaran sangat efektif','status'=>'selesai'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','assessor'=>'Budi Santoso','periode'=>'Maret 2024','tanggal'=>'2024-03-31','nilai'=>72,'komentar'=>'Masih perlu bimbingan di beberapa aspek teknis','status'=>'draft'],
        ]);

        return view('performance.assessment', compact('assessments'));
    }

    public function assessmentStore(Request $request)
    {
        return redirect()->route('performance.assessment')->with('success', 'Data assessment berhasil ditambahkan');
    }

    public function assessmentUpdate(Request $request, $id)
    {
        return redirect()->route('performance.assessment')->with('success', 'Data assessment berhasil diupdate');
    }

    public function assessmentDestroy($id)
    {
        return redirect()->route('performance.assessment')->with('success', 'Data assessment berhasil dihapus');
    }

    public function bulanan()
    {
        $bulanan = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','bulan'=>'Januari 2024','target_kerja'=>80,'realisasi_kerja'=>85,'persentase'=>106,'nilai'=>85,'status'=>'tercapai'],
            (object)['id'=>2,'nik'=>'EMP-001','nama'=>'Budi Santoso','bulan'=>'Februari 2024','target_kerja'=>80,'realisasi_kerja'=>82,'persentase'=>103,'nilai'=>82,'status'=>'tercapai'],
            (object)['id'=>3,'nik'=>'EMP-001','nama'=>'Budi Santoso','bulan'=>'Maret 2024','target_kerja'=>85,'realisasi_kerja'=>90,'persentase'=>106,'nilai'=>85,'status'=>'tercapai'],
            (object)['id'=>4,'nik'=>'EMP-002','nama'=>'Siti Rahayu','bulan'=>'Januari 2024','target_kerja'=>90,'realisasi_kerja'=>92,'persentase'=>102,'nilai'=>92,'status'=>'tercapai'],
            (object)['id'=>5,'nik'=>'EMP-002','nama'=>'Siti Rahayu','bulan'=>'Februari 2024','target_kerja'=>90,'realisasi_kerja'=>88,'persentase'=>98,'nilai'=>88,'status'=>'hampir_tercapai'],
            (object)['id'=>6,'nik'=>'EMP-002','nama'=>'Siti Rahayu','bulan'=>'Maret 2024','target_kerja'=>90,'realisasi_kerja'=>95,'persentase'=>106,'nilai'=>92,'status'=>'tercapai'],
        ]);

        return view('performance.bulanan', compact('bulanan'));
    }

    public function bulananStore(Request $request)
    {
        return redirect()->route('performance.bulanan')->with('success', 'Data penilaian bulanan berhasil ditambahkan');
    }

    public function bulananUpdate(Request $request, $id)
    {
        return redirect()->route('performance.bulanan')->with('success', 'Data penilaian bulanan berhasil diupdate');
    }

    public function bulananDestroy($id)
    {
        return redirect()->route('performance.bulanan')->with('success', 'Data penilaian bulanan berhasil dihapus');
    }

    public function tahunan()
    {
        $tahunan = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','tahun'=>2024,'avg_kerja'=>84,'avg_sikap'=>88,'avg_target'=>82,'total'=>85,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tahun'=>2024,'avg_kerja'=>91,'avg_sikap'=>93,'avg_target'=>89,'total'=>91,'grade'=>'A','status'=>'selesai'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tahun'=>2024,'avg_kerja'=>76,'avg_sikap'=>80,'avg_target'=>74,'total'=>77,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','tahun'=>2024,'avg_kerja'=>87,'avg_sikap'=>84,'avg_target'=>89,'total'=>87,'grade'=>'B','status'=>'selesai'],
            (object)['id'=>5,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','tahun'=>2024,'avg_kerja'=>94,'avg_sikap'=>91,'avg_target'=>92,'total'=>92,'grade'=>'A','status'=>'selesai'],
        ]);

        return view('performance.tahunan', compact('tahunan'));
    }

    public function tahunanStore(Request $request)
    {
        return redirect()->route('performance.tahunan')->with('success', 'Data penilaian tahunan berhasil ditambahkan');
    }

    public function tahunanUpdate(Request $request, $id)
    {
        return redirect()->route('performance.tahunan')->with('success', 'Data penilaian tahunan berhasil diupdate');
    }

    public function tahunanDestroy($id)
    {
        return redirect()->route('performance.tahunan')->with('success', 'Data penilaian tahunan berhasil dihapus');
    }

    public function target()
    {
        $targets = collect([
            (object)['id'=>1,'kode'=>'TGT-001','nama'=>'Target Penjualan Q1','deskripsi'=>'Target penjualan kuartal 1','nilai_target'=>500000000,'satuan'=>'Rupiah','periode'=>'Q1 2024','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'TGT-002','nama'=>'Target Customer Satisfaction','deskripsi'=>'Target kepuasan pelanggan','nilai_target'=>90,'satuan'=>'%','periode'=>'Q1 2024','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'TGT-003','nama'=>'Target Productivity','deskripsi'=>'Target produktivitas karyawan','nilai_target'=>95,'satuan'=>'%','periode'=>'Q1 2024','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'TGT-004','nama'=>'Target Quality Control','deskripsi'=>'Target kualitas produk','nilai_target'=>98,'satuan'=>'%','periode'=>'Q1 2024','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'TGT-005','nama'=>'Target Cost Efficiency','deskripsi'=>'Target efisiensi biaya','nilai_target'=>15,'satuan'=>'%','periode'=>'Q1 2024','status'=>'aktif'],
        ]);

        return view('performance.target', compact('targets'));
    }

    public function targetStore(Request $request)
    {
        return redirect()->route('performance.target')->with('success', 'Data target berhasil ditambahkan');
    }

    public function targetUpdate(Request $request, $id)
    {
        return redirect()->route('performance.target')->with('success', 'Data target berhasil diupdate');
    }

    public function targetDestroy($id)
    {
        return redirect()->route('performance.target')->with('success', 'Data target berhasil dihapus');
    }

    public function feedback()
    {
        $feedbacks = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','from'=>'Hendra Kusuma','tanggal'=>'2024-03-15','jenis'=>'positif','isi'=>'Kerja sangat baik dalam menyelesaikan proyek tepat waktu','status'=>'published'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','from'=>'Direktur HRD','tanggal'=>'2024-03-16','jenis'=>'positif','isi'=>'Pencapaian luar biasa dalam rekrutmen karyawan baru','status'=>'published'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','from'=>'Hendra Kusuma','tanggal'=>'2024-03-18','jenis'=>'saran','isi'=>'Perlu peningkatan koordinasi dengan tim lain','status'=>'published'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','from'=>'Direktur Marketing','tanggal'=>'2024-03-20','jenis'=>'positif','isi'=>'Strategi marketing sangat efektif meningkatkan penjualan','status'=>'draft'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','from'=>'Budi Santoso','tanggal'=>'2024-03-22','jenis'=>'saran','isi'=>'Perlu peningkatan skill di area tertentu','status'=>'draft'],
        ]);

        return view('performance.feedback', compact('feedbacks'));
    }

    public function feedbackStore(Request $request)
    {
        return redirect()->route('performance.feedback')->with('success', 'Data feedback berhasil ditambahkan');
    }

    public function feedbackUpdate(Request $request, $id)
    {
        return redirect()->route('performance.feedback')->with('success', 'Data feedback berhasil diupdate');
    }

    public function feedbackDestroy($id)
    {
        return redirect()->route('performance.feedback')->with('success', 'Data feedback berhasil dihapus');
    }
}
