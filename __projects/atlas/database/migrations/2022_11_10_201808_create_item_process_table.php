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
        Schema::create('item_process', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('process_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('process_id')->references('id')->on('item_processes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_process');
    }
};
