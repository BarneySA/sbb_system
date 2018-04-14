<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id');
			$table->integer('product_id');
			$table->integer('user_id');
			$table->string('from', 200);
			$table->string('for', 200);
			$table->string('currency_name', 12);
			$table->string('amount', 100);
			$table->string('txid', 300);
			$table->integer('type')->default('0');
			$table->integer('refund')->default('0');
			$table->text('localization_json')->nullable();
			$table->string('description')->nullable();
			$table->string('contry', 30)->nullable();
			$table->string('city', 100)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}