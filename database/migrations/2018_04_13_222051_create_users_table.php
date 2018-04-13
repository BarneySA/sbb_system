<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 200);
			$table->string('username')->nullable();
			$table->string('password', 300);
			$table->date('birthdate');
			$table->string('contry', 20);
			$table->string('city', 100);
			$table->string('wallet_public_key', 300);
			$table->string('wallet_address', 300);
			$table->rememberToken('rememberToken');
			$table->integer('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}