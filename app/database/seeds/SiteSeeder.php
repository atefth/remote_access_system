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
                // for ($p=0; $p < 6; $p++) { 
                //     Relay::create(array(
                //         'site_id' => (($i * $j) + $j), 
                //         'relay_id' => $p, 
                //         'status' => 'False'
                //     ));
                // }
            }
        }        
    }

}
