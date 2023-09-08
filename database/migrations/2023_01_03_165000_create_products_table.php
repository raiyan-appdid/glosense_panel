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
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->string('title');
            $table->string('video_link')->nullable();
            $table->string('slug');
            $table->decimal('price');
            $table->decimal('discounted_price');
            $table->string('measurement');
            $table->foreignId('unit_id')->nullable()->constrained();
            $table->integer('stock');
            $table->enum('in_stock', ['yes', 'no'])->default('yes');
            $table->enum('is_special', ['yes', 'no'])->default('no');
            $table->enum('is_best_seller', ['yes', 'no'])->default('no');
            $table->string('manufacturer');
            $table->string('made_in');
            $table->enum('is_returnable', ['yes', 'no'])->default('no');
            $table->enum('is_cancellable', ['yes', 'no'])->default('no');
            $table->enum('is_cod', ['yes', 'no'])->default('no');            
            $table->integer('allowed_quantity');
            $table->text('how_to_take')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->text('product_detail');
            $table->enum('status', ['active', 'blocked'])->default('active');
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
        Schema::dropIfExists('products');
    }
};
