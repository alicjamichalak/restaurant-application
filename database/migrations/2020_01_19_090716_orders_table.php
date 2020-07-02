<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->unsignedBigInteger('order_receipt_id')->nullable(false);
            $table->unsignedBigInteger('order_menu_id')->nullable(false);
            $table->unsignedBigInteger('order_employee_id')->nullable(true);
            $table->time('order_delayed_time');
            $table->boolean('order_delivered')->unsigned()->default(false);

            $table->timestamps();
            $table->foreign('order_receipt_id')->references('receipt_id')->on('receipts');
            $table->foreign('order_menu_id')->references('menu_id')->on('menus');
            $table->foreign('order_employee_id')->references('employee_id')->on('employees');

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
