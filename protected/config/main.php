<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application 2',

	// preloading 'log' component
	'preload'=>array('log' , 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
	),
	'theme'=>'bootstrap',
	'modules'=>array(

		'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        ),
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
            //'responsiveCss' => TUR,
            'fontAwesomeCss' => TRUE,
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
     		'caseSensitive'=>false,  
			'rules'=>array(
				'<user:\w+>'=>'site/user',
				'<user:\w+>/friends'=>'site/user',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=miapp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
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
		'session' => array(
           'autoStart'=>true,  
   		),
   		'facebook'=>array(
		    'class' => 'ext.yii-facebook-opengraph.SFacebook',
		    'appId'=>'210521229054903', // needed for JS SDK, Social Plugins and PHP SDK
		    'secret'=>'f46e9ccc6f476cf9205dc08128ab5e34', // needed for the PHP SDK
		    'fileUpload'=>false, // needed to support API POST requests which send files
		    'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
		    'locale'=>'en_US', // override locale setting (defaults to en_US)
		    'jsSdk'=>false, // don't include JS SDK
		    'async'=>true, // load JS SDK asynchronously
		    'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
		    'status'=>true, // JS SDK - check login status
		    'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
		    'oauth'=>true,  // JS SDK - enable OAuth 2.0
		    'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
		    'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
		    //'html5'=>true,  // use html5 Social Plugins instead of XFBML
		    'ogTags'=>array(  // set default OG tags
		        'title'=>'MY_WEBSITE_NAME',
		        'description'=>'MY_WEBSITE_DESCRIPTION',
		        'image'=>'URL_TO_WEBSITE_LOGO',
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