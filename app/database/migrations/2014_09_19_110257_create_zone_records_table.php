<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zone_records', function($table)
	    {
	        $table->increments('id');
	        $table->integer('zone_id');
	        $table->string('zone_name');
	        $table->string('switch');
	        $table->string('status');
	        $table->string('command');
	        $table->integer('admin_id');
	        $table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zone_records');
	}

}
