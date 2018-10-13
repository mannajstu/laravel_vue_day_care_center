<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('child_name');
            $table->integer('parentid')->unsigned();
           
           
            $table->string('birth_date');
            $table->string('birth_reg_no');
            $table->string('gender');
            $table->string('doctor_name');
            $table->string('teacher_name');
            $table->integer('room_number')->unsigned();

            $table->foreign('parentid')->references('id')->on('parent_infos')
             ->onDelete('cascade');
             
               $table->foreign('room_number')->references('room_number')->on('rooms')->onUpdate('cascade');

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
        Schema::dropIfExists('child_infos');
    }
}
