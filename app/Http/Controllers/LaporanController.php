<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function attendance()
    {
        $attendances = collect([
            (object)['nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'Marketing','hadir'=>22,'terlambat'=>2,'alpha'=>0,'sakit'=>1,'izin'=>0,'persentase'=>91.67],
            (object)['nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','hadir'=>24,'terlambat'=>0,'alpha'=>0,'sakit'=>0,'izin'=>0,'persentase'=>100],
            (object)['nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','hadir'=>20,'terlambat'=>3,'alpha'=>1,'sakit'=>0,'izin'=>1,'persentase'=>83.33],
            (object)['nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','hadir'=>23,'terlambat'=>1,'alpha'=>0,'sakit'=>0,'izin'=>0,'persentase'=>95.83],
            (object)['nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','hadir'=>21,'terlambat'=>2,'alpha'=>0,'sakit'=>1,'izin'=>1,'persentase'=>87.50],
        ]);

        return view('laporan.attendance', compact('attendances'));
    }

    public function leave()
    {
        $leaves = collect([
            (object)['nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'Marketing','cuti_tahunan'=>12,'cuti_terpakai'=>5,'cuti_sisa'=>7,'sakit'=>1,'izin'=>1,'total'=>7],
            (object)['nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','cuti_tahunan'=>12,'cuti_terpakai'=>8,'cuti_sisa'=>4,'sakit'=>0,'izin'=>0,'total'=>8],
            (object)['nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','cuti_tahunan'=>12,'cuti_terpakai'=>3,'cuti_sisa'=>9,'sakit'=>0,'izin'=>1,'total'=>4],
            (object)['nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','cuti_tahunan'=>12,'cuti_terpakai'=>10,'cuti_sisa'=>2,'sakit'=>0,'izin'=>0,'total'=>10],
            (object)['nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','cuti_tahunan'=>12,'cuti_terpakai'=>2,'cuti_sisa'=>10,'sakit'=>1,'izin'=>1,'total'=>4],
        ]);

        return view('laporan.leave', compact('leaves'));
    }

    public function payroll()
    {
        $payrolls = collect([
            (object)['nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'Marketing','gaji_pokok'=>5000000,'tunjangan'=>1000000,'bonus'=>500000,'potongan'=>350000,'bpjs'=>200000,'pajak'=>250000,'total'=>5700000],
            (object)['nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','gaji_pokok'=>6000000,'tunjangan'=>1200000,'bonus'=>750000,'potongan'=>400000,'bpjs'=>240000,'pajak'=>300000,'total'=>7010000],
            (object)['nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','gaji_pokok'=>5000000,'tunjangan'=>1000000,'bonus'=>300000,'potongan'=>300000,'bpjs'=>200000,'pajak'=>200000,'total'=>5600000],
            (object)['nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','gaji_pokok'=>8000000,'tunjangan'=>1500000,'bonus'=>1000000,'potongan'=>500000,'bpjs'=>320000,'pajak'=>500000,'total'=>9180000],
            (object)['nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','gaji_pokok'=>5500000,'tunjangan'=>1100000,'bonus'=>400000,'potongan'=>350000,'bpjs'=>220000,'pajak'=>250000,'total'=>6180000],
        ]);

        return view('laporan.payroll', compact('payrolls'));
    }

    public function employee()
    {
        $employees = collect([
            (object)['divisi'=>'Marketing','jumlah'=>15,'laki_laki'=>8,'perempuan'=>7,'rata_umur'=>30],
            (object)['divisi'=>'HRD','jumlah'=>8,'laki_laki'=>3,'perempuan'=>5,'rata_umur'=>32],
            (object)['divisi'=>'Finance','jumlah'=>10,'laki_laki'=>4,'perempuan'=>6,'rata_umur'=>29],
            (object)['divisi'=>'IT','jumlah'=>12,'laki_laki'=>9,'perempuan'=>3,'rata_umur'=>28],
            (object)['divisi'=>'Operasional','jumlah'=>20,'laki_laki'=>12,'perempuan'=>8,'rata_umur'=>31],
        ]);

        return view('laporan.employee', compact('employees'));
    }

    public function turnover()
    {
        $turnovers = collect([
            (object)['bulan'=>'Januari','masuk'=>5,'keluar'=>2,'resign'=>1,'phk'=>1,'lainnya'=>0,'persentase'=>6.67],
            (object)['bulan'=>'Februari','masuk'=>3,'keluar'=>1,'resign'=>1,'phk'=>0,'lainnya'=>0,'persentase'=>3.33],
            (object)['bulan'=>'Maret','masuk'=>4,'keluar'=>3,'resign'=>2,'phk'=>1,'lainnya'=>0,'persentase'=>10],
            (object)['bulan'=>'April','masuk'=>2,'keluar'=>1,'resign'=>1,'phk'=>0,'lainnya'=>0,'persentase'=>3.33],
            (object)['bulan'=>'Mei','masuk'=>3,'keluar'=>2,'resign'=>1,'phk'=>0,'lainnya'=>1,'persentase'=>6.67],
        ]);

        return view('laporan.turnover', compact('turnovers'));
    }

    public function lembur()
    {
        $overtimes = collect([
            (object)['nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'Marketing','jam_lembur'=>8,'tanggal'=>'2024-04-01','keterangan'=>'Proyek client deadline','uang_lembur'=>400000],
            (object)['nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','jam_lembur'=>12,'tanggal'=>'2024-04-05','keterangan'=>'Akhir bulan penutupan','uang_lembur'=>600000],
            (object)['nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','jam_lembur'=>10,'tanggal'=>'2024-04-10','keterangan'=>'Maintenance sistem','uang_lembur'=>500000],
            (object)['nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','jam_lembur'=>6,'tanggal'=>'2024-04-15','keterangan'=>'Persiapan presentasi','uang_lembur'=>300000],
            (object)['nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','jam_lembur'=>4,'tanggal'=>'2024-04-20','keterangan'=>'Rekrutmen karyawan baru','uang_lembur'=>200000],
        ]);

        return view('laporan.lembur', compact('overtimes'));
    }
}
