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
        Schema::table('cc_avenue_transactions', function (Blueprint $table) {
            $table->string('cf_order_id')->nullable();
            $table->string('payment_session_id')->nullable();
            $table->string('cash_free_order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_avenue_transactions', function (Blueprint $table) {
            $table->dropColumn('cf_order_id');
            $table->dropColumn('payment_session_id');
            $table->dropColumn('cash_free_order_id');
        });
    }
};
