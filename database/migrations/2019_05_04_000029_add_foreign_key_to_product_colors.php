<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToProductColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Updating product_id as Foreign Key to the product_colors table
         */
        Schema::table('product_colors', function (Blueprint $table) {
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * Removing Foreign Key attribute from product_id column
         */
        Schema::table('product_colors', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
}
