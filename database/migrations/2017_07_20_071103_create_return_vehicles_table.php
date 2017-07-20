<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->string('type', 50);
            $table->json('data');
            $table->boolean('status')->default(0)->comment('0=added,1=disputed,2=resolved');
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
        Schema::dropIfExists('return_vehicles');
    }
}
