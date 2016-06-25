<?php

use Huxtable\CLI\Command;
use Huxtable\CLI\Format;
use Huxtable\CLI\Input;
use Huxtable\Core\File;

/**
 * @command		config
 * @desc		Configure the local environment for bot
 * @usage		config
 */
$commandConfig = new Command( 'config', "Configure the local environment for '{$appName}'", function()
{
	GLOBAL $config;

	echo PHP_EOL;

	$configKeys =
	[
		[
			'name' => 'consumerKey',
			'description' => 'Consumer Key'
		],
		[
			'name' => 'consumerSecret',
			'description' => 'Consumer Secret'
		],
		[
			'name' => 'accessToken',
			'description' => 'Access Token'
		],
		[
			'name' => 'accessTokenSecret',
			'description' => 'Access Token Secret'
		],
	];

	foreach( $configKeys as $configKey )
	{
		$configKeyName = $configKey['name'];

		$defaults[$configKeyName] = $config->getValue( $configKeyName );
		foreach( $defaults as $key => $defaultValue )
		{
			$formattedDefaults[$key] = $defaultValue;
		}

		$input[$configKeyName] = Input::prompt( "{$configKey['description']} [{$formattedDefaults[$configKeyName]}]:" );
		$configValue = $input[$configKeyName] == '' ? $defaults[$configKeyName] : $input[$configKeyName];

		$config->setValue( $configKey['name'], $configValue );
	}

	$config->write();

	echo PHP_EOL;
});

return $commandConfig;
