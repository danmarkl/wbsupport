<?php
App::uses('SupportBeeController', 'Controller');

class UserController extends SupportBeeController {
	
    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('index', 'login', 'logout', 'add', 'edit');
        $this->set('page', 'user');
    }

    public function index() {
        $this->autoRender = false;

        if ($this->Auth->loggedIn()) {
                $return = $this->checkRedirect($this->checkRole($this->Auth->user('EmailAddress')));
        } else {
                $return = $this->redirect(array('controller' => 'user', 'action' => 'login'));
        }

        return $return;
    }

    public function add() {
        $this->layout = "websiteblue";

        if($this->request->is('post')) {
            $check = $this->checkIfUserExists($this->request->data['User']['EmailAddress']);

            if($check==1) {
                $this->Session->setFlash('User already exists! Try another one.', 'default', array(
                    'class' => 'alert alert-danger text-center', 
                    'role' => 'alert'
                ), 'reg_message');
            } else {
                $this->User->create();

                if ($this->User->save($this->request->data)) {
                    $this->User->saveField('TeamId', $this->request->data['User']['TeamId']==null ? 0 : $this->request->data['User']['TeamId']);
                    return $this->redirect(array('controller' => 'admin', 'action' => 'user'));
                } else {
                    $this->Session->setFlash('The user could not be saved. Please, try again.', 'default', array(
                        'class' => 'alert alert-danger text-center', 
                        'role' => 'alert'
                    ), 'reg_message');
                }
            }
        }

        $this->set(array(
                'teams' => $this->getTeams(),
                'roles' => array('admin', 'client')
        ));
    }

    public function edit($id=null) {
        $this->layout = "websiteblue";

        if(!$id) throw new NotFoundException(__('Invalid user'));

        $user = $this->User->findById($id);
        if(!$user) throw new NotFoundException(__('Invalid user'));

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                    $this->User->saveField('TeamId', $this->request->data['User']['TeamId']==null ? 0 : $this->request->data['User']['TeamId']);
                    return $this->redirect(array('controller' => 'admin', 'action' => 'user'));
            } else {
                $this->Session->setFlash('The user could not be updated. Please, try again.', 'default', array(
                    'class' => 'alert alert-danger text-center', 
                    'role' => 'alert'
                ), 'reg_message');
            }
        }

        $this->set(array(
                'user' => $user,
                'roles' => array('admin', 'client'),
                'teams' => $this->getTeams()
        ));
    }

    public function login() {
        $this->layout = null;

        $this->Session->delete('Message.login_message');

        if($this->Auth->loggedIn()) {
            return $this->checkRedirect($this->Auth->user('Role'));
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->checkRedirect($this->checkRole($this->request->data['User']['EmailAddress']));
            } else {
                $this->Session->setFlash('Invalid username or password, try again', 'default', array(
                    'class' => 'alert alert-danger text-center', 
                    'role' => 'alert'
                ), 'login_message');
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    protected function checkIfUserExists($emailaddress=null) {
    	$check = $this->User->find('all', array(
            'conditions' => array(
                'User.EmailAddress' => $emailaddress
            )
        ));

        if(!$check) {
            $return = 0;
        } else {
            $return = 1;
        }

        return $return;
    }

    protected function checkRole($emailaddress=null) {
    	$checkRole = $this->User->find('all', array(
            'conditions' => array(
                'User.EmailAddress' => $emailaddress
                )
        ));

        return $checkRole[0]['User']['Role'];
    }

    protected function checkRedirect($role) {
        if($role==='admin') {
            $redirect = $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        } elseif($role==='client') {
            $redirect = $this->redirect(array('controller' => 'ticket', 'action' => 'index'));
        } else {
            $redirect = $this->redirect(array('controller' => 'user', 'action' => 'index'));
        }

        return $return;
    }

}