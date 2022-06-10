<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('articulo_id');
            $table->integer('cantidad');
            $table->integer('subtotal');
            $table->integer('valor');
            $table->timestamps();

            $table->foreign("order_id")
                  ->references("id")
                  ->on("orders");

            $table->foreign("articulo_id")
                  ->references("id")
                  ->on("articles");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
