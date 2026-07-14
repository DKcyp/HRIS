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
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255|unique:user_auth,username',
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:user_auth,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            $user = UserAuth::create([
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'data' => $user,
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

    public function update(Request $request, $id)
    {
        try {
            $user = UserAuth::findOrFail($id);

            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:6',
                'role' => 'required|string',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            $data = [
                'username' => $validated['username'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ];

            if (!empty($validated['password'])) {
                $data['password'] = $validated['password'];
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate',
                'data' => $user,
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
            $user = UserAuth::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
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
