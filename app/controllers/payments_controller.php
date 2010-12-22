<?php
class PaymentsController extends AppController {

	var $name = 'Payments';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session');
	
	function beforeFilter() {
		parent::beforeFilter();
		
	}
	
	function admin_index() {
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		
		$currentShopId = Shop::get('Shop.id');
		
		if ($this->RequestHandler->isGet()){
			$this->Payment->Behaviors->attach('Linkable.Linkable');
			$this->Payment->recursive = -1;
			
			$paymentModuleInShop->recursive = -1;
	
			$shopsPaymentModules = $paymentModuleInShop->find('all',
									  array('conditions' => array('shop_id'=>$currentShopId),
										'link' => array('PaymentModule'),
										'fields'=>array('ShopsPaymentModule.*, PaymentModule.name')));
			
			$customPaymentModules = $paymentModuleInShop->find('all',
									  array('conditions' => array('ShopsPaymentModule.shop_id' => $currentShopId,
												      'ShopsPaymentModule.payment_module_id' => CUSTOM_PAYMENT_MODULE),
										'link' => array('CustomPaymentModule'),
										'fields'=>array('CustomPaymentModule.*')));
			
			
			
			$this->set(compact('shopsPaymentModules', 'customPaymentModules'));			
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
	
	function admin_add_custom_payment() {
		
		$this->data['ShopsPaymentModule']['payment_module_id'] = CUSTOM_PAYMENT_MODULE;
		$this->data['ShopsPaymentModule']['shop_id'] = Shop::get('Shop.id');
		
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
	
	function admin_edit_custom_payment($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$paymentModuleInShop = $this->Payment->ShopsPaymentModule;
		$paymentModule = $paymentModuleInShop->PaymentModule;
		$customPaymentModuleInShop = $paymentModuleInShop->CustomPaymentModule;
		$customPaymentModuleInShop->id = $id;
		
		if ($customPaymentModuleInShop->save($this->data)) {
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