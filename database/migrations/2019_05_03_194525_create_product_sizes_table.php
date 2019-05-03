<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating product_sizes table.
         */
        Schema::create('product_sizes', function (Blueprint $table) {

            /* Columns */
            $table->string('product_size_id', 50);
            $table->string('product_size', 50);
            $table->string('product_id', 50);
            $table->timestamps();

            /* Primary Key */
            $table->primary('product_size_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sizes');
    }
}
