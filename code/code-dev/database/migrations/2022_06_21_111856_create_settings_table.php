<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount_rx');
            $table->integer('amount_rx_emer_hosp');
            $table->integer('amount_rx_special_am');
            $table->integer('amount_rx_special_pm');
            $table->integer('amount_usg_emer_hosp');
            $table->integer('amount_usg_am');
            $table->integer('amount_usg_pm');
            $table->integer('amount_usg_doppler_am');
            $table->integer('amount_usg_doppler_pm');
            $table->integer('amount_mmo_emer_hosp');
            $table->integer('amount_mmo_am');
            $table->integer('amount_mmo_pm');
            $table->integer('amount_dmo_emer_hosp');
            $table->integer('amount_dmo_am');
            $table->integer('amount_dmo_pm');
            $table->integer('correlative_rx');
            $table->integer('correlative_usg');
            $table->integer('correlative_mmo');
            $table->integer('correlative_dmo');
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
        Schema::dropIfExists('settings');
    }
}
