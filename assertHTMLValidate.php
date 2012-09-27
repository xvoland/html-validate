<?php

require_once 'PHPUnit/Framework/Assert.php';


class Assert extends PHPUnit_Framework_Assert
{
	protected $_url  = 'http://html5.validator.nu/';

	protected $_port = null;

	protected $_output = array('xhtml', 'html', 'xml', 'json', 'gnu', 'text');

	protected $_doctype = '<!DOCTYPE html>'
						 .'<html>';

	protected $_useragent = 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)';


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

		$headers = array(
			'Content-Type' => 'application/xhtml+xml'
		);

		$curlOpt = array(
			CURLOPT_USERAGENT      => $this->_useragent,
			CURLOPT_URL            => $this->_url,
			CURLOPT_PORT           => $this->_port,
			//CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST           => true,
			CURLOPT_POSTFIELDS     => $posts
		);


		$curl = curl_init();
		curl_setopt_array($curl, $curlOpt);


		if( ! $response = curl_exec($curl))
		{
			throw new PHPUnit_Framework_Exception(
            	sprintf('Can\'t check validation. cURL returning error %s',
            		trigger_error(curl_error($curl))
             	)
            );
		}

		//$curl_info = curl_getinfo($curl);
		curl_close($curl);

		if( strpos($message, 'document is valid') === false )
       	{
        	self::fail($message);
        	return $message;
       	}

		return true;
	}
}