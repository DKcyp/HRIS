<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $gajis = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','gaji_pokok'=>5000000,'tunjangan'=>1000000,'bonus'=>500000,'potongan'=>300000,'bpjs'=>200000,'pajak'=>250000,'total'=>5750000],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','gaji_pokok'=>7000000,'tunjangan'=>1500000,'bonus'=>750000,'potongan'=>450000,'bpjs'=>350000,'pajak'=>500000,'total'=>8000000],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','gaji_pokok'=>4000000,'tunjangan'=>800000,'bonus'=>200000,'potongan'=>250000,'bpjs'=>200000,'pajak'=>150000,'total'=>4400000],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','gaji_pokok'=>6000000,'tunjangan'=>1200000,'bonus'=>600000,'potongan'=>400000,'bpjs'=>300000,'pajak'=>400000,'total'=>6700000],
            (object)['id'=>5,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','gaji_pokok'=>8000000,'tunjangan'=>2000000,'bonus'=>1000000,'potongan'=>600000,'bpjs'=>400000,'pajak'=>700000,'total'=>9300000],
            (object)['id'=>6,'nik'=>'EMP-006','nama'=>'Putri Amelia','gaji_pokok'=>4500000,'tunjangan'=>900000,'bonus'=>300000,'potongan'=>200000,'bpjs'=>225000,'pajak'=>200000,'total'=>5075000],
        ]);

        return view('payroll.index', compact('gajis'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('payroll.index')->with('success', 'Data gaji berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.index')->with('success', 'Data gaji berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('payroll.index')->with('success', 'Data gaji berhasil dihapus');
    }

    public function slip()
    {
        $slips = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','periode'=>'Maret 2024','gaji_pokok'=>5000000,'tunjangan'=>1000000,'bonus'=>500000,'potongan'=>300000,'bpjs'=>200000,'pajak'=>250000,'total'=>5750000],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','periode'=>'Maret 2024','gaji_pokok'=>7000000,'tunjangan'=>1500000,'bonus'=>750000,'potongan'=>450000,'bpjs'=>350000,'pajak'=>500000,'total'=>8000000],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','periode'=>'Maret 2024','gaji_pokok'=>4000000,'tunjangan'=>800000,'bonus'=>200000,'potongan'=>250000,'bpjs'=>200000,'pajak'=>150000,'total'=>4400000],
        ]);

        return view('payroll.slip', compact('slips'));
    }

    public function slipStore(Request $request)
    {
        return redirect()->route('payroll.slip')->with('success', 'Slip gaji berhasil digenerate');
    }

    public function generate()
    {
        return view('payroll.generate');
    }

    public function generateStore(Request $request)
    {
        return redirect()->route('payroll.index')->with('success', 'Payroll periode ini berhasil digenerate');
    }

    public function gajiPokok()
    {
        $gajiPokoks = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','jabatan'=>'Staff Developer','grade'=>'Grade 2','gaji_pokok'=>5000000,'effective_date'=>'2023-01-01','status'=>'aktif'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','jabatan'=>'HR Manager','grade'=>'Grade 5','gaji_pokok'=>7000000,'effective_date'=>'2022-06-01','status'=>'aktif'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','jabatan'=>'Staff Accounting','grade'=>'Grade 1','gaji_pokok'=>4000000,'effective_date'=>'2023-07-01','status'=>'aktif'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','jabatan'=>'Marketing Manager','grade'=>'Grade 4','gaji_pokok'=>6000000,'effective_date'=>'2022-03-01','status'=>'aktif'],
            (object)['id'=>5,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','jabatan'=>'Finance Manager','grade'=>'Grade 5','gaji_pokok'=>8000000,'effective_date'=>'2021-11-01','status'=>'aktif'],
            (object)['id'=>6,'nik'=>'EMP-006','nama'=>'Putri Amelia','jabatan'=>'HR Staff','grade'=>'Grade 2','gaji_pokok'=>4500000,'effective_date'=>'2023-02-01','status'=>'aktif'],
        ]);

        return view('payroll.gaji-pokok', compact('gajiPokoks'));
    }

    public function gajiPokokStore(Request $request)
    {
        return redirect()->route('payroll.gaji-pokok')->with('success', 'Gaji pokok berhasil ditambahkan');
    }

    public function gajiPokokUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.gaji-pokok')->with('success', 'Gaji pokok berhasil diupdate');
    }

    public function gajiPokokDestroy($id)
    {
        return redirect()->route('payroll.gaji-pokok')->with('success', 'Gaji pokok berhasil dihapus');
    }

    public function tunjangan()
    {
        $tunjangans = collect([
            (object)['id'=>1,'kode'=>'TUN-001','nama'=>'Tunjangan Transportasi','jenis'=>'Tetap','jumlah'=>500000,'deskripsi'=>'Tunjangan untuk transportasi harian','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'TUN-002','nama'=>'Tunjangan Makan','jenis'=>'Tetap','jumlah'=>300000,'deskripsi'=>'Tunjangan makan siang','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'TUN-003','nama'=>'Tunjangan Kesehatan','jenis'=>'Tetap','jumlah'=>200000,'deskripsi'=>'Tunjangan kesehatan tambahan','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'TUN-004','nama'=>'Tunjangan Komunikasi','jenis'=>'Tetap','jumlah'=>150000,'deskripsi'=>'Tunjangan pulsa dan internet','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'TUN-005','nama'=>'Tunjangan Jabatan','jenis'=>'Jabatan','jumlah'=>1000000,'deskripsi'=>'Tunjangan untuk posisi manager','status'=>'aktif'],
        ]);

        return view('payroll.tunjangan', compact('tunjangans'));
    }

    public function tunjanganStore(Request $request)
    {
        return redirect()->route('payroll.tunjangan')->with('success', 'Tunjangan berhasil ditambahkan');
    }

    public function tunjanganUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.tunjangan')->with('success', 'Tunjangan berhasil diupdate');
    }

    public function tunjanganDestroy($id)
    {
        return redirect()->route('payroll.tunjangan')->with('success', 'Tunjangan berhasil dihapus');
    }

    public function bonus()
    {
        $bonuses = collect([
            (object)['id'=>1,'kode'=>'BON-001','nama'=>'Bonus Kinerja','jenis'=>'Kinerja','persentase'=>10,'deskripsi'=>'Bonus berdasarkan penilaian kinerja','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'BON-002','nama'=>'Bonus Tahunan','jenis'=>'Tahunan','persentase'=>15,'deskripsi'=>'Bonus akhir tahun untuk karyawan aktif','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'BON-003','nama'=>'Bonus Proyek','jenis'=>'Proyek','persentase'=>5,'deskripsi'=>'Bonus penyelesaian proyek tepat waktu','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'BON-004','nama'=>'Bonus Penjualan','jenis'=>'Penjualan','persentase'=>7,'deskripsi'=>'Bonus pencapaian target penjualan','status'=>'aktif'],
        ]);

        return view('payroll.bonus', compact('bonuses'));
    }

    public function bonusStore(Request $request)
    {
        return redirect()->route('payroll.bonus')->with('success', 'Bonus berhasil ditambahkan');
    }

    public function bonusUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.bonus')->with('success', 'Bonus berhasil diupdate');
    }

    public function bonusDestroy($id)
    {
        return redirect()->route('payroll.bonus')->with('success', 'Bonus berhasil dihapus');
    }

    public function potongan()
    {
        $potongans = collect([
            (object)['id'=>1,'kode'=>'POT-001','nama'=>'BPJS Kesehatan','jenis'=>'Wajib','persentase'=>4,'deskripsi'=>'Iuran BPJS Kesehatan','status'=>'aktif'],
            (object)['id'=>2,'kode'=>'POT-002','nama'=>'BPJS Ketenagakerjaan','jenis'=>'Wajib','persentase'=>2,'deskripsi'=>'Iuran BPJS Ketenagakerjaan','status'=>'aktif'],
            (object)['id'=>3,'kode'=>'POT-003','nama'=>'PPh 21','jenis'=>'Wajib','persentase'=>5,'deskripsi'=>'Pajak penghasilan pasal 21','status'=>'aktif'],
            (object)['id'=>4,'kode'=>'POT-004','nama'=>'Denda Keterlambatan','jenis'=>'Admin','jumlah'=>50000,'deskripsi'=>'Denda untuk keterlambatan','status'=>'aktif'],
            (object)['id'=>5,'kode'=>'POT-005','nama'=>'Pinjaman Karyawan','jenis'=>'Pinjaman','jumlah'=>200000,'deskripsi'=>'Cicilan pinjaman karyawan','status'=>'aktif'],
        ]);

        return view('payroll.potongan', compact('potongans'));
    }

    public function potonganStore(Request $request)
    {
        return redirect()->route('payroll.potongan')->with('success', 'Potongan berhasil ditambahkan');
    }

    public function potonganUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.potongan')->with('success', 'Potongan berhasil diupdate');
    }

    public function potonganDestroy($id)
    {
        return redirect()->route('payroll.potongan')->with('success', 'Potongan berhasil dihapus');
    }

    public function bpjs()
    {
        $bpjs = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','bpjs_kesehatan'=>200000,'bpjs_ketenagakerjaan'=>100000,'jkm'=>30000,'jht'=>40000,'jp'=>20000,'total'=>390000,'status'=>'aktif'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','bpjs_kesehatan'=>350000,'bpjs_ketenagakerjaan'=>175000,'jkm'=>52500,'jht'=>70000,'jp'=>35000,'total'=>682500,'status'=>'aktif'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','bpjs_kesehatan'=>200000,'bpjs_ketenagakerjaan'=>100000,'jkm'=>30000,'jht'=>40000,'jp'=>20000,'total'=>390000,'status'=>'aktif'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','bpjs_kesehatan'=>300000,'bpjs_ketenagakerjaan'=>150000,'jkm'=>45000,'jht'=>60000,'jp'=>30000,'total'=>585000,'status'=>'aktif'],
            (object)['id'=>5,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','bpjs_kesehatan'=>400000,'bpjs_ketenagakerjaan'=>200000,'jkm'=>60000,'jht'=>80000,'jp'=>40000,'total'=>780000,'status'=>'aktif'],
        ]);

        return view('payroll.bpjs', compact('bpjs'));
    }

    public function bpjsStore(Request $request)
    {
        return redirect()->route('payroll.bpjs')->with('success', 'Data BPJS berhasil ditambahkan');
    }

    public function bpjsUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.bpjs')->with('success', 'Data BPJS berhasil diupdate');
    }

    public function bpjsDestroy($id)
    {
        return redirect()->route('payroll.bpjs')->with('success', 'Data BPJS berhasil dihapus');
    }

    public function pajak()
    {
        $pajaks = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','penghasilan_bruto'=>6500000,'potongan_lain'=>500000,'pkp'=>5500000,'pajak_biaya_jabatan'=>250000,'pajak_berkeluarga'=>5400000,'pph21'=>250000,'status'=>'aktif'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','penghasilan_bruto'=>9250000,'potongan_lain'=>800000,'pkp'=>7950000,'pajak_biaya_jabatan'=>450000,'pajak_berkeluarga'=>7050000,'pph21'=>500000,'status'=>'aktif'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','penghasilan_bruto'=>5000000,'potongan_lain'=>450000,'pkp'=>4100000,'pajak_biaya_jabatan'=>200000,'pajak_berkeluarga'=>3700000,'pph21'=>150000,'status'=>'aktif'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','penghasilan_bruto'=>7800000,'potongan_lain'=>700000,'pkp'=>6600000,'pajak_biaya_jabatan'=>350000,'pajak_berkeluarga'=>5900000,'pph21'=>400000,'status'=>'aktif'],
        ]);

        return view('payroll.pajak', compact('pajaks'));
    }

    public function pajakStore(Request $request)
    {
        return redirect()->route('payroll.pajak')->with('success', 'Data pajak berhasil ditambahkan');
    }

    public function pajakUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.pajak')->with('success', 'Data pajak berhasil diupdate');
    }

    public function pajakDestroy($id)
    {
        return redirect()->route('payroll.pajak')->with('success', 'Data pajak berhasil dihapus');
    }

    public function rekap()
    {
        $rekaps = collect([
            (object)['id'=>1,'periode'=>'Maret 2024','total_karyawan'=>8,'total_gaji_pokok'=>38500000,'total_tunjangan'=>7400000,'total_bonus'=>3350000,'total_potongan'=>2200000,'total_bpjs'=>2827500,'total_pajak'=>2200000,'grand_total'=>42422500,'status'=>'draft'],
            (object)['id'=>2,'periode'=>'Februari 2024','total_karyawan'=>8,'total_gaji_pokok'=>38500000,'total_tunjangan'=>7400000,'total_bonus'=>3350000,'total_potongan'=>2200000,'total_bpjs'=>2827500,'total_pajak'=>2200000,'grand_total'=>42422500,'status'=>'diproses'],
            (object)['id'=>3,'periode'=>'Januari 2024','total_karyawan'=>8,'total_gaji_pokok'=>38500000,'total_tunjangan'=>7400000,'total_bonus'=>3350000,'total_potongan'=>2200000,'total_bpjs'=>2827500,'total_pajak'=>2200000,'grand_total'=>42422500,'status'=>'selesai'],
        ]);

        return view('payroll.rekap', compact('rekaps'));
    }

    public function rekapStore(Request $request)
    {
        return redirect()->route('payroll.rekap')->with('success', 'Rekap payroll berhasil ditambahkan');
    }

    public function rekapUpdate(Request $request, $id)
    {
        return redirect()->route('payroll.rekap')->with('success', 'Rekap payroll berhasil diupdate');
    }

    public function rekapDestroy($id)
    {
        return redirect()->route('payroll.rekap')->with('success', 'Rekap payroll berhasil dihapus');
    }
}
