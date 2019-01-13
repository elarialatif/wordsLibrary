<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocabsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('vocabs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('word');
			$table->integer('count');
			$table->integer('artical_id')->unsigned();
			$table->foreign('artical_id')->references('id')->on('article_files')->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('vocabs');
	}
}
