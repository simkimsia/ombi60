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
	
	
	public function admin_view($id = false) {
		$this->Fulfillment->id = $id;
		
		if (!$this->Fulfillment->exists()) {
			$this->Session->setFlash('invalid order', 'default', 
			array(
				'class'=>'flash_failure'
			));
			$this->redirect($this->referer(array('controller'=>'orders', 'action'=>'index', 'admin'=>true)));
			
		}
		
		if ($this->request->is('get')) {
			$fulfillment = $this->Fulfillment->read(null, $id);
			$this->set('fulfillment', $fulfillment);
			$this->request->data = $fulfillment;
			
		} else {
			if (empty($this->request->data)) {
				$fulfillment = $this->Fulfillment->read(null, $id);
				$this->set('fulfillment', $fulfillment);
				
			} else {
				if ($this->Fulfillment->save($this->request->data)) {
					$this->Session->setFlash(__('Tracking number has been saved'), 'default', array('class'=>'flash_success'));
					$this->redirect(array(
						'controller'=>'orders',
						'action' => 'view',
						'admin' => true,
						'id' => $this->request->data['Fulfillment']['order_id']
						));
				} else {
					$this->Session->setFlash(__('Tracking number could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
				}
				
			}
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
