<?php
class PaymentsController extends AppController {

	var $name = 'Payments';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->log($this->action);
		$this->log($this->data);
		if ($this->action == 'admin_add_paypal_payment') {
			$this->Security->validatePost = false;			
		}

	}
	
	function admin_index() {
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		
		$currentShopId = Shop::get('Shop.id');
		
		$this->log('index');
		
		if ($this->RequestHandler->isGet()){
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
	
	function admin_update_settings() {
		if (!empty($this->data) AND $this->RequestHandler->isPost()) {
			$this->Payment->ShopsPaymentModule->saveAll($this->data['ShopsPaymentModule']);
			$this->redirect(array('action'=>'index',
					      'controller'=>'payments',
					      'admin'=>true));
		}
	}
	
	function admin_add_paypal_payment() {
		
		// attach the word paypal infront
		$this->data['PaypalPaymentModule']['name'] = 'Paypal ' . $this->data['PaypalPaymentModule']['name'];
		
		$this->data['ShopsPaymentModule']['payment_module_id'] = PAYPAL_PAYMENT_MODULE;
		$this->data['ShopsPaymentModule']['shop_id'] = Shop::get('Shop.id');
		$this->data['ShopsPaymentModule']['display_name'] = $this->data['PaypalPaymentModule']['name'];
		
		$this->log('after rearranging the paypal');
		$this->log($this->data);
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		
		$paymentModule->create();
		$paymentModuleInShop->create();
		
		
		if ($paymentModuleInShop->saveAll($this->data)) {
			$this->Session->setFlash(__('Paypal payment has been activated', true), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Paypal payment could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_add_custom_payment() {
		
		$this->data['ShopsPaymentModule']['payment_module_id'] = CUSTOM_PAYMENT_MODULE;
		$this->data['ShopsPaymentModule']['shop_id'] = Shop::get('Shop.id');
		$this->data['ShopsPaymentModule']['display_name'] = $this->data['CustomPaymentModule']['name'];
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		
		$paymentModule->create();
		$paymentModuleInShop->create();
		
		
		if ($paymentModuleInShop->saveAll($this->data)) {
			$this->Session->setFlash(__('Custom payment has been saved', true), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_edit_paypal_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		$paypalPaymentModuleInShop = $paymentModuleInShop->PaypalPaymentModule;
		
		$paypalPaymentModuleInShop->id = $id;
		if ($paypalPaymentModuleInShop->save($this->data)) {
			$this->Session->setFlash(__('Custom payment has been saved', true), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_edit_custom_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		$customPaymentModuleInShop = $paymentModuleInShop->CustomPaymentModule;
		
		// set up the parent id for edit data for both parent and child at same time
		$paymentModuleInShop->id = $this->data['CustomPaymentModule']['shop_payment_module_id'];
		// set up the child id for edit data for both parent and child at same time
		$this->data['CustomPaymentModule']['id'] = $id;
		// set up the parent id for edit data for both parent and child at same time
		$this->data['ShopsPaymentModule']['id'] = $this->data['CustomPaymentModule']['shop_payment_module_id'];
		$this->data['ShopsPaymentModule']['display_name'] = $this->data['CustomPaymentModule']['name'];
		
		if ($paymentModuleInShop->saveAll($this->data)) {
			$this->Session->setFlash(__('Custom payment has been saved', true), 'default', array('class'=>'flash_success'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}
	
	function admin_delete_custom_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		
		$paymentModuleInShop->id = $id;
		
		if ($paymentModuleInShop->delete()) {
			$this->Session->setFlash(__('Custom payment has been removed', true), 'default', array('class'=>'flash_failure'));
		} else {
			$this->Session->setFlash(__('Custom payment  could not be removed. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'index'));
	}

}
?>