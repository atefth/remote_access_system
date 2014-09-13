<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingRememberTokenToAdmins extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admins', function($table)
		{
		    $table->string('remember_token', 100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('admins', function($table)
		{
		    $table->dropColumn('remember_token');
		});
	}

}
