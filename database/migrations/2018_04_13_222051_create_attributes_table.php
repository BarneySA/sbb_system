<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributesTable extends Migration {

	public function up()
	{
		Schema::create('attributes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('code', 100);
			$table->string('value', 600);
			$table->integer('position');
			$table->integer('product_id');
		});
	}

	public function down()
	{
		Schema::drop('attributes');
	}
}