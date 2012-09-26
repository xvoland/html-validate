<?php

require_once 'PHPUnit/Framework/Assert.php';


class Assert extends PHPUnit_Framework_Assert
{
	protected $_url  = 'http://html5.validator.nu/';

	protected $_port = null;

	protected $_output = array('xhtml', 'html', 'xml', 'json', 'gnu', 'text');

	protected $_doctype = '<!DOCTYPE html>'
						 .'<html>';


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


		$posts = array(
			'out'     => $output,
			'content' => $_doctype . '<head><meta charset=utf-8 /><title></title></head><body>'.$html.'</body></html>'
		);


		return null;//self::fail('ky-ky');
	}
}