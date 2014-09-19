<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {

public function up()
{
    Schema::create('records', function($table)
    {
        $table->increments('id');
        $table->integer('site_id');
        $table->string('site_name');
        $table->string('switch');
        $table->string('status');
        $table->string('command');
        $table->string('admin_id');
        $table->timestamps();
    });
}

public function down()
{
    Schema::drop('records');
}

}
