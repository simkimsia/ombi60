<?php
class ShopsController extends AppController {

	var $name = 'Shops';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session');

	

	function admin_account() {

		// display a list of stuff like pricing, usage, team members, etc
		

	}

	function admin_cancelaccount() {

		// display a form for cancelling account.
		if (!empty($this->data)) {
			// cancel account
			$shopId = Shop::get('Shop.id');
			$this->Shop->id = $shopId;
			
			// we need to change the deny_access value to true in database
			$result = $this->Shop->saveField('deny_access', true);
			
			
			if($result) {
				
				// create cancellation records
				$this->data['Cancellation']['shop_id'] = $shopId;
				$this->data['Cancellation']['user_id'] = User::get('User.id');
				
				$cancellation = ClassRegistry::init('Cancellation');
				
				$cancellation->create();
				
				$cancellation->save($this->data);
				
				// reset the cache for current shop
				$shop = $this->Shop->find('first', array('conditions'=>array('Shop.id'=>$shopId)));
			
				// now we write to Cache so that Cache contains the newly updated values
				$this->Session->Write('CurrentShop.Shop.deny_access', true);
				
					
				$this->redirect('http://mainsite.localhost/account/cancel/success');
			}
			
			
		} else {
			// display form
			
			
		}

	}

}
?>