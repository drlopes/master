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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_common_usage')->nullable();
            $table->boolean('is_company_property')->nullable();
            $table->boolean('in_consumable')->nullable();
            $table->boolean('has_warranty')->nullable();
            $table->date('warranty_expiration')->nullable();
            $table->boolean('has_maintenance_contract')->nullable();
            $table->boolean('needs_maintenance')->nullable();
            $table->string('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
