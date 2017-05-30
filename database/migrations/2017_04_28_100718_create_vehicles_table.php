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
            $table->integer('year');
            $table->decimal('mileage')->nullable()->comment('mileage of vehicle');
            $table->string('fuel', 50)->nullable()->comment('fuel type of vehicle');
            $table->string('mpg', 50)->nullable()->comment('fuel consumption');
            $table->string('transmission')->nullable();
            $table->string('seats', 50)->nullable();
            $table->date('available_from');
            $table->date('available_to');
            $table->boolean('pickup')->comment('yes / no if pick by owner');
            $table->boolean('delivery')->comment('yes / no if delivery by owner');
            $table->string('location', 100)->comment('vehicle pickup location in latitude and longitude');
            $table->decimal('delivery_charges')->comment('delivery charges per week');
            $table->decimal('rent')->comment('rent per week');
            $table->decimal('insurance')->comment('insurance per week');
            $table->decimal('mile_cap')->comment('mileage Cap per week');
            $table->decimal('after_mile')->comment('after mileage per mile price');
            $table->decimal('deposit')->comment('deposit on vehicle booking');
            $table->json('discounts')->nullable()->comment('discounts for vehicle booking according to week');
            $table->json('uber_discount')->nullable()->comment('discounts for driver on booking according to uber api points');
            $table->json('images')->nullable()->comment('images paths of vehicle');
            $table->json('documents')->nullable()->comment('documents of vehicle');
            $table->integer('extension')->nullable()->comment('Contract Extension Weeks');
            $table->integer('license_years')->nullable()->comment('license older than years');
            $table->integer('pco_years')->nullable()->comment('PCO license older than years');
            $table->integer('driver_year')->nullable()->comment('driver older than years');
            $table->integer('license_points')->nullable()->comment('maximum points on license');
            $table->string('no_fault_accident', 4)->nullable()->comment('year since last accident with no driver fault');
            $table->string('fault_accident', 4)->nullable()->comment('year since last accident with driver fault');
            $table->text('notes')->nullable()->comment('important notes for vehicle');
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
