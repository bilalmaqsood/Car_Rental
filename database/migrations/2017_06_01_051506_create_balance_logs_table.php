<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('balance_id')->index();
            $table->integer('loggable_id')->index();
            $table->string('loggable_type')->index();

            $table->decimal('amount');
            $table->text('comment');

            $table->text('payment_response')->nullable();

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
        Schema::dropIfExists('balance_logs');
    }
}
