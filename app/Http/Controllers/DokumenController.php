<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $documents = collect([
            (object)['id'=>1,'kode'=>'DOC-001','judul'=>'SOP Pengajuan Cuti','jenis'=>'SOP','kategori'=>'Kepegawaian','file'=>'sop_cuti.pdf','uploader'=>'HRD','tanggal'=>'2024-01-15','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'DOC-002','judul'=>'Kontrak Kerja Budi Santoso','jenis'=>'Kontrak','kategori'=>'Kepegawaian','file'=>'kontrak_budi.pdf','uploader'=>'HRD','tanggal'=>'2024-02-01','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'DOC-003','judul'=>'PKWT Siti Rahayu','jenis'=>'PKWT','kategori'=>'Kepegawaian','file'=>'pkwt_siti.pdf','uploader'=>'HRD','tanggal'=>'2024-03-01','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'DOC-004','judul'=>'NDA Andi Wijaya','jenis'=>'NDA','kategori'=>'Keamanan','file'=>'nda_andi.pdf','uploader'=>'IT Department','tanggal'=>'2024-02-15','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'DOC-005','judul'=>'Surat Peringatan Pertama','jenis'=>'Surat Peringatan','kategori'=>'Disiplin','file'=>'sp1_dewi.pdf','uploader'=>'Direktur HRD','tanggal'=>'2024-04-01','status'=>'aktif'],
        ]);

        return view('dokumen.index', compact('documents'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('dokumen.index')->with('success', 'Data dokumen berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.index')->with('success', 'Data dokumen berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('dokumen.index')->with('success', 'Data dokumen berhasil dihapus');
    }

    public function sop()
    {
        $sops = collect([
            (object)['id'=>1,'kode'=>'SOP-001','judul'=>'SOP Pengajuan Cuti','deskripsi'=>'Prosedur pengajuan cuti karyawan','versi'=>'1.0','tanggal_efektif'=>'2024-01-01','penanggung_jawab'=>'HRD','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'SOP-002','judul'=>'SOP Pengajuan Reimbursement','deskripsi'=>'Prosedur pengajuan reimbursement biaya','versi'=>'1.0','tanggal_efektif'=>'2024-01-01','penanggung_jawab'=>'Finance','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'SOP-003','judul'=>'SOP Lembur','deskripsi'=>'Prosedur pengajuan dan pelaporan lembur','versi'=>'1.0','tanggal_efektif'=>'2024-02-01','penanggung_jawab'=>'HRD','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'SOP-004','judul'=>'SOP Absensi','deskripsi'=>'Prosedur pencatatan kehadiran karyawan','versi'=>'1.0','tanggal_efektif'=>'2024-01-01','penanggung_jawab'=>'HRD','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'SOP-005','judul'=>'SOP Keamanan Data','deskripsi'=>'Prosedur pengamanan data perusahaan','versi'=>'1.0','tanggal_efektif'=>'2024-03-01','penanggung_jawab'=>'IT Department','status'=>'aktif'],
        ]);

        return view('dokumen.sop', compact('sops'));
    }

    public function sopStore(Request $request)
    {
        return redirect()->route('dokumen.sop')->with('success', 'Data SOP berhasil ditambahkan');
    }

    public function sopUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.sop')->with('success', 'Data SOP berhasil diupdate');
    }

    public function sopDestroy($id)
    {
        return redirect()->route('dokumen.sop')->with('success', 'Data SOP berhasil dihapus');
    }

    public function kontrak()
    {
        $contracts = collect([
            (object)['id'=>1,'kode'=>'KTR-001','nik'=>'EMP-001','nama'=>'Budi Santoso','jabatan'=>'Staff Marketing','tanggal_mulai'=>'2024-01-01','tanggal_akhir'=>'2025-12-31','durasi'=>'2 Tahun','jenis'=>'PKWT','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'KTR-002','nik'=>'EMP-002','nama'=>'Siti Rahayu','jabatan'=>'Supervisor HRD','tanggal_mulai'=>'2023-06-01','tanggal_akhir'=>'2026-05-31','durasi'=>'3 Tahun','jenis'=>'PKWTT','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'KTR-003','nik'=>'EMP-003','nama'=>'Andi Wijaya','jabatan'=>'Staff Finance','tanggal_mulai'=>'2024-03-01','tanggal_akhir'=>'2025-02-28','durasi'=>'1 Tahun','jenis'=>'PKWT','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'KTR-004','nik'=>'EMP-004','nama'=>'Dewi Lestari','jabatan'=>'Manager Marketing','tanggal_mulai'=>'2022-01-01','tanggal_akhir'=>'2024-12-31','durasi'=>'3 Tahun','jenis'=>'PKWTT','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'KTR-005','nik'=>'EMP-005','nama'=>'Rizky Pratama','jabatan'=>'Staff IT','tanggal_mulai'=>'2024-04-01','tanggal_akhir'=>'2025-03-31','durasi'=>'1 Tahun','jenis'=>'PKWT','status'=>'aktif'],
        ]);

        return view('dokumen.kontrak', compact('contracts'));
    }

    public function kontrakStore(Request $request)
    {
        return redirect()->route('dokumen.kontrak')->with('success', 'Data kontrak berhasil ditambahkan');
    }

    public function kontrakUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.kontrak')->with('success', 'Data kontrak berhasil diupdate');
    }

    public function kontrakDestroy($id)
    {
        return redirect()->route('dokumen.kontrak')->with('success', 'Data kontrak berhasil dihapus');
    }

    public function pkwt()
    {
        $pkwts = collect([
            (object)['id'=>1,'kode'=>'PKWT-001','nik'=>'EMP-001','nama'=>'Budi Santoso','jabatan'=>'Staff Marketing','tanggal_mulai'=>'2024-01-01','tanggal_akhir'=>'2025-12-31','durasi'=>'2 Tahun','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'PKWT-002','nik'=>'EMP-003','nama'=>'Andi Wijaya','jabatan'=>'Staff Finance','tanggal_mulai'=>'2024-03-01','tanggal_akhir'=>'2025-02-28','durasi'=>'1 Tahun','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'PKWT-003','nik'=>'EMP-005','nama'=>'Rizky Pratama','jabatan'=>'Staff IT','tanggal_mulai'=>'2024-04-01','tanggal_akhir'=>'2025-03-31','durasi'=>'1 Tahun','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'PKWT-004','nik'=>'EMP-006','nama'=>'Hendra Kusuma','jabatan'=>'Staff HRD','tanggal_mulai'=>'2023-07-01','tanggal_akhir'=>'2024-06-30','durasi'=>'1 Tahun','status'=>'menunggu_perpanjangan'],
            (object)['id'=>5,'kode'=>'PKWT-005','nik'=>'EMP-007','nama'=>'Rina Wulandari','jabatan'=>'Staff Marketing','tanggal_mulai'=>'2023-09-01','tanggal_akhir'=>'2024-08-31','durasi'=>'1 Tahun','status'=>'aktif'],
        ]);

        return view('dokumen.pkwt', compact('pkwts'));
    }

    public function pkwtStore(Request $request)
    {
        return redirect()->route('dokumen.pkwt')->with('success', 'Data PKWT berhasil ditambahkan');
    }

    public function pkwtUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.pkwt')->with('success', 'Data PKWT berhasil diupdate');
    }

    public function pkwtDestroy($id)
    {
        return redirect()->route('dokumen.pkwt')->with('success', 'Data PKWT berhasil dihapus');
    }

    public function nda()
    {
        $ndas = collect([
            (object)['id'=>1,'kode'=>'NDA-001','nik'=>'EMP-003','nama'=>'Andi Wijaya','jabatan'=>'Staff Finance','tanggal_tandatangan'=>'2024-03-01','masa_berlaku'=>'3 Tahun','jenis'=>'Confidentiality','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'NDA-002','nik'=>'EMP-005','nama'=>'Rizky Pratama','jabatan'=>'Staff IT','tanggal_tandatangan'=>'2024-04-01','masa_berlaku'=>'5 Tahun','jenis'=>'Non-Disclosure','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'NDA-003','nik'=>'EMP-008','nama'=>'Budi Setiawan','jabatan'=>'Staff IT','tanggal_tandatangan'=>'2023-06-01','masa_berlaku'=>'3 Tahun','jenis'=>'Confidentiality','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'NDA-004','nik'=>'EMP-009','nama'=>'Sari Dewi','jabatan'=>'Staff Marketing','tanggal_tandatangan'=>'2024-01-15','masa_berlaku'=>'2 Tahun','jenis'=>'Non-Disclosure','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'NDA-005','nik'=>'EMP-010','nama'=>'Dodi Firmansyah','jabatan'=>'Staff HRD','tanggal_tandatangan'=>'2023-03-01','masa_berlaku'=>'3 Tahun','jenis'=>'Confidentiality','status'=>'kadaluarsa'],
        ]);

        return view('dokumen.nda', compact('ndas'));
    }

    public function ndaStore(Request $request)
    {
        return redirect()->route('dokumen.nda')->with('success', 'Data NDA berhasil ditambahkan');
    }

    public function ndaUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.nda')->with('success', 'Data NDA berhasil diupdate');
    }

    public function ndaDestroy($id)
    {
        return redirect()->route('dokumen.nda')->with('success', 'Data NDA berhasil dihapus');
    }

    public function suratPeringatan()
    {
        $warnings = collect([
            (object)['id'=>1,'kode'=>'SP-001','nik'=>'EMP-004','nama'=>'Dewi Lestari','jabatan'=>'Manager Marketing','jenis'=>'Surat Peringatan Pertama','tanggal'=>'2024-04-01','alasan'=>'Keterlambatan berulang kali','penerbit'=>'Direktur HRD','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'SP-002','nik'=>'EMP-006','nama'=>'Hendra Kusuma','jabatan'=>'Staff HRD','jenis'=>'Surat Peringatan Kedua','tanggal'=>'2024-03-15','alasan'=>'Tidak menyelesaikan tugas tepat waktu','penerbit'=>'HRD Manager','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'SP-003','nik'=>'EMP-007','nama'=>'Rina Wulandari','jabatan'=>'Staff Marketing','jenis'=>'Surat Peringatan Pertama','tanggal'=>'2024-02-20','alasan'=>'Tanpa izin meninggalkan kantor','penerbit'=>'Direktur HRD','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'SP-004','nik'=>'EMP-008','nama'=>'Budi Setiawan','jabatan'=>'Staff IT','jenis'=>'Surat Peringatan Ketiga','tanggal'=>'2024-01-10','alasan'=>'Pelanggaran keamanan data','penerbit'=>'Direktur HRD','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'SP-005','nik'=>'EMP-009','nama'=>'Sari Dewi','jabatan'=>'Staff Marketing','jenis'=>'Surat Peringatan Pertama','tanggal'=>'2024-03-01','alasan'=>'Ketidakhadiran tanpa keterangan','penerbit'=>'HRD Manager','status'=>'aktif'],
        ]);

        return view('dokumen.surat-peringatan', compact('warnings'));
    }

    public function suratPeringatanStore(Request $request)
    {
        return redirect()->route('dokumen.surat-peringatan')->with('success', 'Data surat peringatan berhasil ditambahkan');
    }

    public function suratPeringatanUpdate(Request $request, $id)
    {
        return redirect()->route('dokumen.surat-peringatan')->with('success', 'Data surat peringatan berhasil diupdate');
    }

    public function suratPeringatanDestroy($id)
    {
        return redirect()->route('dokumen.surat-peringatan')->with('success', 'Data surat peringatan berhasil dihapus');
    }
}
