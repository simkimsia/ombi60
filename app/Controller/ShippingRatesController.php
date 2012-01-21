<?php
class ShippingRatesController extends AppController {

	public $name = 'ShippingRates';
	
	public $helpers = array('Ajax', 'Javascript', 'Number');

	
	public function admin_index() {
		$this->ShippingRate->recursive = 0;
		
		$shopId = Shop::get('Shop.id');
		
		$this->ShippingRate->ShippedToCountry->Behaviors->load('Linkable.Linkable');
		
		$shippingRates = $this->ShippingRate->ShippedToCountry->find('all', array('conditions'=>array('ShippedToCountry.shop_id'=>$shopId),
									'order'=>array('ShippedToCountry.country_id ASC'),
									'link'=>array('ShippingRate'=>array('PriceBasedRate', 'WeightBasedRate'), 'Country'),
									
									));
		
		
		$this->set(compact('shippingRates'));
	}

	public function admin_edit($based = 'price-based-shipping', $id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid shipping rate'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		if (!empty($this->request->data)) {

			if ($this->ShippingRate->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The shipping rate has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shipping rate could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		
		if (empty($this->request->data)) {
		
			$this->ShippingRate->recursive = 0;
		
			$linkedArray = array('PriceBasedRate');
			if ($based == 'weight-based-shipping') {
				$linkedArray = array('WeightBasedRate');	
			}
			
			$this->ShippingRate->ShippedToCountry->Behaviors->load('Linkable.Linkable');
			
			$this->request->data = $this->ShippingRate->ShippedToCountry->find('first', array('conditions'=>array('ShippingRate.id'=>$id),
										'order'=>array('ShippedToCountry.country_id ASC'),
										'link'=>array('ShippingRate'=>$linkedArray, 'Country'),
										
										));
			
			$this->set(compact('based'));
			
		}
				
		
		
		
	}
	
	private function fetchCurrent() {
		
		$this->ShippingRate->recursive = 0;
		
		$this->ShippingRate->Behaviors->load('Linkable.Linkable');
		
		return $this->ShippingRate->find('first', array('conditions'=>array('ShippingRate.id'=>$this->ShippingRate->id),
									'order'=>array('ShippedToCountry.country_id ASC'),
									'link'=>array('PriceBasedRate', 'WeightBasedRate', 'ShippedToCountry'=>array('Country')),
									
									));
		
	}
	
	public function admin_add_price_based($country_id) {
		$result = true;
		
		if (!empty($this->request->data) && is_numeric($country_id)) {
			$this->ShippingRate->create();
			
			if ($this->ShippingRate->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The shipping rate has been saved'), 'default', array('class'=>'flash_success'));
			} else {
				$result = false;
				$this->Session->setFlash(__('The shipping rate could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			
			if ($this->request->is('ajax')) {
				
				$this->layout = 'json_data';
				if ($result) {
					$shippingRate = $this->fetchCurrent();
					$successJSON  = true;
					$this->set(compact('shippingRate', 'successJSON'));
					
					$this->render('new_shipping_rate');
				} else {
					$errors = array_merge($this->ShippingRate->validationErrors,
							      $this->ShippingRate->PriceBasedRate->validationErrors);
					$successJSON  = false;
					
					$this->set(compact('successJSON', 'errors'));
					$this->render('../Json/error');
				}
				
				
			} else {
				$this->redirect(array('action' => 'index'));
			}
			
		}
		
	}
	
	public function admin_add_weight_based($country_id) {
		if (!empty($this->request->data)&& is_numeric($country_id)) {
			
			$result = true;
			
			$this->ShippingRate->create();
			if ($this->ShippingRate->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The shipping rate has been saved'), 'default', array('class'=>'flash_success'));
				
			} else {
				$result = false;
				$this->Session->setFlash(__('The shipping rate could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			if ($this->request->is('ajax')) {
				
				$this->layout = 'json_data';
				if ($result) {
					$shippingRate = $this->fetchCurrent();
					$successJSON  = true;
					$this->set(compact('shippingRate', 'successJSON'));
					
					$this->render('new_shipping_rate');
				} else {
					$errors = array_merge($this->ShippingRate->validationErrors,
							      $this->ShippingRate->WeightBasedRate->validationErrors);
					$successJSON  = false;
					
					$this->set(compact('successJSON', 'errors'));
					$this->render('../Json/error');
				}
				
				
			} else {
				$this->redirect(array('action' => 'index'));
			}
		}
		
	}

	

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for shipping rate'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ShippingRate->delete($id)) {
			$this->Session->setFlash(__('Shipping rate deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Shipping rate was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
}
?>