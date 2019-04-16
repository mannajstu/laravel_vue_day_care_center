<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tem_children', function (Blueprint $table) {
            $table->increments('id');
             $table->string('child_name');

            $table->string('birth_date');
            $table->string('birth_reg_no')->unique();
            $table->string('gender');
            $table->string('mother_name');
            $table->string('father_name');
           
            $table->string('contact_address');
            $table->string('email');
            $table->string('contact_number');
            
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
        Schema::dropIfExists('tem_children');
    }
}
