<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('custome_name',80);
            $table->string('custome_email',120);
            $table->string('custome_mobile',40);
            $table->string('status',20);
            $table->integer('valor');
            $table->string('requestId',100)->nullable();
            $table->timestamps();

            /*$table->foreign("status")
                  ->references("codigo")
                  ->on("status");*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
