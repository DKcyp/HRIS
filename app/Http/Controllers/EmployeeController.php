<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Sample data - nanti diganti dengan query database
        $employees = [];
        
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        // Logic untuk simpan data karyawan
        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        return view('employee.show', ['id' => $id]);
    }

    public function edit(string $id)
    {
        return view('employee.edit', ['id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        // Logic untuk update data karyawan
        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diupdate');
    }

    public function destroy(string $id)
    {
        // Logic untuk hapus data karyawan
        return redirect()->route('employee.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
