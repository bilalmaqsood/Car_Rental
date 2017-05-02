<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->string('make', 50);
            $table->string('model', 50);
            $table->string('variant', 50);
            $table->string('year', 4);
            $table->decimal('mileage')->comment('mileage of vehicle');
            $table->string('fuel', 50)->comment('fuel type of vehicle');
            $table->string('mpg', 50)->comment('fuel consumption');
            $table->string('transmission');
            $table->string('seats', 50);
            $table->date('available_from');
            $table->date('available_to');
            $table->boolean('pickup')->comment('yes / no if pick by owner');
            $table->boolean('delivery')->comment('yes / no if delivery by owner');
            $table->string('location', 100)->comment('vehicle pickup location');
            $table->decimal('delivery_charges')->comment('delivery charges per week');
            $table->decimal('rent')->comment('rent per week');
            $table->decimal('insurance')->comment('insurance per week');
            $table->decimal('mile_cap')->comment('mileage Cap per week');
            $table->decimal('after_mile')->comment('after mileage per mile price');
            $table->decimal('deposit')->comment('deposit on vehicle booking');
            $table->json('discounts')->comment('discounts for vehicle booking according to week');
            $table->json('uber_discount')->comment('discounts for driver on booking according to uber api points');
            $table->json('images')->comment('images paths of vehicle');
            $table->integer('extension')->comment('Contract Extension Weeks');
            $table->integer('license_years')->comment('license older than years');
            $table->integer('pco_years')->comment('PCO license older than years');
            $table->integer('driver_year')->comment('driver older than years');
            $table->integer('license_points')->comment('maximum points on license');
            $table->string('no_fault_accident', 4)->comment('year since last accident with no driver fault');
            $table->string('fault_accident', 4)->comment('year since last accident with driver fault');
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
        Schema::dropIfExists('vehicles');
    }
}
