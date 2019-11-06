<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediclaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediclaims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('PolicyNumber')->unique();
            $table->string('MediclaimCompany');
            $table->string('DateOfPurchase');
            $table->string('PremiumAmount');
            $table->string('ReminderFrequency');
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
        Schema::drop('mediclaims');
    }
}
