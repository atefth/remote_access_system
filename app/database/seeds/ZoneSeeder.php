<?php

class ZoneSeeder extends Seeder {

    public function run()
    {
        DB::table('zones')->delete();
        Zone::create(array(
        	'name' => 'Gulshan'
        	));
        Zone::create(array(
            'name' => 'Baridhara'
            ));
        Zone::create(array(
            'name' => 'Uttara'
            ));
        Zone::create(array(
            'name' => 'Motijheel'
            ));
        Zone::create(array(
            'name' => 'Mirpur'
            ));
    }

}
