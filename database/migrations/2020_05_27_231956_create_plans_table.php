<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('names',30);
            $table->bigInteger('calories');
            $table->string('description',100);
            $table->string('endDate',30);
            $table->string('startDate',30);
            $table->string('goalWeight',30);
            //$table->unsignedBigInteger('id_person');
            //$table->foreign('id_person')->references('id')->on('people');
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
        Schema::dropIfExists('plans');
    }
}
