<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermintaanDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('permintaan_id');
            $table->string('judul');
            $table->string('nomor');
            $table->string('kode_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('kode_output');
            $table->string('output');
            $table->string('kode_komponen');
            $table->string('komponen');
            $table->string('kode_subkomponen');
            $table->string('sub_komponen');
            $table->string('grup_akun');
            $table->string('jenis_pengadaan')->nullable();
            $table->integer('nilai');
            $table->date('date_mulai');
            $table->date('date_selesai');
            $table->date('date_created_form');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan_data');
    }
}
