<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSecurityTokensTable extends Migration {

	public function up()
	{
		Schema::create('security_tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->string('token', 100);
			$table->string('identifier', 200);
		});
	}

	public function down()
	{
		Schema::drop('security_tokens');
	}
}