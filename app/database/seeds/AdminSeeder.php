<?php

class AdminSeeder extends Seeder {

    public function run()
    {
        // DB::table('admins')->delete();
        // Admin::create(array(
        // 	'name' => 'SuperUser',
        // 	'username' => 'root', 
        // 	'password' => Hash::make('pass')
        // 	));
        // Admin::create(array(
        // 	'name' => 'RobiTemp', 
        // 	'username' => 'robi', 
        // 	'password' => Hash::make('robi')));
        Admin::create(array(
         'name' => 'Base Technologies',
         'username' => 'base', 
         'password' => Hash::make('pass')
         ));
    }

}
