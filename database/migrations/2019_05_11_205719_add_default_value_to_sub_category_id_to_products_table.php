<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueToSubCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // making default value
        Schema::table('products', function (Blueprint $table) {
            $table
                ->string('sub_category_id', 50)
                ->default(env('OTHERS_SUB_CATEGORY_ID'))
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table
                ->string('sub_category_id', 50)
                ->default(null)
                ->change();
        });
    }
}
