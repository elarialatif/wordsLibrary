<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('exam_name')->unique();
            $table->string('instructions');
            $table->integer('grade_id')->unsigned()->comment('You must insert only first level degrees like grade 1 not beginner , i meant this is only for the first level degress not for children , because the exam itself will examin the entire degree of the first level of the student');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->unique(["exam_name","grade_id"]);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->tinyInteger("status")->default("0")->comment("default as not completed"); //default as not completed
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
        Schema::dropIfExists('placement_tests');
    }
}
