<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaCollectionRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_collection_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('collection_id')->default(0);
            $table->integer('media_id')->default(0);
            $table->integer('order_field')->default(0);
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
        Schema::dropIfExists('media_collection_relations');
    }
}
