<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->string('name_product', 120);
            $table->float('price_product', 10, 0);
            $table->float('sale', 4, 1);
            $table->integer('quantity_product');
            $table->text('decscription');
            $table->integer('view');
            $table->timestamp('date', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
