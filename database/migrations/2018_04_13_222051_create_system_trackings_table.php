<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemTrackingsTable extends Migration {

	public function up()
	{
		Schema::create('system_trackings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('description');
			$table->integer('user_id')->default('-1');
		});
	}

	public function down()
	{
		Schema::drop('system_trackings');
	}
}