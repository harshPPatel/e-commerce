<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameOldProductPriceColumnNameToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Renaming column from old_product_price to product_old_price
         */
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('old_product_price', 'product_old_price');
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
         * Renaming column from product_old_price to old_product_price
         */
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('product_old_price', 'old_product_price');
        });
    }
}
