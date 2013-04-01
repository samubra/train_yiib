<?php
/**
 * main.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:48 PM
 *
 * This file holds the configuration settings of your backend application.
 **/
$backendConfigDir = dirname(__FILE__);

$root = $backendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($backendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'www');
/* uncomment if you need to use frontend folders */
/* Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend'); */


$mainLocalFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
	array(
		'name' => '题库管系统',
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
		'basePath' => 'backend',
		// set parameters
		'params' => $params,
		// preload components required before running applications
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
		'preload' => array('bootstrap', 'log'),
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
		'language' => 'zh_cn',
		// using bootstrap theme ? not needed with extension
		'theme' => 'aquarius',//matrix,aquarius,bootstrap
		// setup import paths aliases
		// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
		'import' => array(
			'common.components.*',
			'common.extensions.*',
			/* uncomment if required */
			/* 'common.extensions.behaviors.*', */
			/* 'common.extensions.validators.*', */
			'common.models.*',
			// uncomment if behaviors are required
			// you can also import a specific one
			/* 'common.extensions.behaviors.*', */
			// uncomment if validators on common folder are required
			/* 'common.extensions.validators.*', */
				'common.extensions.giix-components.*',
			'application.modules.user.models.*',
			'application.modules.user.components.*',
			'application.components.*',
			'application.controllers.*',
			'application.models.*'
		),
		/* uncomment and set if required */
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
		'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => '123456',
				'generatorPaths' => array(
					'bootstrap.gii',
					'ext.giix-core',
				)
			),
			'user'=>array(
				'hash'=>'md5',
				'sendActivationMail' => false,
				'loginNotActiv' => false,
				'activeAfterRegister' => false,
				'autoLogin' => true,
				'registrationUrl' => array('/user/registration'),
				'recoveryUrl' => array('/user/recovery'),
				'loginUrl' => array('/user/login'),
				'returnUrl' => array('/user/profile'),
				'returnLogoutUrl' => array('/user/login'),
				),
		), 
		'components' => array(
			'user' => array(
				'class' => 'WebUser',
			    'allowAutoLogin'=>true,
			    'loginUrl' => array('/user/login'),
			),
			/* load bootstrap components */
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),
			'errorHandler' => array(
				// @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
				'errorAction'=>'site/error'
			),
			'db'=> array(
				'connectionString' => $params['db.connectionString'],
				'username' => $params['db.username'],
				'password' => $params['db.password'],
				'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
				'enableParamLogging' => YII_DEBUG,
				'charset' => 'utf8',
				'tablePrefix' =>$params['db.tablePrefix'],
				'enableProfiling'=>true,
				'enableParamLogging'=>true,
			),
			/*'urlManager' => array(
				'urlFormat' => 'path',
				//'showScriptName' => false,
				//'urlSuffix' => '/',
				'rules' => $params['url.rules']
			),
			/* make sure you have your cache set correctly before uncommenting */
			/* 'cache' => $params['cache.core'], */
			/* 'contentCache' => $params['cache.content'] */
				'log'=>array(
						'class'=>'CLogRouter',
						'routes'=>array(
								array(
										'class'=>'common.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
										// 'ipFilters'=>array('127.0.0.1','192.168.1.215'),
								),
								// uncomment the following to show log messages on web pages
								/*
				array(
						'class'=>'CWebLogRoute',
				),
				*/
						),
				),
				'clientScript'=>array(
						'scriptMap'=>array(
								//'jquery.js'=>'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
								//'jquery.min.js'=>'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
								'jquery.js'=>false,
								'jquery.min.js'=>false,
								'jquery-ui.min.js'=>false,
								'jquery-ui.js'=>false,
									
								//'bootstrap.js'=>false,
								//'jquery.cookie.js'=>false,
								//'config.css'=>'public/css/config.css',
						),
				),
		),		
	),
	CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);
