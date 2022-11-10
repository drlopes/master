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
        Schema::create('item_application', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('application_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('application_id')->references('id')->on('item_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_application');
    }
};
