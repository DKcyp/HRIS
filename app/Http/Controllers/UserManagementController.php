<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = collect([
            (object)['id'=>1,'username'=>'admin','nama'=>'Administrator','email'=>'admin@hris.com','role'=>'Super Admin','status'=>'aktif','last_login'=>'2024-04-10 08:30:00'],
            (object)['id'=>2,'username'=>'hrd_manager','nama'=>'Hendra Kusuma','email'=>'hendra@hris.com','role'=>'HRD Manager','status'=>'aktif','last_login'=>'2024-04-10 09:00:00'],
            (object)['id'=>3,'username'=>'payroll_staff','nama'=>'Rina Wulandari','email'=>'rina@hris.com','role'=>'Payroll Staff','status'=>'aktif','last_login'=>'2024-04-10 08:45:00'],
            (object)['id'=>4,'username'=>'finance_mgr','nama'=>'Budi Setiawan','email'=>'budi@hris.com','role'=>'Finance Manager','status'=>'aktif','last_login'=>'2024-04-09 14:00:00'],
            (object)['id'=>5,'username'=>'it_admin','nama'=>'Rizky Pratama','email'=>'rizky@hris.com','role'=>'IT Admin','status'=>'aktif','last_login'=>'2024-04-10 07:30:00'],
        ]);

        $roles = collect([
            (object)['id'=>1,'nama'=>'Super Admin'],
            (object)['id'=>2,'nama'=>'HRD Manager'],
            (object)['id'=>3,'nama'=>'Payroll Staff'],
            (object)['id'=>4,'nama'=>'Finance Manager'],
            (object)['id'=>5,'nama'=>'IT Admin'],
            (object)['id'=>6,'nama'=>'Employee'],
        ]);

        return view('users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    public function roles()
    {
        $roles = collect([
            (object)['id'=>1,'nama'=>'Super Admin','deskripsi'=>'Akses penuh ke semua modul','jumlah_user'=>1,'permissions'=>'Semua akses'],
            (object)['id'=>2,'nama'=>'HRD Manager','deskripsi'=>'Kelola data karyawan, cuti, dan rekrutmen','jumlah_user'=>2,'permissions'=>'Karyawan, Organisasi, Recruitment, Cuti, Training'],
            (object)['id'=>3,'nama'=>'Payroll Staff','deskripsi'=>'Kelola gaji dan tunjangan','jumlah_user'=>1,'permissions'=>'Payroll, Laporan Payroll'],
            (object)['id'=>4,'nama'=>'Finance Manager','deskripsi'=>'Kelola keuangan dan budget','jumlah_user'=>1,'permissions'=>'Payroll, Laporan, Budget'],
            (object)['id'=>5,'nama'=>'IT Admin','deskripsi'=>'Kelola sistem dan infrastruktur','jumlah_user'=>1,'permissions'=>'System, User Management'],
            (object)['id'=>6,'nama'=>'Employee','deskripsi'=>'Akses terbatas untuk karyawan biasa','jumlah_user'=>50,'permissions'=>'Profil, Slip Gaji, Cuti'],
        ]);

        return view('roles.index', compact('roles'));
    }

    public function permissions()
    {
        $permissions = collect([
            (object)['id'=>1,'module'=>'Dashboard','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>2,'module'=>'Master Karyawan','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>3,'module'=>'Organisasi','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>4,'module'=>'Recruitment','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>5,'module'=>'Absensi','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>6,'module'=>'Cuti & Izin','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>7,'module'=>'Payroll','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>8,'module'=>'Performance','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>9,'module'=>'Training','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>10,'module'=>'Asset','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>11,'module'=>'Pengumuman','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>12,'module'=>'Dokumen','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>13,'module'=>'Resign','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
            (object)['id'=>14,'module'=>'Laporan','read'=>true,'create'=>false,'update'=>false,'delete'=>false],
            (object)['id'=>15,'module'=>'User Management','read'=>true,'create'=>true,'update'=>true,'delete'=>true],
        ]);

        return view('roles.permissions', compact('permissions'));
    }
}
