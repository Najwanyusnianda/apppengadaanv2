<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermintaanGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('permintaan_id');
            $table->unsignedInteger('id_kulp')->nullable();
            $table->string('nama_kulp')->nullable();
            $table->string('nip_kulp')->nullable();
            $table->unsignedInteger('id_kasi')->nullable();
            $table->string('nama_kasi')->nullable();
            $table->string('nip_kasi')->nullable();
            $table->unsignedInteger('id_staf')->nullable();
            $table->string('nama_staf')->nullable();
            $table->string('nip_staf')->nullable();
            $table->unsignedInteger('ppkId')->nullable();
            $table->string('nama_ppk')->nullable();
            $table->string('nip_ppk')->nullable();
            $table->string('label_ppk')->nullable();
            $table->unsignedInteger('ppId')->nullable();
            $table->string('nama_pp')->nullable();
            $table->string('nip_pp')->nullable();
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
        Schema::dropIfExists('permintaan_groups');
    }
}
