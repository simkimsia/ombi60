<?php
class GroupsController extends AppController {

	public $name = 'Groups';

	public $helpers = array('Html', 'Form', 'Session');

	public $actsAs = array('Acl' => array('type' => 'requester'));

	public function parentNode() {
		return null;
	}

	
}
?>