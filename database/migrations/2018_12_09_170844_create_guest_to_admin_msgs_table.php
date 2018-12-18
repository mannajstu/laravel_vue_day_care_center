<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestToAdminMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_to_admin_msgs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('subject');
            $table->longText('message');
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
        Schema::dropIfExists('guest_to_admin_msgs');
    }
}
