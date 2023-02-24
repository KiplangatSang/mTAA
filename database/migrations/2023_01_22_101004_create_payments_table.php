<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payable_id');
            $table->string('payable_type');
            $table->bigInteger('house_id');
            $table->bigInteger('tenant_id')->nullable();
            $table->bigInteger('landlord_id')->nullable();
            $table->string('gateway');
            $table->string('confirmation');
            $table->string('sender')->nullable();
            $table->string('receiver')->nullable();
            $table->double('amount');
            $table->string('purpose');
            $table->string('sender_account');
            $table->string('receiver_account');
            $table->string('reference');
            $table->boolean('status');
            $table->boolean('on_hold');
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
        Schema::dropIfExists('payments');
    }
}
