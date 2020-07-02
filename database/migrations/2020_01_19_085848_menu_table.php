<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function(Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->string('menu_name')->nullable(false)->unique();
            $table->time('menu_preparation_time')->nullable(false);
            $table->float('menu_price')->nullable(false)->unsigned();
            $table->unsignedBigInteger('menu_food_type_id')->nullable(false);
            $table->boolean('menu_active')->default(true)->unsigned();

            $table->timestamps();
            $table->foreign('menu_food_type_id')->references('food_type_id')->on('food_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
