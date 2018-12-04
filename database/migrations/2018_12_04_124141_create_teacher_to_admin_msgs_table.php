<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherToAdminMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_to_admin_msgs', function (Blueprint $table) {
            $table->increments('id');
             $table->string('subject');
            $table->longText('message');
            $table->string('email');
            $table->string('contact_number');
            $table->integer('teacherid');
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
        Schema::dropIfExists('teacher_to_admin_msgs');
    }
}
