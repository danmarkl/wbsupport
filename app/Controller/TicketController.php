<?php
App::uses('SupportBeeController', 'Controller');

class TicketController extends SupportBeeController {
	
	public $uses = array('User','Team');

	public function isAuthorized($user) {
        if ($this->action === 'index') {
            return true;
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();

        if($this->Auth->user('Role') == 'client') {
            $this->Auth->allow('index','get', 'readcache');
        }
    }

    public function readcache() {
    	$this->autoRender = false;
    	$tickets = Cache::read('tickets', 'long');
    	
    	$tix = "";
    	foreach($tickets['tickets'] as $ticket) {
    		if(!$ticket['unanswered']) {
    			$tix[] = $ticket;

    			echo json_encode($tix);
    		}
    	}
    }

	public function index($page=1) {
		$this->layout = 'websiteblue';

		if($this->Auth->user('Role')=='admin') return $this->redirect(array('controller' => 'admin', 'action' => 'index'));

		$user = $this->Session->read('Auth.User');
		$team = $this->User->findById($user['Id']);
		$search = array('ticketid'=>'','label'=>'');

		if($this->request->is('post')) {
			$search = array(
				'ticketid' => $this->request->data['ticketid'],
				'label' => $this->request->data['label']
			);
			$options = array(
				'assigned_team' => $team['User']['TeamId'],
				'label' => $search['label'],
				'page' => $page
			);
			$tickets = $this->getTickets($options);
		} else {
			$options = array(
				'assigned_team' => $team['User']['TeamId'],
				'page' => $page
			);
			$tickets = $this->getTickets($options);
		}

		$this->set(array(
			'tickets' => $tickets,
			'team' => $this->Team->find('all', array('conditions' => array('Team.Code' => $team['User']['TeamId']))),
			'search' => $search
		));
	}

	public function get($id = null) {
		$this->layout = 'websiteblue';

		if(!$id) throw new NotFoundException(__('Invalid Ticket.'));

		$user = $this->Session->read('Auth.User');
		$team = $this->User->findById($user['Id']);

		$ticket = $this->getTicketById($id);
		$replies = $this->getReplies($id);

		$options = array(
			'assigned_team' => $team['User']['TeamId']
		);
		$tickets = $this->getTickets($options);

		$this->set(array(
			'ticket' => $ticket,
			'replies' => $replies,
			'tickets' => $tickets
		));
	}
}