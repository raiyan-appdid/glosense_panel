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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('mobile');
            $table->string('note')->nullable();
            $table->integer('total');
            $table->integer('delivery_charges');
            $table->string('promocode')->nullable();
            $table->integer('promocode_discount')->nullable();
            $table->integer('final_total');
            $table->string('payment_method');
            $table->text('shipping_address');
            $table->string('tracking_code')->nullable();
            $table->string('delivery_time')->nullable();
            $table->enum('send_invoice', ['yes', 'no'])->default('no');
            $table->timestamp('invoice_sent_at')->nullable();
            $table->enum('status', ['pending', 'accepted', 'shipped', 'delivered'])->default('accepted');
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
        Schema::dropIfExists('orders');
    }
};
