<?php

/**
 * Validates a string that will be used for a frapp or profile slug
 *
 * @package newe
 * @subpackage validator
 * @author Iulian Manea <iulian.manea@impurelabs.com>
 */
class neweValidatorSlug extends sfValidatorRegex
{
	const REGEX_EMAIL = '/^[a-z\-]+$/i';

	/**
	* @see sfValidatorRegex
	*/
	protected function configure($options = array(), $messages = array())
	{
		parent::configure($options, $messages);

		$this->setOption('pattern', self::REGEX_EMAIL);
		$this->setOption('must_match', true);
	}
}

