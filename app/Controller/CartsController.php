<?php
// we use angelleye code
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));

class CartsController extends AppController {

	var $name = 'Carts';
	
	var $checkoutLink = '';
	
	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session', 'Paypal.Paypal','RandomString.RandomString',);
	
	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();


		$this->Auth->allow('checkout', 'paypalExpressCheckout', 'add');
		
		
	}

	function index() {
		$this->Cart->recursive = 0;
		$this->set('carts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cart'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cart', $this->Cart->read(null, $id));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Cart'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Cart->save($this->request->data)) {
				$this->Session->setFlash(__('The Cart has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Cart could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Cart->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Cart'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Cart->delete($id)) {
			$this->Session->setFlash(__('Cart deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Cart could not be deleted. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

}
?>