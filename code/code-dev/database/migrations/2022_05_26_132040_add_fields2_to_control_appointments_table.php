<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields2ToControlAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('control_appointments', function (Blueprint $table) {
            $table->integer('amount_rx_special_am')->after('amount_rx_special')->nullable();
            $table->integer('amount_rx_special_pm')->after('amount_rx_special_am')->nullable();
            $table->integer('amount_usg_am')->after('amount_usg')->nullable();
            $table->integer('amount_usg_pm')->after('amount_usg_am')->nullable();
            $table->integer('amount_mmo_am')->after('amount_mmo')->nullable();
            $table->integer('amount_mmo_pm')->after('amount_mmo_am')->nullable();
            $table->integer('amount_dmo_am')->after('amount_dmo')->nullable();
            $table->integer('amount_dmo_pm')->after('amount_dmo_am')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control_appointments', function (Blueprint $table) {
            //
        });
    }
}
