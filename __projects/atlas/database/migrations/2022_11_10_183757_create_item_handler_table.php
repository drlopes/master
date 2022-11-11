<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_handler', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('handler_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('handler_id')->references('id')->on('item_handlers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_handler');
    }
};
