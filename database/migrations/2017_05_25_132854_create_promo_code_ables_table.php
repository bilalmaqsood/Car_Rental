<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodeAblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code_ables', function (Blueprint $table) {
            $table->integer('promo_code_id')->index();
            $table->integer('promo_code_able_id')->index();
            $table->string('promo_code_able_type')->index();

            $table->unique(['promo_code_id', 'promo_code_able_id', 'promo_code_able_type'], 'promo_code_id_able_id_able_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_code_ables');
    }
}
