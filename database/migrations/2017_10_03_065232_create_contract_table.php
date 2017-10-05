<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("booking_id")->nullable();
            $table->integer("agreement_no")->nullable();
            $table->string("business_logo")->nullable();
            $table->string("business_name")->nullable();
            $table->string("business_registration_number")->nullable();
            $table->string("business_address")->nullable();
            $table->string("business_email")->nullable();
            $table->string("business_phone")->nullable();
            $table->string("vehicle_registration_number")->nullable();
            $table->string("vehicle_color")->nullable();
            $table->string("vehicle_make")->nullable();
            $table->string("vehicle_model")->nullable();
            $table->string("client_name")->nullable();
            $table->string("client_address")->nullable();
            $table->string("driving")->nullable();
            $table->date("driving_expire_date")->nullable();
            $table->string("pco_number")->nullable();
            $table->date("pco_expiry_date")->nullable();
            $table->decimal("deposit")->nullable();
            $table->date("deposit_paid_date")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->string("insurance_company_name")->nullable();
            $table->string("insurance_policy_number")->nullable();
            $table->date("insurance_expiry_date")->nullable();
            $table->string("weekly_rent_cost")->nullable();
            $table->string("Insurance_excess_cost")->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
