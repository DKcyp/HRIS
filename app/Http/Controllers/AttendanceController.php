<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $rekap = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal'=>'2024-03-01','jam_masuk'=>'07:55','jam_keluar'=>'17:05','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-01','jam_masuk'=>'08:15','jam_keluar'=>'17:00','jam_kerja'=>8.75,'status'=>'terlambat','keterangan'=>'Terlambat 15 menit'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'19:00','jam_kerja'=>11,'status'=>'lembur','keterangan'=>'Lembur 2 jam'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','tanggal'=>'2024-03-01','jam_masuk'=>'-','jam_keluar'=>'-','jam_kerja'=>0,'status'=>'alpha','keterangan'=>'Tidak hadir'],
            (object)['id'=>6,'nik'=>'EMP-006','nama'=>'Putri Amelia','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>7,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>8,'nik'=>'EMP-008','nama'=>'Maya Sari','tanggal'=>'2024-03-01','jam_masuk'=>'09:00','jam_keluar'=>'17:00','jam_kerja'=>8,'status'=>'sakit','keterangan'=>'Surat dokter'],
        ]);

        return view('attendance.index', compact('rekap'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('attendance.index')->with('success', 'Data rekap absensi berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('attendance.index')->with('success', 'Data rekap absensi berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('attendance.index')->with('success', 'Data rekap absensi berhasil dihapus');
    }

    public function checkin()
    {
        $status = (object)[
            'nama'=>'Budi Santoso',
            'nik'=>'EMP-001',
            'tanggal'=>date('Y-m-d'),
            'jam_sekarang'=>date('H:i:s'),
            'jam_masuk'=>'08:00:00',
            'sudah_checkin'=>false,
            'jam_checkin'=>'07:55:00',
        ];

        return view('attendance.checkin', compact('status'));
    }

    public function storeCheckin(Request $request)
    {
        return redirect()->route('attendance.checkin')->with('success', 'Check-in berhasil dicatat');
    }

    public function overtime()
    {
        $lemburs = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal'=>'2024-03-01','jam_mulai'=>'17:00','jam_selesai'=>'19:00','durasi'=>2,'keterangan'=>'Debugging server','status'=>'disetujui'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal'=>'2024-03-01','jam_mulai'=>'17:00','jam_selesai'=>'20:00','durasi'=>3,'keterangan'=>'Rekrutmen kandidat','status'=>'disetujui'],
            (object)['id'=>3,'nik'=>'EMP-004','nama'=>'Dewi Lestari','tanggal'=>'2024-03-02','jam_mulai'=>'17:00','jam_selesai'=>'21:00','durasi'=>4,'keterangan'=>'Persiapan presentasi klien','status'=>'pending'],
            (object)['id'=>4,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','tanggal'=>'2024-03-02','jam_mulai'=>'17:00','jam_selesai'=>'18:30','durasi'=>1.5,'keterangan'=>'Closing laporan keuangan','status'=>'disetujui'],
            (object)['id'=>5,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-03','jam_mulai'=>'17:00','jam_selesai'=>'19:00','durasi'=>2,'keterangan'=>'Audit internal','status'=>'ditolak'],
        ]);

        return view('attendance.overtime', compact('lemburs'));
    }

    public function overtimeStore(Request $request)
    {
        return redirect()->route('attendance.overtime')->with('success', 'Data lembur berhasil ditambahkan');
    }

    public function overtimeUpdate(Request $request, $id)
    {
        return redirect()->route('attendance.overtime')->with('success', 'Data lembur berhasil diupdate');
    }

    public function overtimeDestroy($id)
    {
        return redirect()->route('attendance.overtime')->with('success', 'Data lembur berhasil dihapus');
    }

    public function terlambat()
    {
        $terlambats = collect([
            (object)['id'=>1,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-01','jam_rencana'=>'08:00','jam_actual'=>'08:15','keterlambatan'=>'15 menit','keterangan'=>'Macet di tol'],
            (object)['id'=>2,'nik'=>'EMP-008','nama'=>'Maya Sari','tanggal'=>'2024-03-01','jam_rencana'=>'08:00','jam_actual'=>'08:30','keterlambatan'=>'30 menit','keterangan'=>'Kendaraan mogok'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-02','jam_rencana'=>'08:00','jam_actual'=>'08:10','keterlambatan'=>'10 menit','keterangan'=>''],
            (object)['id'=>4,'nik'=>'EMP-005','nama'=>'Rizky Pratama','tanggal'=>'2024-03-02','jam_rencana'=>'08:00','jam_actual'=>'09:00','keterlambatan'=>'60 menit','keterangan'=>'Sakit tapi tidak ada surat'],
            (object)['id'=>5,'nik'=>'EMP-008','nama'=>'Maya Sari','tanggal'=>'2024-03-03','jam_rencana'=>'08:00','jam_actual'=>'08:20','keterlambatan'=>'20 menit','keterangan'=>'Hujan deras'],
        ]);

        return view('attendance.terlambat', compact('terlambats'));
    }

    public function terlambatStore(Request $request)
    {
        return redirect()->route('attendance.terlambat')->with('success', 'Data keterlambatan berhasil ditambahkan');
    }

    public function terlambatUpdate(Request $request, $id)
    {
        return redirect()->route('attendance.terlambat')->with('success', 'Data keterlambatan berhasil diupdate');
    }

    public function terlambatDestroy($id)
    {
        return redirect()->route('attendance.terlambat')->with('success', 'Data keterlambatan berhasil dihapus');
    }

    public function riwayat()
    {
        $riwayats = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>2,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal'=>'2024-02-29','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>3,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal'=>'2024-02-28','jam_masuk'=>'07:55','jam_keluar'=>'18:00','jam_kerja'=>10,'status'=>'lembur','keterangan'=>'Lembur 1 jam'],
            (object)['id'=>4,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal'=>'2024-03-01','jam_masuk'=>'07:55','jam_keluar'=>'17:05','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>5,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal'=>'2024-02-29','jam_masuk'=>'08:00','jam_keluar'=>'-','jam_kerja'=>0,'status'=>'cuti','keterangan'=>'Cuti tahunan'],
            (object)['id'=>6,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-03-01','jam_masuk'=>'08:15','jam_keluar'=>'17:00','jam_kerja'=>8.75,'status'=>'terlambat','keterangan'=>'Terlambat 15 menit'],
            (object)['id'=>7,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal'=>'2024-02-29','jam_masuk'=>'08:00','jam_keluar'=>'17:00','jam_kerja'=>9,'status'=>'hadir','keterangan'=>''],
            (object)['id'=>8,'nik'=>'EMP-004','nama'=>'Dewi Lestari','tanggal'=>'2024-03-01','jam_masuk'=>'08:00','jam_keluar'=>'19:00','jam_kerja'=>11,'status'=>'lembur','keterangan'=>'Lembur 2 jam'],
        ]);

        return view('attendance.riwayat', compact('riwayats'));
    }

    public function riwayatStore(Request $request)
    {
        return redirect()->route('attendance.riwayat')->with('success', 'Data riwayat berhasil ditambahkan');
    }

    public function riwayatUpdate(Request $request, $id)
    {
        return redirect()->route('attendance.riwayat')->with('success', 'Data riwayat berhasil diupdate');
    }

    public function riwayatDestroy($id)
    {
        return redirect()->route('attendance.riwayat')->with('success', 'Data riwayat berhasil dihapus');
    }
}
