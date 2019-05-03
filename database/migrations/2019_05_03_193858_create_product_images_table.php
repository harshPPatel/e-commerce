<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating product_images table
         */
        Schema::create('product_images', function (Blueprint $table) {
            
            /* Columns */
            $table->string('product_image_id', 50);
            $table->string('product_image', 255);
            $table->string('product_id', 50);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            /* Primary Key */
            $table->primary('product_image_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
