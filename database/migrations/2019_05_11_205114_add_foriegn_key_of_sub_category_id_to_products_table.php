<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForiegnKeyOfSubCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Adding foreign key to sub_category_id column of products table
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('sub_category_id')
                ->references('sub_category_id')
                ->on('sub_categories')
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
        // Dropping foreign key to sub_category_id column of products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('sub_category_id');
        });
    }
}
