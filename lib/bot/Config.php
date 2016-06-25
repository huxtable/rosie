<?php

/*
 * This file is part of Bot
 */
namespace Bot;

use Huxtable\Core\File;

class Config
{
	/**
	 * @var	array
	 */
	protected $data = [];

	/**
	 * @var	Huxtable\Core\File\File
	 */
	protected $source;

	/**
	 * @param	Huxtable\Core\File\File		$source
	 * @return	void
	 */
	public function __construct( File\File $source )
	{
		if( $source->exists() )
		{
			$json = $source->getContents();
			$this->data = json_decode( $json, true );
		}

		$this->source = $source;
	}

	/**
	 * @param	string	$key
	 * @return	mixed
	 */
	public function getValue( $key )
	{
		if( isset( $this->data[$key] ) )
		{
			return $this->data[$key];
		}
	}

	/**
	 * @param	string	$key
	 * @param	string	$value
	 * @return	void
	 */
	public function setValue( $key, $value )
	{
		$this->data[$key] = $value;
	}

	/**
	 * @return	void
	 */
	public function write()
	{
		$encodedData = json_encode( $this->data, JSON_PRETTY_PRINT );
		$this->source->putContents( $encodedData );
	}
}
