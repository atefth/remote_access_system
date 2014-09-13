<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
		    $table->string('username');
		    $table->string('password');
		    $table->string('f_name');
		    $table->string('l_name');
		    $table->string('phone');
		    $table->string('address');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
		    $table->dropColumn('username');
		    $table->dropColumn('password');
		    $table->dropColumn('f_name');
		    $table->dropColumn('l_name');
		    $table->dropColumn('phone');
		    $table->dropColumn('address');
		});
	}

}
