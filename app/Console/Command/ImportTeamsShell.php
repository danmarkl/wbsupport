<?php
App::uses('CakeTime', 'Utility');

class ImportTeamsShell extends AppShell {

	public $uses = array('User', 'Team');

	public function main() {

		$this->out('-----Starting Import: Teams-----');

		$options = array();
		$teams = $this->apiGet('teams', $options);

		$this->out('-----Saving Teams-----');

		$teamArray = array();
		foreach ($teams['teams'] as $team) {
			$teamArray['Code'] = $team['id'];
			$teamArray['Name'] = $team['name'];

			$this->Team->create();
			$this->Team->save($teamArray);

			$this->out('Saved: '.$team['name']);
		}

		$this->out('-----Teams Saved-----');
	}

}