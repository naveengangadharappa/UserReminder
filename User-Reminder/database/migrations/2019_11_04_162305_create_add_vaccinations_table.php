<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_vaccinations', function (Blueprint $table) {
            $table->increments('id');
            $table->String('ChildId');
            $table->String('VaccinationId')->unique();
            $table->String('VaccinationName');
            $table->String('VaccinationDuedate');
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
        Schema::drop('add_vaccinations');
    }
}
