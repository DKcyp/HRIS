<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_nikah',
        'golongan_darah',
        'email',
        'telepon',
        'no_bpjs',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'divisi',
        'departemen',
        'jabatan',
        'grade',
        'lokasi_kerja',
        'status_kepegawaian',
        'tanggal_masuk',
        'tanggal_kontrak_habis',
        'no_ktp',
        'no_npwp',
        'no_kk',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_kontrak_habis' => 'date',
    ];
}
