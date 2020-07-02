<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table) {
            $table->bigIncrements('employee_id');
            $table->string('employee_name')->nullable(false);
            $table->string('employee_surname')->nullable(false);
            $table->date('employee_birthday')->nullable(false);
            $table->string('employee_address')->nullable(false);
            $table->string('employee_phone_number')->nullable(false)->unique();
            $table->string('employee_identification_code')->nullable(false)->unique();

            $table->timestamps();

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
