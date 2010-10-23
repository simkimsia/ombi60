<?php
class AddressesController extends AppController {

	var $name = 'Addresses';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session');

	function index() {
		$this->Address->recursive = 0;
		$this->set('addresses', $this->paginate());
	}

}
?>