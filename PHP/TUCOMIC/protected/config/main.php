<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Tu Comic',
	/*'theme'=>'arka',*/
	'theme'=>'zoocroo',


    	//AUTOLOGIN
	/*
	'behaviors' => array(
	    'onBeginRequest' => array(
	        'class' => 'application.components.RequireLogin'
	    )
	),
	*/


	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.crugeconnector.*',
	),

	'aliases' => array(
	    //If you used composer your path should be
	    //'xupload' => 'ext.vendor.asgaroth.xupload'
	    //If you manually installed it
	    'xupload' => 'ext.xupload'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abcdef1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','*'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		//crugeconnector (facebook , google)
		'crugeconnector'=>array(
			'class'=>'ext.crugeconnector.CrugeConnector',
			'hostcontrollername'=>'site',
			'onSuccess'=>array('site/loginsuccess'),
			'onError'=>array('site/loginerror'),
			'clients'=>array(
				'facebook'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Facebook',
					//'callback'=>'http://ascinformatix.com/app1/facebookcallback.php',
					'callback'=>'http://200.14.84.183/~17698677/teleco/facebookcallback.php',
					// required by remote interface:
					'client_id'=>"164350930421515",
					'client_secret'=>"411f09d46bdd550d16df2f8292f1dba4",
					'scope'=>'email, read_stream',
				),
				'google'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Google',
					'callback'=>'http://ascinformatix.com/app1/googlecallback.php',
					// required by remote interface:
					'hostname'=>'ascinformatix.com',
					'identity'=>'https://www.google.com/accounts/o8/id',
					'scope'=>array('contact/email'),
				),
				'tester'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Tester',
					// required by remote interface:
				),
			),
		),


                // uncomment the following to use a SQLite database
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/

                // uncomment the following to use a PostgreSQL database
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=@',
			'username' => '@',
			'password' => '@',
			'charset' => 'utf8',
		),

		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
