<?php
class PaymentsController extends AppController {

	public $name = 'Payments';

	public $helpers = array('Html', 'Form', 'Session');

	public $components = array('Session');
	
	public function beforeFilter() {
		parent::beforeFilter();
		
	}
	
	public function admin_index() {
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		
		$currentShopId = Shop::get('Shop.id');
		
		if ($this->request->is('get')){
			$this->Payment->Behaviors->attach('Linkable.Linkable');
			$this->Payment->recursive = -1;
			
			$paymentModuleInShop->recursive = -1;
	
			$shopsPaymentModules = $paymentModuleInShop->find('all',
									  array('conditions' => array('ShopsPaymentModule.shop_id'=>$currentShopId),
										'link' => array('PaymentModule'),
										'fields'=>array('ShopsPaymentModule.*, PaymentModule.name')));
			
			$customPaymentModules = $paymentModuleInShop->find('all',
									  array('conditions' => array('ShopsPaymentModule.shop_id' => $currentShopId,
												      'ShopsPaymentModule.payment_module_id' => CUSTOM_PAYMENT_MODULE),
										'link' => array('CustomPaymentModule'),
										'fields'=>array('CustomPaymentModule.*')));
			
			$paypalPaymentModule = $paymentModuleInShop->find('first',
									  array('conditions' => array('ShopsPaymentModule.shop_id' => $currentShopId,
												      'ShopsPaymentModule.payment_module_id' => PAYPAL_PAYMENT_MODULE),
										'link' => array('PaypalPaymentModule'),
										'fields'=>array('PaypalPaymentModule.*')));
			
			
			
			$this->set(compact('shopsPaymentModules', 'customPaymentModules', 'paypalPaymentModule'));			
		}
		
	}
	
	public function admin_update_settings() {
		if (!empty($this->request->data) AND $this->request->is('post')) {
			$this->Payment->ShopsPaymentModule->saveAll($this->request->data['ShopsPaymentModule']);
			$this->redirect(array('action'=>'index',
					      'controller'=>'payments',
					      'admin'=>true));
		}
	}
	
	public function admin_add_paypal_payment() {
		
		// attach the word paypal infront
		$this->request->data['PaypalPaymentModule']['name'] = 'Paypal ' . $this->request->data['PaypalPaymentModule']['name'];
		
		$this->request->data['ShopsPaymentModule']['payment_module_id'] = PAYPAL_PAYMENT_MODULE;
		$this->request->data['ShopsPaymentModule']['shop_id'] = Shop::get('Shop.id');
		$this->request->data['ShopsPaymentModule']['display_name'] = $this->request->data['PaypalPaymentModule']['name'];
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		
		$paymentModule->create();
		$paymentModuleInShop->create();
		
		
		if ($paymentModuleInShop->saveAll($this->request->data)) {
			$this->Session->setFlash(__('Paypal payment has been activated'), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Paypal payment could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	public function admin_add_custom_payment() {
		
		$this->request->data['ShopsPaymentModule']['payment_module_id'] = CUSTOM_PAYMENT_MODULE;
		$this->request->data['ShopsPaymentModule']['shop_id'] = Shop::get('Shop.id');
		$this->request->data['ShopsPaymentModule']['display_name'] = $this->request->data['CustomPaymentModule']['name'];
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		
		$paymentModule->create();
		$paymentModuleInShop->create();
		
		
		if ($paymentModuleInShop->saveAll($this->request->data)) {
			$this->Session->setFlash(__('Custom payment has been saved'), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	public function admin_edit_paypal_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		$paypalPaymentModuleInShop = $paymentModuleInShop->PaypalPaymentModule;
		
		$paypalPaymentModuleInShop->id = $id;
		if ($paypalPaymentModuleInShop->save($this->request->data)) {
			$this->Session->setFlash(__('Custom payment has been saved'), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	public function admin_edit_custom_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		$customPaymentModuleInShop = $paymentModuleInShop->CustomPaymentModule;
		
		// set up the parent id for edit data for both parent and child at same time
		$paymentModuleInShop->id = $this->request->data['CustomPaymentModule']['shop_payment_module_id'];
		// set up the child id for edit data for both parent and child at same time
		$this->request->data['CustomPaymentModule']['id'] = $id;
		// set up the parent id for edit data for both parent and child at same time
		$this->request->data['ShopsPaymentModule']['id'] = $this->request->data['CustomPaymentModule']['shop_payment_module_id'];
		$this->request->data['ShopsPaymentModule']['display_name'] = $this->request->data['CustomPaymentModule']['name'];
		
		if ($paymentModuleInShop->saveAll($this->request->data)) {
			$this->Session->setFlash(__('Custom payment has been saved'), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	public function admin_delete_custom_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		
		$paymentModuleInShop->id = $id;
		
		if ($paymentModuleInShop->delete()) {
			$this->Session->setFlash(__('Custom payment has been removed'), 'default', array('class'=>'flash_failure'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be removed. Please, try again.'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}

}
?>