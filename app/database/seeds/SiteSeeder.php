<?php

class SiteSeeder extends Seeder {

    public function run()
    {
        DB::table('sites')->delete();
        for ($i=0; $i < 10; $i++) { 
            for ($j=0; $j < 10; $j++) { 
                Site::create(array(
                'name' => 'BTS_'.$i.$j
                ));
            }
        }        
    }

}
