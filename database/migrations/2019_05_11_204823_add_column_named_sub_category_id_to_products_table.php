<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNamedSubCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Adding sub_category_table column to the products table
        Schema::table('products', function (Blueprint $table) {
            $table->string('sub_category_id', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Dropping the sub_category_id column from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sub_category_id');
        });
    }
}
