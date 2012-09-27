<?php
/**
 * CUSTOM ASSERT EXTENSION FOR PHPUNIT FRAMEWORK
 *
 * Copyright © 2012, Vitalii Tereshchuk <xvoland@dotoca.net>
 * All rights reserved.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    Custom Assert
 * @subpackage Custom assert extension for PHPUnit Framework 
 * @author     Vitalii Tereshchuk <xvoland@dotoca.net>
 * @copyright  2012 Vitalii Tereshchuk <xvoland@dotoca.net>
 * @link       http://dotoca.net/
 * @link 	   https://github.com/xvoland/html-validate
 *
 */
require_once 'PHPUnit/Framework/Assert.php';


class Assert extends PHPUnit_Framework_Assert
{
	/**
	 * Asserts that a HTML is validate.
	 *
	 * @param  string  $html
	 * @param  string  $output
	 * @throws PHPUnit_Framework_AssertionFailedError
	 */
	public static function HTMLValidate($html, $output = 'text')
	{
		$_url       = 'http://html5.validator.nu/';
		$_port      = null;
		$_output    = array('xhtml', 'html', 'xml', 'json', 'text');
		$_useragent = 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)';


      	if(empty($html))
      	{
      		self::assertEmpty($html, self::isEmpty());
      	}


		if (!is_string($html))
		{
			throw self::factory(
				1, 'string'
			);
      	}


		if (!is_string($output) || !in_array($output, $_output))
		{
			throw self::factory(
				2, 'string - text/xhtml/html/xml/json'
			);
      	}


		$posts = array(
			'out'     => $output,
			'content' => '<!DOCTYPE html><html><head><meta charset=utf-8 /><title></title></head><body>'.$html.'</body></html>'
		);

		$headers = array(
			'Content-Type' => 'application/xhtml+xml'
		);

		$curlOpt = array(
			CURLOPT_USERAGENT      => $_useragent,
			CURLOPT_URL            => $_url,
			CURLOPT_PORT           => $_port,
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

		if(stripos($response, 'Error') or stripos($response, 'Warning'))
		{
	        	self::fail($response);
       	}

   		return true;
	}
}