<?php
App::uses('SupportBeeController', 'Controller');

class ReplyController extends SupportBeeController {

    public function isAuthorized($user) {
        if ($this->action === 'index') {
            return true;
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();

        if($this->Auth->user('Role') == 'client') {
            $this->Auth->allow('get');
        }
        
        $this->set('page', 'ticket');
    }

    public function get($ticketId = null, $replyId = null) {
        $this->layout = null;

        if(!$ticketId || !$replyId) throw new NotFoundException(__('Invalid Ticket Reply'));

        $reply = $this->getReplyById($ticketId, $replyId);

        $this->set(array(
                'reply' => $reply
        ));
    }

}