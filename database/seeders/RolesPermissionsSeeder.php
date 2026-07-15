<?php

namespace Database\Seeders;

use App\Models\UserAuth;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Seed roles
        $roles = [
            ['nama' => 'Super Admin', 'deskripsi' => 'Akses penuh ke semua modul'],
            ['nama' => 'HRD Manager', 'deskripsi' => 'Kelola data karyawan, cuti, dan rekrutmen'],
            ['nama' => 'Payroll Staff', 'deskripsi' => 'Kelola gaji dan tunjangan'],
            ['nama' => 'Finance Manager', 'deskripsi' => 'Kelola keuangan dan budget'],
            ['nama' => 'IT Admin', 'deskripsi' => 'Kelola sistem dan infrastruktur'],
            ['nama' => 'Employee', 'deskripsi' => 'Akses terbatas untuk karyawan biasa'],
        ];
        foreach ($roles as $r) {
            Role::create($r);
        }

        // Seed permissions
        $permissions = [
            ['module' => 'Dashboard', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Master Karyawan', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Organisasi', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Recruitment', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Absensi', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Cuti & Izin', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Payroll', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Performance', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Training', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Asset', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Pengumuman', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Dokumen', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Resign', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
            ['module' => 'Laporan', 'read' => true, 'create' => false, 'update' => false, 'delete' => false],
            ['module' => 'User Management', 'read' => true, 'create' => true, 'update' => true, 'delete' => true],
        ];
        foreach ($permissions as $p) {
            Permission::create($p);
        }

        // Seed users
        $users = [
            ['username' => 'admin', 'nama' => 'Administrator', 'email' => 'admin@hris.com', 'password' => 'password', 'role' => 'Super Admin', 'status' => 'aktif'],
            ['username' => 'hrd_manager', 'nama' => 'Hendra Kusuma', 'email' => 'hendra@hris.com', 'password' => 'password', 'role' => 'HRD Manager', 'status' => 'aktif'],
            ['username' => 'payroll_staff', 'nama' => 'Rina Wulandari', 'email' => 'rina@hris.com', 'password' => 'password', 'role' => 'Payroll Staff', 'status' => 'aktif'],
            ['username' => 'finance_mgr', 'nama' => 'Budi Setiawan', 'email' => 'budi@hris.com', 'password' => 'password', 'role' => 'Finance Manager', 'status' => 'aktif'],
            ['username' => 'it_admin', 'nama' => 'Rizky Pratama', 'email' => 'rizky@hris.com', 'password' => 'password', 'role' => 'IT Admin', 'status' => 'aktif'],
        ];
        foreach ($users as $u) {
            UserAuth::create($u);
        }

        // Sync all permissions for Super Admin
        $adminRole = Role::where('nama', 'Super Admin')->first();
        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::pluck('id'));
        }

        // Sync specific permissions for HRD Manager
        $hrdRole = Role::where('nama', 'HRD Manager')->first();
        if ($hrdRole) {
            $hrdPerms = Permission::whereIn('module', ['Master Karyawan', 'Organisasi', 'Recruitment', 'Cuti & Izin', 'Training'])->pluck('id');
            $hrdRole->permissions()->sync($hrdPerms);
        }
    }
}
