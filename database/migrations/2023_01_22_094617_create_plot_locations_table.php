<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plot_locationable_id');
            $table->string('plot_locationable_type');
            $table->bigInteger('landlord_id')->nullable();
            $table->bigInteger('caretaker_id')->nullable();
            $table->string('name');
            $table->longText('location')->nullable();
            $table->longText('gate')->nullable();
            $table->integer('no_of_houses');
            $table->longText('house_types');
            $table->string('town');
            $table->string('city')->nullable();
            $table->string('constituency');
            $table->string('county');
            $table->string('country');
            $table->string("account_type")->nullable();
            $table->string("account")->nullable();
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
        Schema::dropIfExists('plot_locations');
    }
}
