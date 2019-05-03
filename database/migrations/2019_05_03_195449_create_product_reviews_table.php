<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating product_reviews table.
         */
        Schema::create('product_reviews', function (Blueprint $table) {

            /* Columns */
            $table->string('product_review_id', 50);
            $table->text('product_review');
            $table->datetime('product_review_date');
            $table->string('product_id', 50);
            $table->string('user_id', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
