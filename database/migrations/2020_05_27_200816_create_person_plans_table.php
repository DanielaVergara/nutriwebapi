<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_plans', function (Blueprint $table) {
            $table->id();
            $table->string('email',30);
            $table->string('goalDescription',100);
            $table->integer('goalCalories');
            $table->unsignedBigInteger('id_person')->nullable();
            $table->unsignedBigInteger('id_plan')->nullable();
            $table->foreign('id_person')->references('id')->on('people');
            $table->foreign('id_plan')->references('id')->on('plans');
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
        Schema::dropIfExists('person_plans');
    }
}
