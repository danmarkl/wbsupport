<?php
/**
 * AppShell file
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Shell', 'Console');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class AppShell extends Shell {

	private $domain 	= "websiteblue";
	private $token 		= "te2YpQHWeLE9Jqqdi9WK";
	private $https		= "https://";
	private $url 		= "supportbee.com/";
	private $headers	= array('Content-Type: application/json', 'Accept: application/json');

	public function apiGet($method = null, array $options = array()) {
		$ch = curl_init();
		
		if($options != null || !empty($options)) {
			curl_setopt($ch, CURLOPT_URL, $this->https.$this->domain.'.'.$this->url.$method.'?'.$this->urlParams($options).'&auth_token='.$this->token);
		} else {
			curl_setopt($ch, CURLOPT_URL, $this->https.$this->domain.'.'.$this->url.$method.'?auth_token='.$this->token);
		}
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		$response = curl_exec($ch);

		curl_close($ch);

		return json_decode($response, true);
	}

	public function urlParams(array $options = array()) {
		$arrayKeys = array_keys($options);
		$lastKey = array_pop($arrayKeys);
		$concat = '';

		foreach($options as $key => $val) {
			$concat .= $key.'='.$val;
			
			if($key != $lastKey) {
				$concat .= '&';
			}
		}

		return $concat;
	}

}
