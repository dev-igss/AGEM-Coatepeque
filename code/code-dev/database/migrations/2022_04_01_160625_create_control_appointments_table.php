<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('amount_rx');
            $table->integer('amount_rx_special');
            $table->integer('amount_usg');
            $table->integer('amount_usg_doppler');
            $table->integer('amount_mmo');
            $table->integer('amount_dmo');
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
        Schema::dropIfExists('control_appointments');
    }
}
