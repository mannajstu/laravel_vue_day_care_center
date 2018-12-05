<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('birth_reg_no')->unique();
            $table->string('gender');
            
            $table->integer('doctorid')->unsigned()->nullable();

            $table->integer('teacherid')->unsigned()->nullable();
            
            $table->integer('room_number')->unsigned()->nullable();
            $table->integer('class_number')->unsigned()->nullable();

            $table->foreign('parentid')->references('id')->on('parent_infos')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('room_number')->references('room_number')->on('rooms')->onUpdate('cascade')->onDelete('set null');

            $table->foreign('doctorid')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('teacherid')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('class_number')->references('class_number')->on('class_infos')->onUpdate('cascade')->onDelete('set null');

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
