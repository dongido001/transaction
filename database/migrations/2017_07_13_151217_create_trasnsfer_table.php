<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasnsferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference', 100);
            $table->string('by', 100);
            $table->string('status', 100); //failed, in_progress, completed
            $table->string('data', 100); //failed, in_progress, completed
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
        //
    }
}
