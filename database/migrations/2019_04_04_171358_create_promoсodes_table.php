<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoсodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoсodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable()->default(null);
            $table->integer('user_id')->nullable()->default(0);
            $table->integer('count_uses')->nullable()->default(100);
            $table->integer('discount')->nullable()->default(10);
            $table->dateTime('date_end')->nullable()->default(null);
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
        Schema::dropIfExists('promoсodes');
    }
}
