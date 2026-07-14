<?php

namespace App\Http\Controllers;

use App\Models\UserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = UserAuth::orderBy('id')->get();

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
        $request->validate([
            'username' => 'required|string|max:255|unique:global.user_auth,username',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:global.user_auth,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        UserAuth::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = UserAuth::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $data = [
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = UserAuth::findOrFail($id);
        $user->delete();

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
