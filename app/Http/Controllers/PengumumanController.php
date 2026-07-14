<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $news = collect([
            (object)['id'=>1,'kode'=>'NWS-001','judul'=>'Pembaruan Sistem HRIS V2','isi'=>'Sistem HRIS V2 telah mengalami pembaruan fitur baru untuk manajemen cuti dan izin. Silakan cek menu terbaru.','pengirim'=>'IT Department','tanggal'=>'2024-04-01','kategori'=>'Penting','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'NWS-002','judul'=>'Libur Nasional Hari Raya Idul Fitri','isi'=>'Berdasarkan Keputusan Pemerintah, perusahaan akan libur selama hari raya Idul Fitri mulai tanggal 8-15 April 2024.','pengirim'=>'HRD','tanggal'=>'2024-03-25','kategori'=>'Pengumuman','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'NWS-003','judul'=>'Training Karyawan Baru','isi'=>'Akan diadakan pelatihan untuk karyawan baru pada tanggal 20 April 2024 di Auditorium Utama.','pengirim'=>'HRD','tanggal'=>'2024-04-05','kategori'=>'Training','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'NWS-004','judul'=>'Pengumuman Kenaikan Jabatan','isi'=>'Dengan ini kami mengumumkan kenaikan jabatan beberapa karyawan yang telah menunjukkan kinerja terbaik.','pengirim'=>'Direktur HRD','tanggal'=>'2024-03-30','kategori'=>'Pengumuman','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'NWS-005','judul'=>'Maintenance Sistem','isi'=>'Sistem HRIS akan dalam pemeliharaan pada hari Sabtu, 6 April 2024 mulai pukul 22:00 hingga selesai.','pengirim'=>'IT Department','tanggal'=>'2024-04-03','kategori'=>'Teknis','status'=>'draft'],
        ]);

        return view('pengumuman.index', compact('news'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus');
    }

    public function event()
    {
        $events = collect([
            (object)['id'=>1,'kode'=>'EVT-001','judul'=>'Company Gathering 2024','deskripsi'=>'Acara gathering tahunan seluruh karyawan','tanggal_mulai'=>'2024-05-01','tanggal_selesai'=>'2024-05-01','lokasi'=>'Hotel Grand Mercure','peserta'=>'Seluruh Karyawan','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'EVT-002','judul'=>'Seminar Digital Marketing','deskripsi'=>'Seminar strategi pemasaran digital terkini','tanggal_mulai'=>'2024-04-20','tanggal_selesai'=>'2024-04-20','lokasi'=>'Auditorium','peserta'=>'Marketing Team','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'EVT-003','judul'=>'Workshop K3','deskripsi'=>'Workshop Keselamatan dan Kesehatan Kerja','tanggal_mulai'=>'2024-04-25','tanggal_selesai'=>'2024-04-25','lokasi'=>'Meeting Room A','peserta'=>'Karyawan Baru','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'EVT-004','judul'=>'Annual Meeting','deskripsi'=>'Rapat tahunan evaluasi kinerja perusahaan','tanggal_mulai'=>'2024-06-01','tanggal_selesai'=>'2024-06-01','lokasi'=>'Ballroom Hotel','peserta'=>'Manager dan Direktur','status'=>'draft'],
            (object)['id'=>5,'kode'=>'EVT-005','judul'=>'Buka Bersama','deskripsi'=>'Acara buka puasa bersama seluruh karyawan','tanggal_mulai'=>'2024-04-10','tanggal_selesai'=>'2024-04-10','lokasi'=>'Kantor Pusat','peserta'=>'Seluruh Karyawan','status'=>'selesai'],
        ]);

        return view('pengumuman.event', compact('events'));
    }

    public function eventStore(Request $request)
    {
        return redirect()->route('pengumuman.event')->with('success', 'Data event berhasil ditambahkan');
    }

    public function eventUpdate(Request $request, $id)
    {
        return redirect()->route('pengumuman.event')->with('success', 'Data event berhasil diupdate');
    }

    public function eventDestroy($id)
    {
        return redirect()->route('pengumuman.event')->with('success', 'Data event berhasil dihapus');
    }

    public function birthday()
    {
        $birthdays = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','tanggal_lahir'=>'1990-04-15','divisi'=>'Marketing','jabatan'=>'Staff','usia'=>34,'status'=>'aktif'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','tanggal_lahir'=>'1988-04-20','divisi'=>'HRD','jabatan'=>'Supervisor','usia'=>36,'status'=>'aktif'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','tanggal_lahir'=>'1992-04-05','divisi'=>'Finance','jabatan'=>'Staff','usia'=>32,'status'=>'aktif'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','tanggal_lahir'=>'1985-04-25','divisi'=>'Marketing','jabatan'=>'Manager','usia'=>39,'status'=>'aktif'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','tanggal_lahir'=>'1995-04-10','divisi'=>'IT','jabatan'=>'Staff','usia'=>29,'status'=>'aktif'],
        ]);

        return view('pengumuman.birthday', compact('birthdays'));
    }

    public function birthdayStore(Request $request)
    {
        return redirect()->route('pengumuman.birthday')->with('success', 'Data birthday berhasil ditambahkan');
    }

    public function birthdayUpdate(Request $request, $id)
    {
        return redirect()->route('pengumuman.birthday')->with('success', 'Data birthday berhasil diupdate');
    }

    public function birthdayDestroy($id)
    {
        return redirect()->route('pengumuman.birthday')->with('success', 'Data birthday berhasil dihapus');
    }

    public function liburNasional()
    {
        $holidays = collect([
            (object)['id'=>1,'kode'=>'HLM-001','nama'=>'Tahun Baru 2024','tanggal'=>'2024-01-01','keterangan'=>'Perayaan Tahun Baru Masehi','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'HLM-002','nama'=>'Isra Mi\'raj','tanggal'=>'2024-02-08','keterangan'=>'Peringatan Isra Mi\'raj Nabi Muhammad SAW','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'HLM-003','nama'=>'Hari Raya Nyepi','tanggal'=>'2024-03-11','keterangan'=>'Hari Suci Agama Hindu','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'HLM-004','nama'=>'Hari Raya Idul Fitri','tanggal'=>'2024-04-10','keterangan'=>'Hari Raya Umat Islam','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'HLM-005','nama'=>'Hari Buruh','tanggal'=>'2024-05-01','keterangan'=>'Hari Libur Nasional','status'=>'aktif'],
        ]);

        return view('pengumuman.libur-nasional', compact('holidays'));
    }

    public function liburNasionalStore(Request $request)
    {
        return redirect()->route('pengumuman.libur-nasional')->with('success', 'Data libur nasional berhasil ditambahkan');
    }

    public function liburNasionalUpdate(Request $request, $id)
    {
        return redirect()->route('pengumuman.libur-nasional')->with('success', 'Data libur nasional berhasil diupdate');
    }

    public function liburNasionalDestroy($id)
    {
        return redirect()->route('pengumuman.libur-nasional')->with('success', 'Data libur nasional berhasil dihapus');
    }
}
