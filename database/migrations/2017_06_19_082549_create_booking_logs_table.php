<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('booking_id');

            $table->integer('requested_id')->nullable();
            $table->json('requested_data')->nullable();
            $table->text('requested_note')->nullable();
            $table->dateTime('requested_time')->nullable();

            $table->integer('fulfilled_id')->nullable();
            $table->json('fulfilled_data')->nullable();
            $table->text('fulfilled_note')->nullable();
            $table->dateTime('fulfilled_time')->nullable();

            $table->boolean('status')->default(1)->comment('1=active, 2=done');
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('booking_logs');
    }
}
