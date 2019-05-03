<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating product_colors table
         */
        Schema::create('product_colors', function (Blueprint $table) {

            /* Columns */
            $table->string('product_color_id', 50);
            $table->string('color_name', 150);
            $table->string('product_color', 10);
            $table->string('product_id', 50);
            $table->timestamps();

            /* Primary Key */
            $table->primary('product_color_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_colors');
    }
}
