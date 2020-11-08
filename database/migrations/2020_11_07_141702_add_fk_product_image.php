<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkProductImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('product_image', function (Blueprint $table) {
        //     $table->foreign('product_id')->references('id_product')
        //         ->on('products')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('product_image', function (Blueprint $table) {
        //     $table->dropForeign('product_image_product_id_foreign');
        // });
    }
}
