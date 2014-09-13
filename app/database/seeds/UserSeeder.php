<?php

class UserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(array('f_name' => 'Atef', 'l_name' => 'Haque', 'phone' => '+8801760099824', 'address' => '60, Mohakhali', 'site_id' => 'mohakhali_101', 'rfid' => '123456789' , 'has_access' => 0));
        User::create(array('f_name' => 'Prima', 'l_name' => 'Tasnim', 'phone' => '+8801671467468', 'address' => '33, Kafrul', 'site_id' => 'kafrul_095', 'rfid' => '132547698' , 'has_access' => 1));
        User::create(array('f_name' => 'Ariful', 'l_name' => 'Islam',  'phone' => '+880152487390', 'address' => '160, Los Angeles', 'site_id' => 'la_103', 'rfid' => '168734529' , 'has_access' => 1));
        User::create(array('f_name' => 'Ashraful', 'l_name' => 'Islam', 'phone' => '+880821287563', 'address' => '23, Shantinagar', 'site_id' => 'shantinogor_056', 'rfid' => '341528796' , 'has_access' => 0));
        User::create(array('f_name' => 'Robi', 'l_name' => 'Tester', 'phone' => '+8801819212563', 'address' => '60, Gulshan', 'site_id' => 'gulshan_036', 'rfid' => '356677396' , 'has_access' => 1));
    }

}
