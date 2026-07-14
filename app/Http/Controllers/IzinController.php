<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        $izins = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Izin','tanggal'=>'2024-03-05','jam_mulai'=>'08:00','jam_selesai'=>'12:00','keterangan'=>'Keperluan keluarga','status'=>'disetujui'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Sakit','tanggal'=>'2024-03-08','jam_mulai'=>'08:00','jam_selesai'=>'17:00','keterangan'=>'Demam tinggi','status'=>'disetujui'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jenis'=>'Izin','tanggal'=>'2024-03-12','jam_mulai'=>'13:00','jam_selesai'=>'17:00','keterangan'=>'Ke dokter gigi','status'=>'pending'],
            (object)['id'=>4,'nik'=>'EMP-005','nama'=>'Rizky Pratama','jenis'=>'Sakit','tanggal'=>'2024-03-15','jam_mulai'=>'08:00','jam_selesai'=>'17:00','keterangan'=>'Sakit perut','status'=>'pending'],
            (object)['id'=>5,'nik'=>'EMP-008','nama'=>'Maya Sari','jenis'=>'Izin','tanggal'=>'2024-03-18','jam_mulai'=>'08:00','jam_selesai'=>'10:00','keterangan'=>'Urusan bank','status'=>'ditolak'],
        ]);

        return view('izin.index', compact('izins'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('izin.index')->with('success', 'Pengajuan izin berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('izin.index')->with('success', 'Data izin berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('izin.index')->with('success', 'Data izin berhasil dihapus');
    }

    public function suratDokter()
    {
        $surats = collect([
            (object)['id'=>1,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal'=>'2024-03-08','nama_dokter'=>'Dr. Andi','rumah_sakit'=>'RS Sehat','diagnosa'=>'Demam','file'=>'siti_surat.pdf','status'=>'verified'],
            (object)['id'=>2,'nik'=>'EMP-005','nama'=>'Rizky Pratama','tanggal'=>'2024-03-15','nama_dokter'=>'Dr. Maya','rumah_sakit'=>'RS Prima','diagnosa'=>'Sakit perut','file'=>'rizky_surat.pdf','status'=>'pending'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-20','nama_dokter'=>'Dr. Budi','rumah_sakit'=>'RS Mitra','diagnosa'=>'Flu','file'=>'andi_surat.pdf','status'=>'verified'],
        ]);

        return view('izin.surat-dokter', compact('surats'));
    }

    public function suratDokterStore(Request $request)
    {
        return redirect()->route('izin.surat-dokter')->with('success', 'Surat dokter berhasil ditambahkan');
    }

    public function suratDokterUpdate(Request $request, $id)
    {
        return redirect()->route('izin.surat-dokter')->with('success', 'Data surat dokter berhasil diupdate');
    }

    public function suratDokterDestroy($id)
    {
        return redirect()->route('izin.surat-dokter')->with('success', 'Surat dokter berhasil dihapus');
    }

    public function approval()
    {
        $approvals = collect([
            (object)['id'=>1,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jenis'=>'Izin','tanggal'=>'2024-03-12','jam_mulai'=>'13:00','jam_selesai'=>'17:00','keterangan'=>'Ke dokter gigi','status'=>'pending'],
            (object)['id'=>2,'nik'=>'EMP-005','nama'=>'Rizky Pratama','jenis'=>'Sakit','tanggal'=>'2024-03-15','jam_mulai'=>'08:00','jam_selesai'=>'17:00','keterangan'=>'Sakit perut','status'=>'pending'],
        ]);

        return view('izin.approval', compact('approvals'));
    }

    public function approvalStore(Request $request)
    {
        return redirect()->route('izin.approval')->with('success', 'Keputusan approval berhasil disimpan');
    }

    public function history()
    {
        $histories = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Izin','tanggal'=>'2024-02-15','jam_mulai'=>'08:00','jam_selesai'=>'12:00','keterangan'=>'Keperluan keluarga','status'=>'disetujui'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Sakit','tanggal'=>'2024-02-20','jam_mulai'=>'08:00','jam_selesai'=>'17:00','keterangan'=>'Demam','status'=>'disetujui'],
            (object)['id'=>3,'nik'=>'EMP-001','nama'=>'Budi Santoso','jenis'=>'Izin','tanggal'=>'2024-03-05','jam_mulai'=>'08:00','jam_selesai'=>'12:00','keterangan'=>'Keperluan keluarga','status'=>'disetujui'],
            (object)['id'=>4,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jenis'=>'Sakit','tanggal'=>'2024-03-08','jam_mulai'=>'08:00','jam_selesai'=>'17:00','keterangan'=>'Demam tinggi','status'=>'disetujui'],
            (object)['id'=>5,'nik'=>'EMP-008','nama'=>'Maya Sari','jenis'=>'Izin','tanggal'=>'2024-03-18','jam_mulai'=>'08:00','jam_selesai'=>'10:00','keterangan'=>'Urusan bank','status'=>'ditolak'],
        ]);

        return view('izin.history', compact('histories'));
    }
}
