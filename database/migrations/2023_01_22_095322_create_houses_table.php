<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('house_id');
            $table->bigInteger('housable_id');
            $table->string('housable_type');
            $table->bigInteger('caretaker_id');
            $table->bigInteger('tenant_id');
            $table->bigInteger('plot_location_id');
            $table->longText('pictures')->nullable();
            $table->string('price');
            $table->string('type');
            $table->string('size');
            $table->integer('floor')->default(0);
            $table->integer('available')->default(1);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('houses');
    }
}
