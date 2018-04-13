<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 120);
			$table->string('image', 300)->nullable();
			$table->integer('parent');
			$table->integer('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}