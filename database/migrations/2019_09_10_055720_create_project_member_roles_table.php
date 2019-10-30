<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMemberRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_member_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('projectId');
            $table->unsignedInteger('userId');
            $table->string('roleId',2)->nullable();
            $table->text('label')->nullable();
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
        Schema::dropIfExists('project_member_roles');
    }
}
