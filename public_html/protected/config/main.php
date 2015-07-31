<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bulk Message Cabinet',
    'sourceLanguage'=>'ru',
    'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log','EJSUrlManager','UnderConstruction'),

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
        'client' => [
            'defaultController' => 'defaultClient'
        ],
        'transaction',
        'admin' => [
            'defaultController' => 'adminDefault',
        ],
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
			'connectionString' => 'mysql:host=127.0.0.1;dbname=bp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '884088',
			'charset' => 'utf8',
            'enableParamLogging' => true,
            'enableProfiling' => true,
		),
        'UnderConstruction' => array(
            'class' => 'application.components.System.UnderConstruction',
            'allowedIPs'=>array(''), //whatever IPs you want to allow
            'locked'=>false,//this is the on off switch
            'redirectURL'=>'/site/construction',//put in your desired redirect page.
        ),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
            'class'=>'ELangUrlManager',
            'languages'=>array('ru'=>'Русский','en'=>'English'), //assoziative array language => label
            'cookieDays'=>10, //keep language 10 days
            'languageParam' => 'ru', //=default

            //common configuration for the yii urlManager
            //don't add 'language' rules here, these rules will be added by the ELangUrlManager
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
                /*array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('::1'),
                ),*/
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