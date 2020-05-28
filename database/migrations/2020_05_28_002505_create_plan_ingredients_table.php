<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_plan');
            $table->unsignedBigInteger('id_ingredient');
            $table->foreign('id_plan')->references('id')->on('plans');
            $table->foreign('id_ingredient')->references('id')->on('ingredients');
            $table->string('hour',200)->nullable();
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
        Schema::dropIfExists('plan_ingredients');
    }
}
