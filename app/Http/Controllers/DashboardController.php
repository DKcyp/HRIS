<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Sample data - nanti diganti dengan data real dari database
        $data = [
            'totalKaryawan' => 150,
            'karyawanBaru' => 5,
            'karyawanResign' => 2,
            'kontrakHabis' => 3,
            'absensiHariIni' => 142,
            'cutiPending' => 7,
            'terlambat' => 5,
            'totalLembur' => 128,
            'pengumumanList' => [],
            'birthdayList' => []
        ];
        
        return view('dashboard', $data);
    }
}
