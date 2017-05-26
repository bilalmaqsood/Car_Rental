<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolymorphicPromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codeables', function (Blueprint $table) {
            $table->integer('promo_code_id')->index();
            $table->integer('promo_codeable_id')->index();
            $table->string('promo_codeable_type')->index();

            $table->unique(['promo_code_id', 'promo_codeable_id', 'promo_codeable_type'], 'promo_code_id_able_id_able_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codeable');
    }
}
