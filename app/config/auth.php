<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Authentication Driver
	|--------------------------------------------------------------------------
	|
	| This option controls the authentication driver that will be utilized.
	| This driver manages the retrieval and authentication of the users
	| attempting to get access to protected areas of your application.
	|
	| Supported: "database", "eloquent"
	|
	*/

	'multi' => array(
        'account' => array(
            'driver' => 'eloquent',
            'model' => 'Account'
        ),
        'admin' => array(
            'driver' => 'database',
            'table' => 'admins'
        )
    ),

);
