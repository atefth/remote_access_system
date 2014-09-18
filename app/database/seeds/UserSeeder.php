<?php

class UserSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(array('f_name' => 'Atef', 'l_name' => 'Haque', 'phone' => '+8801760099824', 'address' => '60, Mohakhali', 'rfid' => '123456789'));
        User::create(array('f_name' => 'Prima', 'l_name' => 'Tasnim', 'phone' => '+8801671467468', 'address' => '33, Kafrul', 'rfid' => '132547698'));
        User::create(array('f_name' => 'Ariful', 'l_name' => 'Islam',  'phone' => '+880152487390', 'address' => '160, Los Angeles', 'rfid' => '168734529'));
        User::create(array('f_name' => 'Ashraful', 'l_name' => 'Islam', 'phone' => '+880821287563', 'address' => '23, Shantinagar', 'rfid' => '341528796'));
        User::create(array('f_name' => 'Robi', 'l_name' => 'Tester', 'phone' => '+8801819212563', 'address' => '60, Gulshan', 'rfid' => '356677396'));
    }

}
