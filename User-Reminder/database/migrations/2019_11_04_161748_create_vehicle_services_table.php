<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_services', function (Blueprint $table) {
            $table->increments('id');
            $table->String('VehicleType');
            $table->String('VehicleNumber')->unique();
            $table->date('DateOfPurchase');
            $table->date('Servicing1DueDate');
            $table->date('Servicing2DueDate');
            $table->date('Servicing3DueDate');
            $table->date('PUCExpirydate');
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
        Schema::drop('vehicle_services');
    }
}
