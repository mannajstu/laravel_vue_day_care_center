<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childexam', function (Blueprint $table) {
            $table->integer('childid')->unsigned()->nullable();
            $table->foreign('childid')->references('id')
                ->on('child_infos')->onDelete('cascade');

            $table->integer('examid')->unsigned()->nullable();
            $table->foreign('examid')->references('id')
                ->on('exams')->onDelete('cascade');
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
        Schema::dropIfExists('childexam');
    }
}
