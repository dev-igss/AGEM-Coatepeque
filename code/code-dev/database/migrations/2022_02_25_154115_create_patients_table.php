<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id');
            $table->string('affiliation');            
            $table->string('name');
            $table->string('lastname');
            $table->date('birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('num_rx')->nullable();  
            $table->string('num_usg')->nullable();
            $table->string('num_mmo')->nullable();  
            $table->string('num_dmo')->nullable();            
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
