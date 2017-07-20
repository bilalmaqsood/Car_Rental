<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('insurance')->nullable();
            $table->string('driving')->nullable();
            $table->string('dvla')->nullable();
            $table->string('postcode')->nullable();
            $table->date('dob')->nullable();
            $table->string('pco_number')->nullable();
            $table->date('pco_release_date')->nullable();
            $table->date('pco_expiry_date')->nullable();
            $table->json('documents')->nullable()->comment('documents of driver');
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
        Schema::dropIfExists('clients');
    }
}
