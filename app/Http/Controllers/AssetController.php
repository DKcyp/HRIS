<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = collect([
            (object)['id'=>1,'kode'=>'AST-001','nama'=>'Laptop ASUS VivoBook','kategori'=>'Elektonik','merek'=>'ASUS','model'=>'VivoBook 14','tahun'=>2023,'kondisi'=>'baik','lokasi'=>'Kantor Pusat','status'=>'tersedia','harga'=>8500000],
            (object)['id'=>2,'kode'=>'AST-002','nama'=>'Printer HP LaserJet','kategori'=>'Elektonik','merek'=>'HP','model'=>'LaserJet Pro M404dn','tahun'=>2022,'kondisi'=>'baik','lokasi'=>'Kantor Pusat','status'=>'dipinjam','harga'=>4500000],
            (object)['id'=>3,'kode'=>'AST-003','nama'=>'Meja Kerja Kayu','kategori'=>'Furniture','merek'=>'Olympic','model'=>'Executive Desk','tahun'=>2021,'kondisi'=>'rusak_ringan','lokasi'=>'Kantor Cabang','status'=>'tersedia','harga'=>3200000],
            (object)['id'=>4,'kode'=>'AST-004','nama'=>'Kursi Ergonomis','kategori'=>'Furniture','merek'=>'Savelio','model'=>'Ergo Pro','tahun'=>2023,'kondisi'=>'baik','lokasi'=>'Kantor Pusat','status'=>'dipinjam','harga'=>2800000],
            (object)['id'=>5,'kode'=>'AST-005','nama'=>'Proyektor Epson','kategori'=>'Elektonik','merek'=>'Epson','model'=>'EB-X51','tahun'=>2022,'kondisi'=>'baik','lokasi'=>'Meeting Room','status'=>'tersedia','harga'=>7200000],
        ]);

        return view('asset.index', compact('assets'));
    }

    public function indexStore(Request $request)
    {
        return redirect()->route('asset.index')->with('success', 'Data asset berhasil ditambahkan');
    }

    public function indexUpdate(Request $request, $id)
    {
        return redirect()->route('asset.index')->with('success', 'Data asset berhasil diupdate');
    }

    public function indexDestroy($id)
    {
        return redirect()->route('asset.index')->with('success', 'Data asset berhasil dihapus');
    }

    public function peminjaman()
    {
        $loans = collect([
            (object)['id'=>1,'kode_pinjam'=>'PJ-001','asset'=>'Printer HP LaserJet','kode_asset'=>'AST-002','peminjam'=>'Budi Santoso','nik'=>'EMP-001','tanggal_pinjam'=>'2024-03-15','tanggal_kembali'=>'2024-03-20','keperluan'=>'Cetak laporan bulanan','status'=>'dipinjam'],
            (object)['id'=>2,'kode_pinjam'=>'PJ-002','asset'=>'Kursi Ergonomis','kode_asset'=>'AST-004','peminjam'=>'Siti Rahayu','nik'=>'EMP-002','tanggal_pinjam'=>'2024-03-18','tanggal_kembali'=>'2024-03-25','keperluan'=>'Work from home','status'=>'dipinjam'],
            (object)['id'=>3,'kode_pinjam'=>'PJ-003','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-001','peminjam'=>'Andi Wijaya','nik'=>'EMP-003','tanggal_pinjam'=>'2024-02-01','tanggal_kembali'=>'2024-02-05','keperluan'=>'Proyek client','status'=>'dikembalikan'],
            (object)['id'=>4,'kode_pinjam'=>'PJ-004','asset'=>'Proyektor Epson','kode_asset'=>'AST-005','peminjam'=>'Dewi Lestari','nik'=>'EMP-004','tanggal_pinjam'=>'2024-03-20','tanggal_kembali'=>'2024-03-20','keperluan'=>'Presentasi rapat','status'=>'dikembalikan'],
            (object)['id'=>5,'kode_pinjam'=>'PJ-005','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-001','peminjam'=>'Rizky Pratama','nik'=>'EMP-005','tanggal_pinjam'=>'2024-04-01','tanggal_kembali'=>'2024-04-05','keperluan'=>'Training luar kota','status'=>'dipinjam'],
        ]);

        return view('asset.peminjaman', compact('loans'));
    }

    public function peminjamanStore(Request $request)
    {
        return redirect()->route('asset.peminjaman')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function peminjamanUpdate(Request $request, $id)
    {
        return redirect()->route('asset.peminjaman')->with('success', 'Data peminjaman berhasil diupdate');
    }

    public function peminjamanDestroy($id)
    {
        return redirect()->route('asset.peminjaman')->with('success', 'Data peminjaman berhasil dihapus');
    }

    public function pengembalian()
    {
        $returns = collect([
            (object)['id'=>1,'kode_pinjam'=>'PJ-003','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-001','peminjam'=>'Andi Wijaya','nik'=>'EMP-003','tanggal_pinjam'=>'2024-02-01','tanggal_kembali'=>'2024-02-05','kondisi_kembali'=>'baik','keterangan'=>'Tidak ada kerusakan','status'=>'diterima'],
            (object)['id'=>2,'kode_pinjam'=>'PJ-004','asset'=>'Proyektor Epson','kode_asset'=>'AST-005','peminjam'=>'Dewi Lestari','nik'=>'EMP-004','tanggal_pinjam'=>'2024-03-20','tanggal_kembali'=>'2024-03-20','kondisi_kembali'=>'baik','keterangan'=>'Sesuai kondisi semula','status'=>'diterima'],
            (object)['id'=>3,'kode_pinjam'=>'PJ-006','asset'=>'Meja Kerja Kayu','kode_asset'=>'AST-003','peminjam'=>'Hendra Kusuma','nik'=>'EMP-006','tanggal_pinjam'=>'2024-03-01','tanggal_kembali'=>'2024-03-15','kondisi_kembali'=>'rusak_ringan','keterangan'=>'Goresan pada permukaan','status'=>'diterima'],
            (object)['id'=>4,'kode_pinjam'=>'PJ-007','asset'=>'Printer HP LaserJet','kode_asset'=>'AST-002','peminjam'=>'Rina Wulandari','nik'=>'EMP-007','tanggal_pinjam'=>'2024-03-10','tanggal_kembali'=>'2024-03-12','kondisi_kembali'=>'baik','keterangan'=>'Tidak ada masalah','status'=>'pending'],
            (object)['id'=>5,'kode_pinjam'=>'PJ-008','asset'=>'Laptop ASUS VivoBook','kode_asset'=>'AST-001','peminjam'=>'Budi Setiawan','nik'=>'EMP-008','tanggal_pinjam'=>'2024-03-25','tanggal_kembali'=>'2024-03-28','kondisi_kembali'=>'baik','keterangan'=>'Normal','status'=>'pending'],
        ]);

        return view('asset.pengembalian', compact('returns'));
    }

    public function pengembalianStore(Request $request)
    {
        return redirect()->route('asset.pengembalian')->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function pengembalianUpdate(Request $request, $id)
    {
        return redirect()->route('asset.pengembalian')->with('success', 'Data pengembalian berhasil diupdate');
    }

    public function pengembalianDestroy($id)
    {
        return redirect()->route('asset.pengembalian')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
