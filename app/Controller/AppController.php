<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
    public $uses = array('User');
	public $helpers = array('Html', 'Form', 'Text', 'SB');

	private $domain 	= "websiteblue";
	private $token 		= "te2YpQHWeLE9Jqqdi9WK";
	private $https		= "https://";
	private $url 		= "supportbee.com/";
	private $headers	= array('Content-Type: application/json', 'Accept: application/json');

	public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'user',
                'action' => 'login'
            ),
            'authError' => "<div class=\"alert alert-danger text-center\" role=\"alert\">You are not authorized to access that location.</div>",
            'loginRedirect' => array(
                'controller' => 'ticket',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'user',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array(
                        'username' => 'EmailAddress',
                        'password' => 'Password'
                    )
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function isAuthorized($user) {
        if ((isset($user['role']) && $user['role'] === 'client') || (isset($user['role']) && $user['role'] === 'admin')) {
            return true;
        }

        return false;
    }

    public function beforeFilter() {       
        if($this->Auth->user('Role') == 'client') {
            $this->set('role', 'client');
        } elseif($this->Auth->user('Role') == 'admin') {
            $this->set('role', 'admin');
        } else {
            $this->set('role', null);
        }

        $auth = $this->Session->read('Auth.User');
        
        if(!empty($auth)) {
            $user = $this->User->findById($auth['Id']);
            $this->set('user', $user);
        }
    }

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

	public function apiPost() {

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
