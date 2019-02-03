<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('articleName');
            $table->integer('list_id')->unsigned();
            $table->foreign('list_id')->references('id')->on('content_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->string('path');
            $table->string('fileName');
            $table->string('extension');
            $table->string('editor');
            $table->string('reference');
            $table->string('publish_details');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('article_files');
    }
}
