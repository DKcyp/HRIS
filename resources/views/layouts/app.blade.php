<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HRIS V2')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4e73df;
            --secondary-color: #858796;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            padding: 0.5rem 0;
        }
        
        /* Dashboard link (standalone, no collapse) */
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            padding-left: 2rem;
        }
        
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
            border-left: 4px solid white;
        }
        
        .sidebar-link i {
            width: 25px;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        /* Menu toggle (parent) */
        .menu-toggle {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        
        .menu-toggle:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .menu-toggle.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
        }
        
        .menu-toggle i:first-child {
            width: 25px;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        .menu-toggle .toggle-label {
            flex: 1;
        }
        
        .menu-toggle .toggle-icon {
            transition: transform 0.3s;
            font-size: 0.7rem;
        }
        
        .menu-toggle[aria-expanded="true"] .toggle-icon {
            transform: rotate(90deg);
        }
        
        /* Submenu container */
        .submenu {
            background-color: rgba(0,0,0,0.08);
        }
        
        .submenu .sidebar-link {
            padding-left: 3.25rem;
            font-size: 0.875rem;
        }
        
        .submenu .sidebar-link:hover {
            padding-left: 3.75rem;
        }
        
        .submenu .sidebar-link i {
            width: 20px;
            font-size: 0.8rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        /* Topbar */
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #5a5c69;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        /* Notification Dropdown */
        .notification-dropdown {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border-radius: 0.5rem;
        }
        
        .notification-item {
            padding: 0.75rem 1rem;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .notification-item:hover {
            background-color: #f8f9fc;
            border-left-color: var(--primary-color);
        }
        
        .notification-item.unread {
            background-color: #f0f4ff;
        }
        
        .notification-item.unread:hover {
            background-color: #e6ecff;
        }
        
        .notification-item p {
            font-size: 0.875rem;
            color: #5a5c69;
            line-height: 1.4;
        }
        
        .notification-icon {
            font-size: 0.875rem;
        }
        
        /* Content Area */
        .content-area {
            padding: 2rem;
        }
        
        /* Cards */
        .stat-card {
            border-radius: 0.5rem;
            border-left: 4px solid;
            padding: 1.5rem;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .stat-card.primary { border-left-color: #4e73df; }
        .stat-card.success { border-left-color: #1cc88a; }
        .stat-card.warning { border-left-color: #f6c23e; }
        .stat-card.danger { border-left-color: #e74a3b; }
        .stat-card.info { border-left-color: #36b9cc; }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #5a5c69;
        }
        
        .stat-label {
            color: var(--secondary-color);
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
        
        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-building me-2"></i> HRIS V2
        </div>
        
        <div class="sidebar-menu">
            @php
                $isActiveEmployee = request()->routeIs('employee.*');
                $isActiveOrganisasi = request()->routeIs('organisasi.*');
                $isActiveRecruitment = request()->routeIs('recruitment.*');
                $isActiveAttendance = request()->routeIs('attendance.*');
                $isActiveLeave = request()->routeIs('leave.*') || request()->routeIs('izin.*');
                $isActivePayroll = request()->routeIs('payroll.*');
                $isActivePerformance = request()->routeIs('performance.*');
                $isActiveTraining = request()->routeIs('training.*');
                $isActiveAsset = request()->routeIs('asset.*');
                $isActivePengumuman = request()->routeIs('pengumuman.*');
                $isActiveDokumen = request()->routeIs('dokumen.*');
                $isActiveResign = request()->routeIs('resign.*');
                $isActiveLaporan = request()->routeIs('laporan.*');
                $isActiveSystem = request()->routeIs('users.*') || request()->routeIs('roles.*');
            @endphp

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dashboard') }}')" data-spa="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <!-- Master Karyawan -->
            <button class="menu-toggle {{ $isActiveEmployee ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-employee" aria-expanded="{{ $isActiveEmployee ? 'true' : 'false' }}">
                <i class="fas fa-user-tie"></i>
                <span class="toggle-label">Master Karyawan</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveEmployee ? 'show' : '' }}" id="submenu-employee">
                <a href="{{ route('employee.index') }}" class="sidebar-link {{ request()->routeIs('employee.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.index') }}')" data-spa="{{ route('employee.index') }}"><i class="fas fa-users"></i><span>Data Karyawan</span></a>
                <a href="{{ route('employee.create') }}" class="sidebar-link {{ request()->routeIs('employee.create') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.create') }}')" data-spa="{{ route('employee.create') }}"><i class="fas fa-user-plus"></i><span>Tambah Karyawan</span></a>
                <a href="{{ route('employee.riwayat-jabatan') }}" class="sidebar-link {{ request()->routeIs('employee.riwayat-jabatan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.riwayat-jabatan') }}')" data-spa="{{ route('employee.riwayat-jabatan') }}"><i class="fas fa-history"></i><span>Riwayat Jabatan</span></a>
                <a href="{{ route('employee.riwayat-gaji') }}" class="sidebar-link {{ request()->routeIs('employee.riwayat-gaji') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.riwayat-gaji') }}')" data-spa="{{ route('employee.riwayat-gaji') }}"><i class="fas fa-money-bill-wave"></i><span>Riwayat Gaji</span></a>
                <a href="{{ route('employee.pendidikan') }}" class="sidebar-link {{ request()->routeIs('employee.pendidikan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.pendidikan') }}')" data-spa="{{ route('employee.pendidikan') }}"><i class="fas fa-graduation-cap"></i><span>Pendidikan</span></a>
                <a href="{{ route('employee.pengalaman') }}" class="sidebar-link {{ request()->routeIs('employee.pengalaman') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.pengalaman') }}')" data-spa="{{ route('employee.pengalaman') }}"><i class="fas fa-briefcase"></i><span>Pengalaman Kerja</span></a>
                <a href="{{ route('employee.sertifikat') }}" class="sidebar-link {{ request()->routeIs('employee.sertifikat') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.sertifikat') }}')" data-spa="{{ route('employee.sertifikat') }}"><i class="fas fa-certificate"></i><span>Sertifikat</span></a>
                <a href="{{ route('employee.dokumen') }}" class="sidebar-link {{ request()->routeIs('employee.dokumen') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.dokumen') }}')" data-spa="{{ route('employee.dokumen') }}"><i class="fas fa-id-card"></i><span>Dokumen</span></a>
                <a href="{{ route('employee.kontak-darurat') }}" class="sidebar-link {{ request()->routeIs('employee.kontak-darurat') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.kontak-darurat') }}')" data-spa="{{ route('employee.kontak-darurat') }}"><i class="fas fa-phone-alt"></i><span>Kontak Darurat</span></a>
                <a href="{{ route('employee.status') }}" class="sidebar-link {{ request()->routeIs('employee.status') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('employee.status') }}')" data-spa="{{ route('employee.status') }}"><i class="fas fa-toggle-on"></i><span>Status Aktif/Resign</span></a>
            </div>

            <!-- Organisasi -->
            <button class="menu-toggle {{ $isActiveOrganisasi ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-organisasi" aria-expanded="{{ $isActiveOrganisasi ? 'true' : 'false' }}">
                <i class="fas fa-sitemap"></i>
                <span class="toggle-label">Organisasi</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveOrganisasi ? 'show' : '' }}" id="submenu-organisasi">
                <a href="{{ route('organisasi.division') }}" class="sidebar-link {{ request()->routeIs('organisasi.division') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.division') }}')" data-spa="{{ route('organisasi.division') }}"><i class="fas fa-sitemap"></i><span>Divisi</span></a>
                <a href="{{ route('organisasi.department') }}" class="sidebar-link {{ request()->routeIs('organisasi.department') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.department') }}')" data-spa="{{ route('organisasi.department') }}"><i class="fas fa-building"></i><span>Departemen</span></a>
                <a href="{{ route('organisasi.position') }}" class="sidebar-link {{ request()->routeIs('organisasi.position') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.position') }}')" data-spa="{{ route('organisasi.position') }}"><i class="fas fa-briefcase"></i><span>Jabatan</span></a>
                <a href="{{ route('organisasi.grade') }}" class="sidebar-link {{ request()->routeIs('organisasi.grade') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.grade') }}')" data-spa="{{ route('organisasi.grade') }}"><i class="fas fa-layer-group"></i><span>Grade</span></a>
                <a href="{{ route('organisasi.location') }}" class="sidebar-link {{ request()->routeIs('organisasi.location') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.location') }}')" data-spa="{{ route('organisasi.location') }}"><i class="fas fa-map-marker-alt"></i><span>Lokasi Kerja</span></a>
                <a href="{{ route('organisasi.shift') }}" class="sidebar-link {{ request()->routeIs('organisasi.shift') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('organisasi.shift') }}')" data-spa="{{ route('organisasi.shift') }}"><i class="fas fa-clock"></i><span>Shift</span></a>
            </div>

            <!-- Recruitment -->
            <button class="menu-toggle {{ $isActiveRecruitment ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-recruitment" aria-expanded="{{ $isActiveRecruitment ? 'true' : 'false' }}">
                <i class="fas fa-user-tie"></i>
                <span class="toggle-label">Recruitment</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveRecruitment ? 'show' : '' }}" id="submenu-recruitment">
                <a href="{{ route('recruitment.index') }}" class="sidebar-link {{ request()->routeIs('recruitment.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.index') }}')" data-spa="{{ route('recruitment.index') }}"><i class="fas fa-bullhorn"></i><span>Lowongan</span></a>
                <a href="{{ route('recruitment.applicant') }}" class="sidebar-link {{ request()->routeIs('recruitment.applicant') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.applicant') }}')" data-spa="{{ route('recruitment.applicant') }}"><i class="fas fa-user-check"></i><span>Pelamar</span></a>
                <a href="{{ route('recruitment.interview') }}" class="sidebar-link {{ request()->routeIs('recruitment.interview') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.interview') }}')" data-spa="{{ route('recruitment.interview') }}"><i class="fas fa-comments"></i><span>Interview</span></a>
                <a href="{{ route('recruitment.psikotes') }}" class="sidebar-link {{ request()->routeIs('recruitment.psikotes') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.psikotes') }}')" data-spa="{{ route('recruitment.psikotes') }}"><i class="fas fa-brain"></i><span>Psikotes</span></a>
                <a href="{{ route('recruitment.offering') }}" class="sidebar-link {{ request()->routeIs('recruitment.offering') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.offering') }}')" data-spa="{{ route('recruitment.offering') }}"><i class="fas fa-file-signature"></i><span>Offering</span></a>
                <a href="{{ route('recruitment.hiring') }}" class="sidebar-link {{ request()->routeIs('recruitment.hiring') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('recruitment.hiring') }}')" data-spa="{{ route('recruitment.hiring') }}"><i class="fas fa-handshake"></i><span>Hiring</span></a>
            </div>

            <!-- Absensi -->
            <button class="menu-toggle {{ $isActiveAttendance ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-attendance" aria-expanded="{{ $isActiveAttendance ? 'true' : 'false' }}">
                <i class="fas fa-calendar-check"></i>
                <span class="toggle-label">Absensi</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveAttendance ? 'show' : '' }}" id="submenu-attendance">
                <a href="{{ route('attendance.checkin') }}" class="sidebar-link {{ request()->routeIs('attendance.checkin*') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('attendance.checkin') }}')" data-spa="{{ route('attendance.checkin') }}"><i class="fas fa-sign-in-alt"></i><span>Check In/Out</span></a>
                <a href="{{ route('attendance.index') }}" class="sidebar-link {{ request()->routeIs('attendance.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('attendance.index') }}')" data-spa="{{ route('attendance.index') }}"><i class="fas fa-calendar-check"></i><span>Rekap Absensi</span></a>
                <a href="{{ route('attendance.terlambat') }}" class="sidebar-link {{ request()->routeIs('attendance.terlambat') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('attendance.terlambat') }}')" data-spa="{{ route('attendance.terlambat') }}"><i class="fas fa-clock"></i><span>Terlambat</span></a>
                <a href="{{ route('attendance.overtime') }}" class="sidebar-link {{ request()->routeIs('attendance.overtime') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('attendance.overtime') }}')" data-spa="{{ route('attendance.overtime') }}"><i class="fas fa-business-time"></i><span>Lembur</span></a>
                <a href="{{ route('attendance.riwayat') }}" class="sidebar-link {{ request()->routeIs('attendance.riwayat') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('attendance.riwayat') }}')" data-spa="{{ route('attendance.riwayat') }}"><i class="fas fa-history"></i><span>Riwayat</span></a>
            </div>

            <!-- Cuti & Izin -->
            <button class="menu-toggle {{ $isActiveLeave ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-leave" aria-expanded="{{ $isActiveLeave ? 'true' : 'false' }}">
                <i class="fas fa-umbrella-beach"></i>
                <span class="toggle-label">Cuti & Izin</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveLeave ? 'show' : '' }}" id="submenu-leave">
                <a href="{{ route('leave.index') }}" class="sidebar-link {{ request()->routeIs('leave.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('leave.index') }}')" data-spa="{{ route('leave.index') }}"><i class="fas fa-umbrella-beach"></i><span>Pengajuan Cuti</span></a>
                <a href="{{ route('leave.approval') }}" class="sidebar-link {{ request()->routeIs('leave.approval') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('leave.approval') }}')" data-spa="{{ route('leave.approval') }}"><i class="fas fa-check-double"></i><span>Approval Cuti</span></a>
                <a href="{{ route('leave.jenis') }}" class="sidebar-link {{ request()->routeIs('leave.jenis') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('leave.jenis') }}')" data-spa="{{ route('leave.jenis') }}"><i class="fas fa-tags"></i><span>Jenis Cuti</span></a>
                <a href="{{ route('leave.sisa') }}" class="sidebar-link {{ request()->routeIs('leave.sisa') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('leave.sisa') }}')" data-spa="{{ route('leave.sisa') }}"><i class="fas fa-chart-pie"></i><span>Sisa Cuti</span></a>
                <a href="{{ route('leave.history') }}" class="sidebar-link {{ request()->routeIs('leave.history') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('leave.history') }}')" data-spa="{{ route('leave.history') }}"><i class="fas fa-history"></i><span>History Cuti</span></a>
                <a href="{{ route('izin.index') }}" class="sidebar-link {{ request()->routeIs('izin.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('izin.index') }}')" data-spa="{{ route('izin.index') }}"><i class="fas fa-file-medical"></i><span>Izin & Sakit</span></a>
                <a href="{{ route('izin.surat-dokter') }}" class="sidebar-link {{ request()->routeIs('izin.surat-dokter') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('izin.surat-dokter') }}')" data-spa="{{ route('izin.surat-dokter') }}"><i class="fas fa-file-prescription"></i><span>Surat Dokter</span></a>
                <a href="{{ route('izin.approval') }}" class="sidebar-link {{ request()->routeIs('izin.approval') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('izin.approval') }}')" data-spa="{{ route('izin.approval') }}"><i class="fas fa-check-double"></i><span>Approval Izin</span></a>
                <a href="{{ route('izin.history') }}" class="sidebar-link {{ request()->routeIs('izin.history') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('izin.history') }}')" data-spa="{{ route('izin.history') }}"><i class="fas fa-history"></i><span>History Izin</span></a>
            </div>

            <!-- Payroll -->
            <button class="menu-toggle {{ $isActivePayroll ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-payroll" aria-expanded="{{ $isActivePayroll ? 'true' : 'false' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span class="toggle-label">Payroll</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActivePayroll ? 'show' : '' }}" id="submenu-payroll">
                <a href="{{ route('payroll.gaji-pokok') }}" class="sidebar-link {{ request()->routeIs('payroll.gaji-pokok') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.gaji-pokok') }}')" data-spa="{{ route('payroll.gaji-pokok') }}"><i class="fas fa-coins"></i><span>Gaji Pokok</span></a>
                <a href="{{ route('payroll.tunjangan') }}" class="sidebar-link {{ request()->routeIs('payroll.tunjangan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.tunjangan') }}')" data-spa="{{ route('payroll.tunjangan') }}"><i class="fas fa-plus-circle"></i><span>Tunjangan</span></a>
                <a href="{{ route('payroll.bonus') }}" class="sidebar-link {{ request()->routeIs('payroll.bonus') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.bonus') }}')" data-spa="{{ route('payroll.bonus') }}"><i class="fas fa-gift"></i><span>Bonus</span></a>
                <a href="{{ route('payroll.potongan') }}" class="sidebar-link {{ request()->routeIs('payroll.potongan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.potongan') }}')" data-spa="{{ route('payroll.potongan') }}"><i class="fas fa-minus-circle"></i><span>Potongan</span></a>
                <a href="{{ route('payroll.bpjs') }}" class="sidebar-link {{ request()->routeIs('payroll.bpjs') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.bpjs') }}')" data-spa="{{ route('payroll.bpjs') }}"><i class="fas fa-heartbeat"></i><span>BPJS</span></a>
                <a href="{{ route('payroll.pajak') }}" class="sidebar-link {{ request()->routeIs('payroll.pajak') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.pajak') }}')" data-spa="{{ route('payroll.pajak') }}"><i class="fas fa-file-invoice"></i><span>Pajak</span></a>
                <a href="{{ route('payroll.index') }}" class="sidebar-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.index') }}')" data-spa="{{ route('payroll.index') }}"><i class="fas fa-money-bill-wave"></i><span>Gaji Karyawan</span></a>
                <a href="{{ route('payroll.slip') }}" class="sidebar-link {{ request()->routeIs('payroll.slip') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.slip') }}')" data-spa="{{ route('payroll.slip') }}"><i class="fas fa-receipt"></i><span>Slip Gaji</span></a>
                <a href="{{ route('payroll.rekap') }}" class="sidebar-link {{ request()->routeIs('payroll.rekap') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('payroll.rekap') }}')" data-spa="{{ route('payroll.rekap') }}"><i class="fas fa-file-alt"></i><span>Rekap Payroll</span></a>
            </div>

            <!-- Performance -->
            <button class="menu-toggle {{ $isActivePerformance ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-performance" aria-expanded="{{ $isActivePerformance ? 'true' : 'false' }}">
                <i class="fas fa-chart-line"></i>
                <span class="toggle-label">Performance</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActivePerformance ? 'show' : '' }}" id="submenu-performance">
                <a href="{{ route('performance.kpi') }}" class="sidebar-link {{ request()->routeIs('performance.kpi') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.kpi') }}')" data-spa="{{ route('performance.kpi') }}"><i class="fas fa-bullseye"></i><span>KPI</span></a>
                <a href="{{ route('performance.index') }}" class="sidebar-link {{ request()->routeIs('performance.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.index') }}')" data-spa="{{ route('performance.index') }}"><i class="fas fa-chart-line"></i><span>Penilaian</span></a>
                <a href="{{ route('performance.bulanan') }}" class="sidebar-link {{ request()->routeIs('performance.bulanan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.bulanan') }}')" data-spa="{{ route('performance.bulanan') }}"><i class="fas fa-calendar-month"></i><span>Penilaian Bulanan</span></a>
                <a href="{{ route('performance.tahunan') }}" class="sidebar-link {{ request()->routeIs('performance.tahunan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.tahunan') }}')" data-spa="{{ route('performance.tahunan') }}"><i class="fas fa-calendar-alt"></i><span>Penilaian Tahunan</span></a>
                <a href="{{ route('performance.target') }}" class="sidebar-link {{ request()->routeIs('performance.target') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.target') }}')" data-spa="{{ route('performance.target') }}"><i class="fas fa-crosshairs"></i><span>Target</span></a>
                <a href="{{ route('performance.feedback') }}" class="sidebar-link {{ request()->routeIs('performance.feedback') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('performance.feedback') }}')" data-spa="{{ route('performance.feedback') }}"><i class="fas fa-comment-dots"></i><span>Feedback</span></a>
            </div>

            <!-- Training -->
            <button class="menu-toggle {{ $isActiveTraining ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-training" aria-expanded="{{ $isActiveTraining ? 'true' : 'false' }}">
                <i class="fas fa-graduation-cap"></i>
                <span class="toggle-label">Training</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveTraining ? 'show' : '' }}" id="submenu-training">
                <a href="{{ route('training.index') }}" class="sidebar-link {{ request()->routeIs('training.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('training.index') }}')" data-spa="{{ route('training.index') }}"><i class="fas fa-graduation-cap"></i><span>Jadwal Training</span></a>
                <a href="{{ route('training.peserta') }}" class="sidebar-link {{ request()->routeIs('training.peserta') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('training.peserta') }}')" data-spa="{{ route('training.peserta') }}"><i class="fas fa-users"></i><span>Peserta</span></a>
                <a href="{{ route('training.sertifikat') }}" class="sidebar-link {{ request()->routeIs('training.sertifikat') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('training.sertifikat') }}')" data-spa="{{ route('training.sertifikat') }}"><i class="fas fa-certificate"></i><span>Sertifikat</span></a>
                <a href="{{ route('training.nilai') }}" class="sidebar-link {{ request()->routeIs('training.nilai') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('training.nilai') }}')" data-spa="{{ route('training.nilai') }}"><i class="fas fa-star"></i><span>Nilai</span></a>
            </div>

            <!-- Asset -->
            <button class="menu-toggle {{ $isActiveAsset ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-asset" aria-expanded="{{ $isActiveAsset ? 'true' : 'false' }}">
                <i class="fas fa-laptop"></i>
                <span class="toggle-label">Asset</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveAsset ? 'show' : '' }}" id="submenu-asset">
                <a href="{{ route('asset.index') }}" class="sidebar-link {{ request()->routeIs('asset.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('asset.index') }}')" data-spa="{{ route('asset.index') }}"><i class="fas fa-laptop"></i><span>Data Asset</span></a>
                <a href="{{ route('asset.peminjaman') }}" class="sidebar-link {{ request()->routeIs('asset.peminjaman') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('asset.peminjaman') }}')" data-spa="{{ route('asset.peminjaman') }}"><i class="fas fa-hand-holding"></i><span>Peminjaman</span></a>
                <a href="{{ route('asset.pengembalian') }}" class="sidebar-link {{ request()->routeIs('asset.pengembalian') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('asset.pengembalian') }}')" data-spa="{{ route('asset.pengembalian') }}"><i class="fas fa-undo-alt"></i><span>Pengembalian</span></a>
            </div>

            <!-- Pengumuman -->
            <button class="menu-toggle {{ $isActivePengumuman ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-pengumuman" aria-expanded="{{ $isActivePengumuman ? 'true' : 'false' }}">
                <i class="fas fa-bullhorn"></i>
                <span class="toggle-label">Pengumuman</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActivePengumuman ? 'show' : '' }}" id="submenu-pengumuman">
                <a href="{{ route('pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('pengumuman.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('pengumuman.index') }}')" data-spa="{{ route('pengumuman.index') }}"><i class="fas fa-bullhorn"></i><span>News</span></a>
                <a href="{{ route('pengumuman.event') }}" class="sidebar-link {{ request()->routeIs('pengumuman.event') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('pengumuman.event') }}')" data-spa="{{ route('pengumuman.event') }}"><i class="fas fa-calendar-day"></i><span>Event</span></a>
                <a href="{{ route('pengumuman.birthday') }}" class="sidebar-link {{ request()->routeIs('pengumuman.birthday') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('pengumuman.birthday') }}')" data-spa="{{ route('pengumuman.birthday') }}"><i class="fas fa-birthday-cake"></i><span>Birthday</span></a>
                <a href="{{ route('pengumuman.libur-nasional') }}" class="sidebar-link {{ request()->routeIs('pengumuman.libur-nasional') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('pengumuman.libur-nasional') }}')" data-spa="{{ route('pengumuman.libur-nasional') }}"><i class="fas fa-calendar-times"></i><span>Libur Nasional</span></a>
            </div>

            <!-- Dokumen -->
            <button class="menu-toggle {{ $isActiveDokumen ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-dokumen" aria-expanded="{{ $isActiveDokumen ? 'true' : 'false' }}">
                <i class="fas fa-folder-open"></i>
                <span class="toggle-label">Dokumen</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveDokumen ? 'show' : '' }}" id="submenu-dokumen">
                <a href="{{ route('dokumen.index') }}" class="sidebar-link {{ request()->routeIs('dokumen.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.index') }}')" data-spa="{{ route('dokumen.index') }}"><i class="fas fa-folder-open"></i><span>Semua Dokumen</span></a>
                <a href="{{ route('dokumen.sop') }}" class="sidebar-link {{ request()->routeIs('dokumen.sop') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.sop') }}')" data-spa="{{ route('dokumen.sop') }}"><i class="fas fa-book"></i><span>SOP</span></a>
                <a href="{{ route('dokumen.kontrak') }}" class="sidebar-link {{ request()->routeIs('dokumen.kontrak') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.kontrak') }}')" data-spa="{{ route('dokumen.kontrak') }}"><i class="fas fa-file-contract"></i><span>Kontrak</span></a>
                <a href="{{ route('dokumen.pkwt') }}" class="sidebar-link {{ request()->routeIs('dokumen.pkwt') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.pkwt') }}')" data-spa="{{ route('dokumen.pkwt') }}"><i class="fas fa-file-signature"></i><span>PKWT</span></a>
                <a href="{{ route('dokumen.nda') }}" class="sidebar-link {{ request()->routeIs('dokumen.nda') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.nda') }}')" data-spa="{{ route('dokumen.nda') }}"><i class="fas fa-file-shield"></i><span>NDA</span></a>
                <a href="{{ route('dokumen.surat-peringatan') }}" class="sidebar-link {{ request()->routeIs('dokumen.surat-peringatan') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('dokumen.surat-peringatan') }}')" data-spa="{{ route('dokumen.surat-peringatan') }}"><i class="fas fa-exclamation-triangle"></i><span>Surat Peringatan</span></a>
            </div>

            <!-- Resign -->
            <button class="menu-toggle {{ $isActiveResign ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-resign" aria-expanded="{{ $isActiveResign ? 'true' : 'false' }}">
                <i class="fas fa-door-open"></i>
                <span class="toggle-label">Resign</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveResign ? 'show' : '' }}" id="submenu-resign">
                <a href="{{ route('resign.index') }}" class="sidebar-link {{ request()->routeIs('resign.index') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('resign.index') }}')" data-spa="{{ route('resign.index') }}"><i class="fas fa-door-open"></i><span>Pengajuan Resign</span></a>
                <a href="{{ route('resign.exit-interview') }}" class="sidebar-link {{ request()->routeIs('resign.exit-interview') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('resign.exit-interview') }}')" data-spa="{{ route('resign.exit-interview') }}"><i class="fas fa-comments"></i><span>Exit Interview</span></a>
                <a href="{{ route('resign.clearance') }}" class="sidebar-link {{ request()->routeIs('resign.clearance') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('resign.clearance') }}')" data-spa="{{ route('resign.clearance') }}"><i class="fas fa-clipboard-check"></i><span>Clearance</span></a>
                <a href="{{ route('resign.pengembalian-asset') }}" class="sidebar-link {{ request()->routeIs('resign.pengembalian-asset') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('resign.pengembalian-asset') }}')" data-spa="{{ route('resign.pengembalian-asset') }}"><i class="fas fa-undo-alt"></i><span>Pengembalian Asset</span></a>
            </div>

            <!-- Laporan -->
            <button class="menu-toggle {{ $isActiveLaporan ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-laporan" aria-expanded="{{ $isActiveLaporan ? 'true' : 'false' }}">
                <i class="fas fa-file-alt"></i>
                <span class="toggle-label">Laporan</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveLaporan ? 'show' : '' }}" id="submenu-laporan">
                <a href="{{ route('laporan.attendance') }}" class="sidebar-link {{ request()->routeIs('laporan.attendance') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.attendance') }}')" data-spa="{{ route('laporan.attendance') }}"><i class="fas fa-calendar-check"></i><span>Laporan Absensi</span></a>
                <a href="{{ route('laporan.leave') }}" class="sidebar-link {{ request()->routeIs('laporan.leave') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.leave') }}')" data-spa="{{ route('laporan.leave') }}"><i class="fas fa-umbrella-beach"></i><span>Laporan Cuti</span></a>
                <a href="{{ route('laporan.payroll') }}" class="sidebar-link {{ request()->routeIs('laporan.payroll') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.payroll') }}')" data-spa="{{ route('laporan.payroll') }}"><i class="fas fa-money-bill-wave"></i><span>Laporan Payroll</span></a>
                <a href="{{ route('laporan.turnover') }}" class="sidebar-link {{ request()->routeIs('laporan.turnover') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.turnover') }}')" data-spa="{{ route('laporan.turnover') }}"><i class="fas fa-exchange-alt"></i><span>Laporan Turnover</span></a>
                <a href="{{ route('laporan.employee') }}" class="sidebar-link {{ request()->routeIs('laporan.employee') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.employee') }}')" data-spa="{{ route('laporan.employee') }}"><i class="fas fa-users"></i><span>Laporan Karyawan</span></a>
                <a href="{{ route('laporan.lembur') }}" class="sidebar-link {{ request()->routeIs('laporan.lembur') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('laporan.lembur') }}')" data-spa="{{ route('laporan.lembur') }}"><i class="fas fa-business-time"></i><span>Laporan Lembur</span></a>
            </div>

            <!-- System -->
            <button class="menu-toggle {{ $isActiveSystem ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#submenu-system" aria-expanded="{{ $isActiveSystem ? 'true' : 'false' }}">
                <i class="fas fa-cog"></i>
                <span class="toggle-label">System</span>
                <i class="fas fa-chevron-right toggle-icon"></i>
            </button>
            <div class="collapse submenu {{ $isActiveSystem ? 'show' : '' }}" id="submenu-system">
                <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('users.index') }}')" data-spa="{{ route('users.index') }}"><i class="fas fa-users-cog"></i><span>User Management</span></a>
                <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" onclick="navigateTo(event, '{{ route('roles.index') }}')" data-spa="{{ route('roles.index') }}"><i class="fas fa-user-shield"></i><span>Role & Permission</span></a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="page-title">
                @yield('page-title', 'Dashboard')
            </div>
            
            <div class="user-info">
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fa-lg text-muted"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            5
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown" style="width: 360px; max-height: 400px; overflow-y: auto;">
                        <h6 class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifikasi</span>
                            <small class="text-primary" style="cursor: pointer;">Tandai semua sudah dibaca</small>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item notification-item unread">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon bg-primary text-white rounded-circle me-3" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1">Pengajuan cuti dari <strong>Budi Santoso</strong> menunggu persetujuan</p>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>5 menit yang lalu</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item notification-item unread">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon bg-success text-white rounded-circle me-3" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1">Gaji bulan <strong>Maret 2024</strong> berhasil di-generate</p>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>1 jam yang lalu</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item notification-item unread">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon bg-warning text-white rounded-circle me-3" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1">Kontrak kerja <strong>Siti Rahayu</strong> akan berakhir dalam 30 hari</p>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>2 jam yang lalu</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item notification-item">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon bg-info text-white rounded-circle me-3" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1">Training <strong>Digital Marketing</strong> akan dimulai besok</p>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>3 jam yang lalu</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item notification-item">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon bg-secondary text-white rounded-circle me-3" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1">Pengumuman baru: <strong>Pembaruan Sistem HRIS V2</strong></p>
                                    <small class="text-muted"><i class="fas fa-clock me-1"></i>1 hari yang lalu</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center text-primary">
                            <i class="fas fa-bell me-1"></i>Lihat Semua Notifikasi
                        </a>
                    </div>
                </div>
                <span class="text-muted">{{ Auth::user()->nama ?? 'Guest' }}</span>
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->nama ?? 'G', 0, 1)) }}
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text"><small class="text-muted">{{ Auth::user()->role ?? '' }}</small></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="content-area" id="content-area">
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    (function() {
        const contentArea = document.getElementById('content-area');
        let currentUrl = window.location.href;

        // Navigate via SPA
        window.navigateTo = function(e, url) {
            e.preventDefault();
            if (url === currentUrl) return;
            loadPage(url);
        };

        function loadPage(url, pushState) {
            if (pushState === undefined) pushState = true;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newContent = doc.getElementById('content-area');
                const newPageTitle = doc.querySelector('.page-title');
                const newTitle = doc.querySelector('title');

                if (newContent) {
                    // Extract scripts before replacing content
                    const scripts = newContent.querySelectorAll('script');
                    const scriptContents = [];
                    scripts.forEach(s => {
                        scriptContents.push(s.textContent);
                        s.remove();
                    });

                    // Replace content (without scripts)
                    contentArea.innerHTML = newContent.innerHTML;

                    // Re-execute scripts
                    scriptContents.forEach(code => {
                        const s = document.createElement('script');
                        s.textContent = code;
                        document.body.appendChild(s);
                        document.body.removeChild(s);
                    });
                }

                // Update page title in topbar
                if (newPageTitle) {
                    document.querySelector('.page-title').textContent = newPageTitle.textContent.trim();
                }

                // Update browser title
                if (newTitle) {
                    document.title = newTitle.textContent;
                }

                // Update URL
                if (pushState) {
                    history.pushState({}, '', url);
                }
                currentUrl = url;

                // Update active menu
                updateActiveMenu(url);

                // Scroll to top
                window.scrollTo(0, 0);
            })
            .catch(err => {
                console.error('SPA navigation error:', err);
                window.location.href = url;
            });
        }

        function updateActiveMenu(url) {
            document.querySelectorAll('[data-spa]').forEach(link => {
                link.classList.remove('active');
            });

            document.querySelectorAll('[data-spa]').forEach(link => {
                const href = link.getAttribute('data-spa');
                if (url === href || url.replace(/\/$/, '') === href.replace(/\/$/, '')) {
                    link.classList.add('active');

                    const submenu = link.closest('.submenu');
                    if (submenu) {
                        submenu.classList.add('show');
                        const toggle = document.querySelector('[data-bs-target="#' + submenu.id + '"]');
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'true');
                            toggle.classList.add('active');
                        }
                    }
                }
            });
        }

        // Handle browser back/forward
        window.addEventListener('popstate', function(e) {
            loadPage(window.location.href, false);
        });

        // Handle initial page
        updateActiveMenu(window.location.href);
    })();
    </script>
    
    @stack('scripts')
</body>
</html>
