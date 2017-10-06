<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeslotsSignaturesTimeToBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string("pickup_time")->nullable();
            $table->date("owner_signature_date")->nullable();
            $table->date("client_signature_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('pickup_time');
            $table->dropColumn('owner_signature_date');
            $table->dropColumn('client_signature_date');
        });
    }
}
