<?php
App::uses('AppController', 'Controller');
/**
 * Fulfillments Controller
 *
 * @property Fulfillment $Fulfillment
 */
class FulfillmentsController extends AppController {


/**
 * admin_set method
 *
 * @return void
 */
	public function admin_set($order_id = false) {
		$this->Fulfillment->Order->id = $order_id;
		if (!$this->Fulfillment->Order->exists()) {
			
			
			$this->Session->flash('invalid order');
			$this->redirect(array('controller'=>'orders', 'action'=>'index', 'admin'=>true));
		}
		
		
		$this->Fulfillment->recursive = 0;
		$this->set('fulfillments', $this->paginate());
	}

}
