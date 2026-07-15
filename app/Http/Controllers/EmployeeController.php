<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id')->get();

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string|max:255|unique:global.pegawai,nik',
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'required|in:L,P',
                'agama' => 'nullable|string|max:255',
                'status_nikah' => 'nullable|string|max:255',
                'golongan_darah' => 'nullable|string|max:5',
                'email' => 'required|email|max:255|unique:global.pegawai,email',
                'telepon' => 'required|string|max:255',
                'no_bpjs' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'kota' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
                'kode_pos' => 'nullable|string|max:10',
                'divisi' => 'required|string|max:255',
                'departemen' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'grade' => 'nullable|string|max:255',
                'lokasi_kerja' => 'nullable|string|max:255',
                'status_kepegawaian' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',
                'tanggal_kontrak_habis' => 'nullable|date',
                'no_ktp' => 'nullable|string|max:255',
                'no_npwp' => 'nullable|string|max:255',
                'no_kk' => 'nullable|string|max:255',
                'status' => 'required|in:aktif,kontrak,resign',
            ]);

            $employee = Employee::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan',
                'data' => $employee,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $employee,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'nik' => 'required|string|max:255|unique:global.pegawai,nik,' . $id,
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'required|in:L,P',
                'agama' => 'nullable|string|max:255',
                'status_nikah' => 'nullable|string|max:255',
                'golongan_darah' => 'nullable|string|max:5',
                'email' => 'required|email|max:255|unique:global.pegawai,email,' . $id,
                'telepon' => 'required|string|max:255',
                'no_bpjs' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'kota' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
                'kode_pos' => 'nullable|string|max:10',
                'divisi' => 'required|string|max:255',
                'departemen' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'grade' => 'nullable|string|max:255',
                'lokasi_kerja' => 'nullable|string|max:255',
                'status_kepegawaian' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',
                'tanggal_kontrak_habis' => 'nullable|date',
                'no_ktp' => 'nullable|string|max:255',
                'no_npwp' => 'nullable|string|max:255',
                'no_kk' => 'nullable|string|max:255',
                'status' => 'required|in:aktif,kontrak,resign',
            ]);

            $employee->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil diupdate',
                'data' => $employee,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Sub-menu methods (still using mock data for now)
    public function riwayatJabatan()
    {
        $riwayat = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','jabatan_lama'=>'Staff Junior','jabatan_baru'=>'Staff Developer','tanggal'=>'2023-01-15','keterangan'=>'Promosi'],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','jabatan_lama'=>'HR Staff','jabatan_baru'=>'HR Manager','tanggal'=>'2022-06-01','keterangan'=>'Promosi'],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','jabatan_lama'=>'Intern Accounting','jabatan_baru'=>'Staff Accounting','tanggal'=>'2023-10-01','keterangan'=>'Kontrak ke Tetap'],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','jabatan_lama'=>'Staff Marketing','jabatan_baru'=>'Marketing Manager','tanggal'=>'2022-03-20','keterangan'=>'Promosi'],
            (object)['id'=>5,'nama'=>'Rizky Pratama','nik'=>'EMP-005','jabatan_lama'=>'Staff IT','jabatan_baru'=>'Staff Network','tanggal'=>'2023-04-01','keterangan'=>'Mutasi'],
        ]);

        return view('employee.riwayat-jabatan', compact('riwayat'));
    }

    public function riwayatGaji()
    {
        $gaji = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','periode'=>'Januari 2024','gaji_pokok'=>5000000,'tunjangan'=>1000000,'bonus'=>500000,'potongan'=>300000,'total'=>6200000],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','periode'=>'Januari 2024','gaji_pokok'=>7000000,'tunjangan'=>1500000,'bonus'=>750000,'potongan'=>450000,'total'=>8800000],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','periode'=>'Januari 2024','gaji_pokok'=>4000000,'tunjangan'=>800000,'bonus'=>200000,'potongan'=>250000,'total'=>4750000],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','periode'=>'Januari 2024','gaji_pokok'=>6000000,'tunjangan'=>1200000,'bonus'=>600000,'potongan'=>400000,'total'=>7400000],
            (object)['id'=>5,'nama'=>'Hendra Kusuma','nik'=>'EMP-007','periode'=>'Januari 2024','gaji_pokok'=>8000000,'tunjangan'=>2000000,'bonus'=>1000000,'potongan'=>600000,'total'=>10400000],
        ]);

        return view('employee.riwayat-gaji', compact('gaji'));
    }

    public function pendidikan()
    {
        $pendidikan = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','jenjang'=>'S1','institusi'=>'Universitas Indonesia','jurusan'=>'Teknik Informatika','tahun_lulus'=>2020,'ipk'=>3.75],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','jenjang'=>'S1','institusi'=>'Universitas Gadjah Mada','jurusan'=>'Psikologi','tahun_lulus'=>2019,'ipk'=>3.80],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','jenjang'=>'S2','institusi'=>'Institut Teknologi Bandung','jurusan'=>'Magister Manajemen','tahun_lulus'=>2022,'ipk'=>3.90],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','jenjang'=>'S1','institusi'=>'Universitas Padjadjaran','jurusan'=>'Manajemen','tahun_lulus'=>2018,'ipk'=>3.65],
            (object)['id'=>5,'nama'=>'Rizky Pratama','nik'=>'EMP-005','jenjang'=>'D3','institusi'=>'Politeknik Negeri Jakarta','jurusan'=>'Teknik Komputer','tahun_lulus'=>2021,'ipk'=>3.50],
        ]);

        return view('employee.pendidikan', compact('pendidikan'));
    }

    public function pengalaman()
    {
        $pengalaman = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','perusahaan'=>'PT Teknologi Maju','posisi'=>'Junior Developer','mulai'=>'2020-07-01','selesai'=>'2022-02-28','durasi'=>'1 tahun 8 bulan'],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','perusahaan'=>'PT Sumber Daya Manusia','posisi'=>'HR Officer','mulai'=>'2019-03-01','selesai'=>'2021-01-09','durasi'=>'1 tahun 10 bulan'],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','perusahaan'=>'PT Akuntansi Sukses','posisi'=>'Accounting Staff','mulai'=>'2022-08-01','selesai'=>'2023-06-30','durasi'=>'11 bulan'],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','perusahaan'=>'PT Marketing Pro','posisi'=>'Marketing Executive','mulai'=>'2018-05-01','selesai'=>'2020-06-19','durasi'=>'2 tahun 1 bulan'],
        ]);

        return view('employee.pengalaman', compact('pengalaman'));
    }

    public function sertifikat()
    {
        $sertifikat = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','sertifikat'=>'AWS Certified Developer','lembaga'=>'Amazon Web Services','tanggal'=>'2023-05-15','expired'=>'2026-05-15'],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','sertifikat'=>'SHRM Certified Professional','lembaga'=>'SHRM','tanggal'=>'2022-09-20','expired'=>'2025-09-20'],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','sertifikat'=>'Certified Public Accountant','lembaga'=>'IAI','tanggal'=>'2023-01-10','expired'=>'2028-01-10'],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','sertifikat'=>'Google Ads Certification','lembaga'=>'Google','tanggal'=>'2023-07-01','expired'=>'2025-07-01'],
        ]);

        return view('employee.sertifikat', compact('sertifikat'));
    }

    public function dokumen()
    {
        $dokumen = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','jenis'=>'KTP','file'=>'budi_ktp.pdf','tanggal_upload'=>'2022-03-15','status'=>'verified'],
            (object)['id'=>2,'nama'=>'Budi Santoso','nik'=>'EMP-001','jenis'=>'KK','file'=>'budi_kk.pdf','tanggal_upload'=>'2022-03-15','status'=>'verified'],
            (object)['id'=>3,'nama'=>'Budi Santoso','nik'=>'EMP-001','jenis'=>'NPWP','file'=>'budi_npwp.pdf','tanggal_upload'=>'2022-03-15','status'=>'verified'],
            (object)['id'=>4,'nama'=>'Budi Santoso','nik'=>'EMP-001','jenis'=>'BPJS','file'=>'budi_bpjs.pdf','tanggal_upload'=>'2022-03-15','status'=>'pending'],
            (object)['id'=>5,'nama'=>'Siti Rahayu','nik'=>'EMP-002','jenis'=>'KTP','file'=>'siti_ktp.pdf','tanggal_upload'=>'2021-01-10','status'=>'verified'],
            (object)['id'=>6,'nama'=>'Siti Rahayu','nik'=>'EMP-002','jenis'=>'NPWP','file'=>'siti_npwp.pdf','tanggal_upload'=>'2021-01-10','status'=>'verified'],
            (object)['id'=>7,'nama'=>'Andi Wijaya','nik'=>'EMP-003','jenis'=>'KTP','file'=>'andi_ktp.pdf','tanggal_upload'=>'2023-07-01','status'=>'verified'],
            (object)['id'=>8,'nama'=>'Andi Wijaya','nik'=>'EMP-003','jenis'=>'BPJS','file'=>'andi_bpjs.pdf','tanggal_upload'=>'2023-07-01','status'=>'pending'],
        ]);

        return view('employee.dokumen', compact('dokumen'));
    }

    public function kontakDarurat()
    {
        $kontak = collect([
            (object)['id'=>1,'nama'=>'Budi Santoso','nik'=>'EMP-001','kontak_nama'=>'Siti Santoso','hubungan'=>'Istri','telepon'=>'081298765432','alamat'=>'Jakarta Selatan'],
            (object)['id'=>2,'nama'=>'Siti Rahayu','nik'=>'EMP-002','kontak_nama'=>'Bambang Rahayu','hubungan'=>'Suami','telepon'=>'081287654321','alamat'=>'Yogyakarta'],
            (object)['id'=>3,'nama'=>'Andi Wijaya','nik'=>'EMP-003','kontak_nama'=>'Rina Wijaya','hubungan'=>'Ibu','telepon'=>'081276543210','alamat'=>'Bandung'],
            (object)['id'=>4,'nama'=>'Dewi Lestari','nik'=>'EMP-004','kontak_nama'=>'Agus Lestari','hubungan'=>'Suami','telepon'=>'081265432109','alamat'=>'Surabaya'],
            (object)['id'=>5,'nama'=>'Rizky Pratama','nik'=>'EMP-005','kontak_nama'=>'Rina Pratama','hubungan'=>'Ibu','telepon'=>'081254321098','alamat'=>'Semarang'],
        ]);

        return view('employee.kontak-darurat', compact('kontak'));
    }

    public function status()
    {
        $statusList = collect([
            (object)['id'=>1,'nik'=>'EMP-001','nama'=>'Budi Santoso','divisi'=>'IT','jabatan'=>'Staff Developer','status'=>'aktif','tanggal_masuk'=>'2022-03-15','tanggal_keluar'=>null,'durasi'=>'2 tahun 3 bulan'],
            (object)['id'=>2,'nik'=>'EMP-002','nama'=>'Siti Rahayu','divisi'=>'HRD','jabatan'=>'HR Manager','status'=>'aktif','tanggal_masuk'=>'2021-01-10','tanggal_keluar'=>null,'durasi'=>'3 tahun 5 bulan'],
            (object)['id'=>3,'nik'=>'EMP-003','nama'=>'Andi Wijaya','divisi'=>'Finance','jabatan'=>'Staff Accounting','status'=>'kontrak','tanggal_masuk'=>'2023-07-01','tanggal_keluar'=>'2024-06-30','durasi'=>'11 bulan'],
            (object)['id'=>4,'nik'=>'EMP-004','nama'=>'Dewi Lestari','divisi'=>'Marketing','jabatan'=>'Marketing Manager','status'=>'aktif','tanggal_masuk'=>'2020-06-20','tanggal_keluar'=>null,'durasi'=>'4 tahun'],
            (object)['id'=>5,'nik'=>'EMP-005','nama'=>'Rizky Pratama','divisi'=>'IT','jabatan'=>'Staff Network','status'=>'resign','tanggal_masuk'=>'2022-09-01','tanggal_keluar'=>'2024-03-01','durasi'=>'1 tahun 6 bulan'],
            (object)['id'=>6,'nik'=>'EMP-006','nama'=>'Putri Amelia','divisi'=>'HRD','jabatan'=>'HR Staff','status'=>'aktif','tanggal_masuk'=>'2023-02-14','tanggal_keluar'=>null,'durasi'=>'1 tahun 4 bulan'],
            (object)['id'=>7,'nik'=>'EMP-007','nama'=>'Hendra Kusuma','divisi'=>'Finance','jabatan'=>'Finance Manager','status'=>'aktif','tanggal_masuk'=>'2019-11-05','tanggal_keluar'=>null,'durasi'=>'4 tahun 7 bulan'],
            (object)['id'=>8,'nik'=>'EMP-008','nama'=>'Maya Sari','divisi'=>'Marketing','jabatan'=>'Staff Marketing','status'=>'kontrak','tanggal_masuk'=>'2023-04-10','tanggal_keluar'=>'2024-04-09','durasi'=>'1 tahun'],
        ]);

        return view('employee.status', compact('statusList'));
    }
}
