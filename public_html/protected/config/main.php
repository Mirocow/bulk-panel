<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bulk Message Cabinet',
    'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log','EJSUrlManager'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.PaymentService.*',
	),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'reseller' => [
            'defaultController' => 'users'
        ],
        'user' => [
            'defaultController' => 'defaultUser'
        ],
        'transaction',
    ),
	'defaultController'=>'site',
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'EJSUrlManager' => array(
            'class' => 'ext.JSUrlManager.src.EJSUrlManager'
        ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=bp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '884088',
			'charset' => 'utf8',
            'enableParamLogging' => true,
            'enableProfiling' => true,
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('::1'),
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
	'params'=>require(dirname(__FILE__).'/params.php'),
);