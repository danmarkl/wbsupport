<?php
App::uses('AppController', 'Controller');

class SupportBeeController extends AppController {

    public function getTickets(array $options = array()) {
        return $this->apiGet('tickets', $options);
    }

    public function getTicketById($id = null) {
        return $this->apiGet('tickets/'.$id);
    }

    public function getReplies($ticketId = null) {
        return $this->apiGet('tickets/'.$ticketId.'/replies');
    }

    public function getReplyById($ticketId = null, $replyId = null) {
        return $this->apiGet('tickets/'.$ticketId.'/replies/'.$replyId);
    }

    public function getTeams(array $options = array()) {
        return $this->apiGet('teams', $options);
    }
}