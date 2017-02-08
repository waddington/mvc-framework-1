<?php
class ProfilesController extends Controller {

	function view($id=null, $name=null) {
		$id = $this->Profile->clean($id);
		$this->set('title', $name.' - My first MVC app!');
		$this->set('profile', $this->Profile->select($id));
	}

	function viewall() {
		$this->set('title', 'All Profiles - My first MVC app!');
		$this->set('profile', $this->Profile->selectAll());
	}

	function createprofile() {
		$this->set('title', 'Create a Profile - My first MVC app!');
	}

	function add() {
		$name = $this->Profile->clean($_POST['profile']);
		$this->set('title', 'Success - My first MVC app!');
		$this->set('profile', $this->Profile->query('INSERT INTO profiles (profile_displayName) VALUES ("'.$name.'")'));
	}

	function delete($id=null) {
		$id = $this->Profile->clean($id);
		$this->set('title', 'Success - My first MVC app!');
		$this->set('profile', $this->Profile->query('DELETE FROM profiles WHERE id = '.$id.';'));
	}
}