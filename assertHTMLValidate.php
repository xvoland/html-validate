<?php

require_once 'PHPUnit/Framework/Assert.php';

class Assert extends PHPUnit_Framework_Assert
{
	private $_output = array('xhtml', 'html', 'xml', 'json', 'gnu', 'text');


	public static function HTMLValidate($html, $output = 'text')
	{
		if (!is_string($html))
		{
			throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
      }

		if (!is_string($output) || !in_array($output, $_output))
		{
			throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'string - text/xhtml/html/xml/json/gnu');
      }


		return null;//self::fail('ky-ky');
	}
}