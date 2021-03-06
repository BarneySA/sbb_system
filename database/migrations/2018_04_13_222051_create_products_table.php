<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 300);
			$table->string('slug', 300);
			$table->text('description')->nullable();
			$table->string('billboard', 300);
			$table->string('amount');
			$table->string('currency');
			$table->integer('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}