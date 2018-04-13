<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration {

	public function up()
	{
		Schema::create('configurations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('site_name', 100);
			$table->string('wallet_address', 300);
			$table->string('wallet_public_key', 300);
			$table->integer('maintenance_mode')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('configurations');
	}
}