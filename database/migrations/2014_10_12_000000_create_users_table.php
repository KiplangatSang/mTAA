<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        *role => 0=> admin 1= tenant 2=> landord
        */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userable_id')->nullable();
            $table->string('userable_type')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phoneno');
            $table->string('payment_number')->nullable();
            $table->string('terms_and_conditions')->default(true);
            $table->unsignedBigInteger('userpin')->nullable()->default(null);
            $table->boolean('is_tenant')->default(true);
            $table->boolean('is_landlord')->default(false);
            $table->boolean('is_caretaker')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->integer('role')->default(1);
            $table->boolean('is_suspended')->default(false);
            $table->string('api_token');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('month');
            $table->integer('year');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
