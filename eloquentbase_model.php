<?php

class EloquentBase_Model extends Eloquent
{

	/**
	 * The rules array stores Validator rules in an array indexed by
	 * the field_name to which the rules should be applied.
	 *
	 * @var array
	 */
	public static $rules = array();

	/**
	 * The messages array stores Validator messages in an array indexed by
	 * the field_name to which the messages should be applied in case of errors.
	 *
	 * @var array
	 */
	public static $messages = array();

	/**
	 * The validation object is stored here once is_valid() is run.
	 * This object is publicly accessible so that it can be used
	 * to redirect with errors.
	 *
	 * @var object
	 */
	public static $validation = false;

	/**
	 * Validates model.
	 *
	 * @param  array   $input
	 * @return bool
	 */
	public function is_valid( $input = null )
	{

		// if input is null then pull all input from the input class

		if( is_null( $input ) )
			$input = Input::all();

		if( empty( static::$rules) )
			return true;

		// generate the validator and return its success status

		static::$validation = Validator::make( $input, static::$rules, static::$messages );

		return static::$validation->passes();

	}

}