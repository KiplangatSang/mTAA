<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionPlotsTable extends Migration
{
    /**
     * Run the migrations.s
     *
     */
    public function up()
    {
        Schema::create('session_plots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("sessionable_id");
            $table->string("sessionable_type");
            $table->bigInteger('plot_location_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('session_plots');
    }
}
