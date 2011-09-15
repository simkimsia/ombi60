<?php
class AddressesController extends AppController {

	public $name = 'Addresses';

	public $helpers = array('Html', 'Form', 'Session');

	public $components = array('Session');

	public function index() {
		$this->Address->recursive = 0;
		$this->set('addresses', $this->Paginator->paginate());
	}

}