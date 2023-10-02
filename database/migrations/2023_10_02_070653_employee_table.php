<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('employee', function(Blueprint $table) {
            $table->integer('employee_id')->autoIncrement();
            $table->string('name', 150);
            $table->string('job_title', 100);
            $table->integer('salary');
            $table->string('department', 100);
            $table->date('join_date');
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
};
