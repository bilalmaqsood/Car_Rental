<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location')->nullable();
            $table->decimal('deposit');
            $table->json('documents')->nullable()->comment('documents or contracts of booking');
            $table->boolean('status')->default(0)->comment('0=Requested, 1=Confirmed, 2=Signed by client, 3=Signed by owner, 4=Accepted, 5=Cancel, 6=Canceled, 7=Extend, 8=Extended, 9=Close');
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
        Schema::dropIfExists('bookings');
    }
}
