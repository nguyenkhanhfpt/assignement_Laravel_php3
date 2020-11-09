<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignDetailBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_bills', function (Blueprint $table) {
            $table->foreign('bill_id')->references('id')
                ->on('bills')->onDelete('cascade');

            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_bills', function (Blueprint $table) {
            $table->dropForeign('detail_bills_bill_id_foreign');
            $table->dropForeign('detail_bills_product_id_foreign');
        });
    }
}
