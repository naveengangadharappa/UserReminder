<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenVaccinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_vaccins', function (Blueprint $table) {
            $table->increments('id');
            $table->String('email');
            $table->String('ChildId')->unique();
            $table->String('ChildName');
            $table->date('DateOfBirth');
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
        Schema::drop('children_vaccins');
    }
}
