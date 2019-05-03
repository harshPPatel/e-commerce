<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating Products Table
         */
        Schema::create('products', function (Blueprint $table) {

            /* Columns */
            $table->string('product_id', 50);
            $table->string('product_name', 255);
            $table->double('product_price', 10, 2);
            $table->double('old_product_price', 10, 2)->nullable();
            $table->text('product_video')->nullable();
            $table->integer('product_stock')->nullable();
            $table->longText('product_description');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            /* Primary Key */
            $table->primary('product_id');
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
}
