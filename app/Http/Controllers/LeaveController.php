<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-10','tanggal_selesai'=>'2024-03-12','hari'=>3,'keterangan'=>'Libur keluarga','status'=>'disetujui'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Cuti Sakit','tanggal_mulai'=>'2024-03-05','tanggal_selesai'=>'2024-03-05','hari'=>1,'keterangan'=>'Demam','status'=>'disetujui'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-15','tanggal_selesai'=>'2024-03-16','hari'=>2,'keterangan'=>'Urusan pribadi','status'=>'pending'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','jenis'=>'Cuti Melahirkan','tanggal_mulai'=>'2024-04-01','tanggal_selesai'=>'2024-06-30','hari'=>90,'keterangan'=>'Cuti melahirkan','status'=>'disetujui'],
            (object)['id'=>5,'nik'=>'EMP-006','nama'=>'Putri Amelia','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-20','tanggal_selesai'=>'2024-03-20','hari'=>1,'keterangan'=>'Keperluan dokter','status'=>'ditolak'],
        ]);

        return view('leave.index', compact('leaves'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('leave.index')->with('success', 'Pengajuan cuti berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('leave.index')->with('success', 'Data cuti berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('leave.index')->with('success', 'Data cuti berhasil dihapus');
    }

    public function approval()
    {
        $approvals = collect([
            (object)['id'=>1,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-15','tanggal_selesai'=>'2024-03-16','hari'=>2,'keterangan'=>'Urusan pribadi','status'=>'pending'],
            (object)['id'=>2,'nik'=>'EMP-006','nama'=>'Putri Amelia','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-20','tanggal_selesai'=>'2024-03-20','hari'=>1,'keterangan'=>'Keperluan dokter','status'=>'pending'],
            (object)['id'=>3,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-25','tanggal_selesai'=>'2024-03-26','hari'=>2,'keterangan'=>'Liburan','status'=>'pending'],
        ]);

        return view('leave.approval', compact('approvals'));
    }

    public function approvalStore(Request $request)
    {
        return redirect()->route('leave.approval')->with('success', 'Keputusan approval berhasil disimpan');
    }

    public function jenis()
    {
        $jenis = collect([
            (object)['id'=>1,'kode'=>'CUT-001','nama'=>'Cuti Tahunan','jumlah_hari'=>12,'deskripsi'=>'Cuti tahunan yang diberikan kepada karyawan aktif','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'CUT-002','nama'=>'Cuti Sakit','jumlah_hari'=>0,'deskripsi'=>'Cuti karena sakit dengan surat dokter','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'CUT-003','nama'=>'Cuti Melahirkan','jumlah_hari'=>90,'deskripsi'=>'Cuti untuk karyawan yang melahirkan','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'CUT-004','nama'=>'Cuti Menikah','jumlah_hari'=>3,'deskripsi'=>'Cuti untuk karyawan yang menikah','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'CUT-005','nama'=>'Cuti Duka','jumlah_hari'=>2,'deskripsi'=>'Cuti karena duka cita keluarga','status'=>'aktif'],
            (object)['id'=>6,'kode'=>'CUT-006','nama'=>'Cuti Tanpa Gaji','jumlah_hari'=>0,'deskripsi'=>'Cuti tanpa pembayaran gaji','status'=>'aktif'],
        ]);

        return view('leave.jenis', compact('jenis'));
    }

    public function jenisStore(Request $request)
    {
        return redirect()->route('leave.jenis')->with('success', 'Jenis cuti berhasil ditambahkan');
    }

    public function jenisUpdate(Request $request, $id)
    {
        return redirect()->route('leave.jenis')->with('success', 'Jenis cuti berhasil diupdate');
    }

    public function jenisDestroy($id)
    {
        return redirect()->route('leave.jenis')->with('success', 'Jenis cuti berhasil dihapus');
    }

    public function sisa()
    {
        $sisa = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>5,'sisa'=>7],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>8,'sisa'=>4],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>3,'sisa'=>9],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>0,'sisa'=>12],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>6,'sisa'=>6],
            (object)['id'=>6,'nik'=>'EMP-006','nama'=>'Putri Amelia','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>2,'sisa'=>10],
            (object)['id'=>7,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>10,'sisa'=>2],
            (object)['id'=>8,'nik'=>'EMP-008','nama'=>'Maya Sari','jenis'=>'Cuti Tahunan','total'=>12,'terpakai'=>4,'sisa'=>8],
        ]);

        return view('leave.sisa', compact('sisa'));
    }

    public function history()
    {
        $histories = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-01-15','tanggal_selesai'=>'2024-01-16','hari'=>2,'keterangan'=>'Libur keluarga','status'=>'disetujui'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Cuti Sakit','tanggal_mulai'=>'2024-02-10','tanggal_selesai'=>'2024-02-10','hari'=>1,'keterangan'=>'Demam','status'=>'disetujui'],
            (object)['id'=>3,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-10','tanggal_selesai'=>'2024-03-12','hari'=>3,'keterangan'=>'Libur keluarga','status'=>'disetujui'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','jenis'=>'Cuti Melahirkan','tanggal_mulai'=>'2024-04-01','tanggal_selesai'=>'2024-06-30','hari'=>90,'keterangan'=>'Cuti melahirkan','status'=>'disetujui'],
            (object)['id'=>5,'nik'=>'EMP-006','nama'=>'Putri Amelia','jenis'=>'Cuti Tahunan','tanggal_mulai'=>'2024-03-20','tanggal_selesai'=>'2024-03-20','hari'=>1,'keterangan'=>'Keperluan dokter','status'=>'ditolak'],
        ]);

        return view('leave.history', compact('histories'));
    }
}
