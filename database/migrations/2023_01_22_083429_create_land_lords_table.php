<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandLordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_lords', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("landlordable_id");
            $table->string("landlordable_type");
            $table->string("contact_phone_number_1");
            $table->string("contact_phone_number_2");
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
        Schema::dropIfExists('land_lords');
    }
}
