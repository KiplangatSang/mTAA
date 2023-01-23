<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaretakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caretakers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("caretakerable_id");
            $table->string("caretakerable_type");
            $table->bigInteger("user_id")->nullable();
            $table->bigInteger("landlord_id");
            $table->string("role");
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
        Schema::dropIfExists('caretakers');
    }
}
