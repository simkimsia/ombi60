<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
class ShopsController extends AppController {

	var $name = 'Shops';

	//var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Paypal.Paypal');

	

	function admin_account() {

		// display a list of stuff like pricing, usage, team members, etc
		

	}

	function admin_cancelaccount() {

		// display a form for cancelling account.
		if (!empty($this->data)) {
			// cancel account
			$shopId = Shop::get('Shop.id');
			$this->Shop->id = $shopId;
			
			$this->Shop->RecurringPaymentProfile->recursive = -1;
			$profile = $this->Shop->RecurringPaymentProfile->find('first', array('conditions'=>array('shop_id'=>$shopId)));
			
			$result = false;
			
			
			if (isset($profile['RecurringPaymentProfile']['gateway_reference_id'])) {
				
				$result = $this->cancelSubscription($profile['RecurringPaymentProfile']['gateway_reference_id']);
				if (isset($result['ACK']) && strtoupper($result['ACK']) == 'SUCCESS') {
					$this->log('enter');
					$profile['RecurringPaymentProfile']['status'] = 'cancel';
					$this->log($this->Shop->RecurringPaymentProfile->save($profile));
				}
			}
			
			if ($result) {
				// we need to change the deny_access value to true in database
				$result = $this->Shop->saveField('deny_access', true);	
			}
			
			
			
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
	
	private function cancelSubscription($ProfileID) {
		
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		
		
		$PayPal = new PayPal($PayPalConfig);

		$MRPPSFields = array(
				    'profileid' => $ProfileID, 				// Required. Recurring payments profile ID returned from CreateRecurring...
				    'action' => 'Cancel', 				// Required. The action to be performed.  Mest be: Cancel, Suspend, Reactivate
				    'note' => ''					// The reason for the change in status.  For express checkout the message will be included in email to buyers.  Can also be seen in both accounts in the status history.
				    );
				
								
		$PayPalRequestData = array('MRPPSFields' => $MRPPSFields,);
		return $PayPal->ManageRecurringPaymentsProfileStatus($PayPalRequestData);

	}

}
?>