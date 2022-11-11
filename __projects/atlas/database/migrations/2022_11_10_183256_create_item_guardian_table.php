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
        Schema::create('item_guardian', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('guardian_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('guardian_id')->references('id')->on('item_guardians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_guardian');
    }
};
