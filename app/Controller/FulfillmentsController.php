<?php
App::uses('AppController', 'Controller');
/**
 * Fulfillments Controller
 *
 * @property Fulfillment $Fulfillment
 */
class FulfillmentsController extends AppController {


	public $name = 'Fulfillments';

	public $helpers = array(
		'Session', 
		);

	public $components = array(

		'Session'
				
	);


	public function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		
		if ($this->request->action == 'admin_set') {
		
			$this->Components->disable('Security');
		}
		
	}


/**
 * admin_set method
 *
 * @return void
 */
	public function admin_set($order_id = false) {
		$this->Fulfillment->Order->id = $order_id;
		
		if (!$this->Fulfillment->Order->exists()) {
			
			$this->Session->setFlash('invalid order', 'default', 
			array(
				'class'=>'flash_failure'
			));
			$this->redirect(array('controller'=>'orders', 'action'=>'index', 'admin'=>true));
		}
		
		// attach the order_id to the fulfillment
		$this->request->data['Fulfillment']['order_id'] = $order_id;
		
		$requestData = Set::filter($this->request->data);
		
		$result = $this->Fulfillment->fulfillItems($requestData);
		if ($result) {
			$this->Session->setFlash('Successfully fulfilled items', 'default', 
			array(
				'class'=>'flash_success'
			));

		} else {
			$this->Session->setFlash('Not successful in fulfilling items', 'default', 
			array(
				'class'=>'flash_failure'
			));
			
		}
		
		return $this->redirect($this->referer(array('controller' => 'orders', 'action' => 'view', 'admin' => true, 'id' => $order_id)));
	}

}
