<?php

class SiteSeeder extends Seeder {

    public function run()
    {
        DB::table('sites')->delete();
        for ($i=0; $i < 5; $i++) { 
            for ($j=0; $j < 5; $j++) { 
                Site::create(array(
                'name' => 'BTS_'.$i.$j
                ));
            }
        }        
    }

}
