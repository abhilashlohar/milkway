<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Marksheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksheets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('year_id');
            $table->foreign('year_id')->references('id')->on('years');
            $table->uuid('semester_id')->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->string('marksheet_src');
            $table->string('result');
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('marksheets');
    }
}
