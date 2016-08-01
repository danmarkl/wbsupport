<?php
App::uses('CakeTime', 'Utility');

class ImportTeamsShell extends AppShell {

	public $uses = array('User', 'Team');

	public function main() {
        try {
            $this->import();
        } catch (Exception $ex) {
            $this->out('An error occured while importing teams.');
            $this->out('Error: '.$ex);
        }
	}
        
    public function import() {
        $this->out('-----Starting Import: Teams-----');

		$options = array();
		$teams = $this->apiGet('teams', $options);

		$this->out('-----Saving Teams-----');

		$teamArray = array();
		foreach ($teams['teams'] as $team) {
			$teamArray['Code'] = $team['id'];
			$teamArray['Name'] = $team['name'];

            $teamQuery = $this->getTeamById($team['id']);
            
            if($teamQuery!=1) {
                $this->Team->create();
                $this->Team->save($teamArray);
                $this->out('Saved: '.$team['name']);
            }
		}
        
		$this->out('-----Import Done-----');
    }
    
    public function getTeamById($id) {
        $team = $this->Team->find('all', array(
            'conditions' => array(
                'Team.Code' => $id
            )
        ));
        
        return $team ? 1 : 0;
    }

}