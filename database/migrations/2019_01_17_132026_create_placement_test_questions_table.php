<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementTestQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_test_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("exam_id")->unsigned();
            $table->text("question");
            $table->foreign('exam_id')->references('id')->on('placement_tests')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->string('ans1');
            $table->string('ans2');
            $table->string('ans3')->nullable();
            $table->string('ans4')->nullable();
            $table->string('true_answer');
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
        Schema::dropIfExists('placement_test_questions');
    }
}
