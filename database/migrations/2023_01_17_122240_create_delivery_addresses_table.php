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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('type', ['home', 'work'])->default('home');
            $table->string('name');
            $table->string('mobile');
            $table->longText('address_one');
            $table->longText('address_two');
            $table->foreignId('city_id')->constrained();
            $table->foreignId('state_id')->constrained();
            $table->string('pincode');
            $table->enum('is_default', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('delivery_addresses');
    }
};
