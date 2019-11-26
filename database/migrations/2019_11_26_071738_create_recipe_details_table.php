<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('recipe_id')->unsigned();
            $table->bigInteger('material_type_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('recipe_id')
                ->references('id')->on('recipes')
                ->onDelete('cascade');
            $table->foreign('material_type_id')
                ->references('id')->on('material_types')
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
        Schema::dropIfExists('recipe_details');
    }
}
