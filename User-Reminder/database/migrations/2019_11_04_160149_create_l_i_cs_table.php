<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLICsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_i_c_s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->String('Policynumber')->unique();
            $table->String('PolicyHolder');
            $table->String('LicPlanName');
            $table->String('DateOfPurchase');
            $table->String('SumAssuredAmount');
            $table->String('PremiumAmount');
            $table->String('PremiumPayingTerm');
            $table->String('ReminderFrequency');
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
        Schema::drop('l_i_c_s');
    }
}
