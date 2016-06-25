<?php

use Huxtable\CLI\Command;
use Huxtable\CLI\Format;
use Huxtable\CLI\Input;
use Huxtable\Core\File;

/**
 * @command		config
 * @desc		Configure the local environment
 * @usage		config
 */
$commandConfig = new Command( 'config', "Configure the local environment for '{$appName}'", function( $service )
{
	GLOBAL $config;

	switch( $service )
	{
		case 'twitter':
			$configKeys =
			[
				[ 'name' => 'consumerKey', 'description' => 'Consumer Key' ],
				[ 'name' => 'consumerSecret', 'description' => 'Consumer Secret' ],
				[ 'name' => 'accessToken', 'description' => 'Access Token' ],
				[ 'name' => 'accessTokenSecret', 'description' => 'Access Token Secret' ],
			];
			break;

		default:
			throw new Command\CommandInvokedException( "Unknown service '{$service}'.", 1 );
	}

	foreach( $configKeys as $configKey )
	{
		$configKeyName = $configKey['name'];

		$defaults[$configKeyName] = $config->getValue( $service, $configKeyName );
		foreach( $defaults as $key => $defaultValue )
		{
			$formattedDefaults[$key] = $defaultValue;
		}

		$input[$configKeyName] = Input::prompt( "{$configKey['description']} [{$formattedDefaults[$configKeyName]}]:" );
		$configValue = $input[$configKeyName] == '' ? $defaults[$configKeyName] : $input[$configKeyName];

		$config->setValue( $service, $configKey['name'], $configValue );
	}

	$config->write();

	echo PHP_EOL;
});

return $commandConfig;
