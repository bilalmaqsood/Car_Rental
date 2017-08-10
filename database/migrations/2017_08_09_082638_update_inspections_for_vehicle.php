<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInspectionsForVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropColumn('booking_id');
            $table->dropColumn('data');
            $table->integer('vehicle_id')->after('id');
            $table->boolean('status')->after('vehicle_id')->default(0)->comment('0=added,1=disputed,2=resolved');
            $table->boolean('is_return')->after('status')->default(0)->comment('0=handover inspection, 1=return inspection');
            $table->string('x_axis', 10)->nullable()->after('type');
            $table->string('y_axis', 10)->nullable()->after('x_axis');
            $table->string('path')->nullable()->after('y_axis');
            $table->text('note')->nullable()->after('path');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('return_vehicle_id');
            $table->integer('inspection_id')->after('id');
        });

        Schema::dropIfExists('return_vehicles');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
