<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposisiPermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi_permintaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('permintaan_id');
            $table->unsignedInteger('from_id');
            $table->unsignedInteger('to_id');
            $table->unsignedInteger('disposisi_level');
            $table->string('konten');
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
        Schema::dropIfExists('disposisi_permintaans');
    }
}
