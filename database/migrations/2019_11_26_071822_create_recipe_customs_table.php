<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_customs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_detail_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_detail_id')
                ->references('id')->on('order_details')
                ->onDelete('cascade');
            $table->foreign('material_id')
                ->references('id')->on('materials')
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
        Schema::dropIfExists('recipe_customs');
    }
}
