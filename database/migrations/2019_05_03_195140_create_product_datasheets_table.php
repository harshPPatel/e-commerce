<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDatasheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating product_datasheets table.
         */ 
        Schema::create('product_datasheets', function (Blueprint $table) {

            /* Columns */
            $table->string('product_datasheet_id', 50);
            $table->string('specification_name', 255);
            $table->text('specification_value');
            $table->string('product_id', 50);
            $table->timestamps();

            /* Primary Key */
            $table->primary('product_datasheet_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_datasheets');
    }
}
