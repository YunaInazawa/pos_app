<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_detail_id')->unsigned();
            $table->bigInteger('option_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_detail_id')
                ->references('id')->on('order_details')
                ->onDelete('cascade');
            $table->foreign('option_id')
                ->references('id')->on('options')
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
        Schema::dropIfExists('order_detail_options');
    }
}
