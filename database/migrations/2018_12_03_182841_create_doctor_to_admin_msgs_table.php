<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorToAdminMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_to_admin_msgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->longText('message');
            $table->string('email');
            $table->string('contact_number');
            $table->integer('doctorid');
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
        Schema::dropIfExists('doctor_to_admin_msgs');
    }
}
