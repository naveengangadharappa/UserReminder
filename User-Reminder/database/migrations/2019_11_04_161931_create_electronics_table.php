<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->String('ItemName');
            $table->String('Itemnumber')->unique();
            $table->date('DateOfPurchase');
            $table->String('WarrantyPeriod');
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
        Schema::drop('electronics');
    }
}
