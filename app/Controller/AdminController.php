<?php
App::uses('SupportBeeController', 'Controller');

class AdminController extends SupportBeeController {

    public $uses = array('User', 'Team');
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('index', 'ticket', 'user');
    }

    public function index() {
        $this->layout = "websiteblue";

        if($this->Auth->user('Role') != 'admin') {
            $this->redirect(array('controller' => 'ticket', 'action' => 'index'));
        } else {
            $this->redirect(array('controller' => 'admin', 'action' => 'user'));
        }
    }

    public function ticket() {
        $this->layout = "websiteblue";
        $this->set('page', 'ticket');
    }

    public function user() {
        $this->layout = "websiteblue";

        $this->Paginator->settings = array(
            'fields' => array(
                'User.*',
                'Team.*'
            ),
            'joins' => array(
                array(
                    'table' => 'teams',
                    'alias' => 'Team',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Team.Code = User.TeamId'
                    )
                )
            ),
            'conditions' => array(
                'User.EmailAddress !=' => $this->Auth->user('EmailAddress'),
                'User.IsActive' => 1
            ),
            'limit' => 10
        );

        $users = $this->Paginator->paginate('User');
        $roles = array('admin', 'client');
        $labels = array('answered', 'unanswered');
        $search = array('email'=>'','name'=>'','role'=>'','team'=>'');

        if($this->request->is('post')) {
            $search = array(
                'email' => $this->request->data['email'],
                'name'  => $this->request->data['name'],
                'role'  => $this->request->data['role'],
                'team'  => $this->request->data['team']
            );

            $this->Paginator->settings = array(
                'fields' => array(
                    'User.*',
                    'Team.*'
                ),
                'joins' => array(
                    array(
                        'table' => 'teams',
                        'alias' => 'Team',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Team.Code = User.TeamId'
                        )
                    )
                ),
                'conditions' => array(
                    "User.EmailAddress !=" => $this->Auth->user('EmailAddress'),
                    "User.EmailAddress LIKE" => $search['email']."%",
                    "User.FirstName LIKE" => $search['name']."%",
                    "User.Role LIKE" => $search['role']."%",
                    "User.TeamId LIKE" => $search['team']."%",
                    "User.IsActive" => 1
                ),
                'limit' => 10
            );

            $results = $this->Paginator->paginate('User');
        }

        $users = !empty($results) ? $results : $users;


        $this->set(array(
            'users' 	=> $users,
            'roles' 	=> $roles,
            'labels' 	=> $labels,
            'page' 		=> 'user',
            'search' 	=> $search,
            'teams' 	=> $this->Team->find('all')
        ));
    }

}