<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbacksTable extends Migration {

	public function up()
	{
		Schema::create('feedbacks', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('txid', 300);
			$table->text('comments');
			$table->integer('refund_applied')->default('0');
			$table->integer('seen_by_administrator')->default('0');
			$table->text('administrator_response')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('feedbacks');
	}
}