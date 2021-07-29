<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->timestamp('registration_date')->nullable();
            $table->string('zipcode');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('neighborhood');
            $table->string('number');
            $table->string('complement');
            $table->string('status');
            $table->string('student_photo');
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
        Schema::dropIfExists('students');
    }
}
