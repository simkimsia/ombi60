<?php
class GroupsController extends AppController {

	var $name = 'Groups';

	var $helpers = array('Html', 'Form', 'Session');

	var $actsAs = array('Acl' => array('type' => 'requester'));

	function parentNode() {
		return null;
	}

	
}
?>