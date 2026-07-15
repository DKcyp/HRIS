<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('pgsql')->create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('agama')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('email')->unique();
            $table->string('telepon');
            $table->string('no_bpjs')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('divisi');
            $table->string('departemen');
            $table->string('jabatan');
            $table->string('grade')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->string('status_kepegawaian');
            $table->date('tanggal_masuk');
            $table->date('tanggal_kontrak_habis')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'kontrak', 'resign'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('pegawai');
    }
};
