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
			$table->string('mean');
            $table->integer('level');
            $table->integer('list_id')->unsigned();
            $table->foreign('list_id')->references('id')->on('content_lists')->onDelete('cascade')->onUpdate('cascade');
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
