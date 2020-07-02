<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function(Blueprint $table) {
            $table->bigIncrements('receipt_id');
            $table->unsignedBigInteger('receipt_table_id')->nullable(false);
            $table->unsignedBigInteger('receipt_client_id')->nullable(false);
            $table->boolean('receipt_closed')->nullable(false)->default(false);
            $table->dateTime('receipt_opened_date')->nullable(false);

            $table->timestamps();

            $table->foreign('receipt_table_id')->references('table_id')->on('tables');
            $table->foreign('receipt_client_id')->references('client_id')->on('clients');
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
