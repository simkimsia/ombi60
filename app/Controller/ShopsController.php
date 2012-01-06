<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
App::import('Vendor', 'PayDollar', array('file'=>'paydollar'.DS.'includes'.DS.'paydollar.nvp.class.php'));
/**
 * @property Shop Shop
 */
class ShopsController extends AppController {

	public $name = 'Shops';

	//var $helpers = array('Html', 'Form', 'Session');

	public $components = array('Paypal.Paypal',
				'Paydollar.Paydollar');


	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
	}
	
	public function admin_general_settings() {
		
		if (!empty($this->request->data)) {

			if ($this->Shop->saveAll($this->request->data)) {
				
				// updating Session and Shop static class
				$currentShop = $this->Shop->getByDomain(FULL_BASE_URL);

				$this->Session->write('CurrentShop', $currentShop);
				Shop::store($currentShop);
				
				$this->Session->setFlash(__('General Settings have been saved'), 'default', array('class'=>'flash_success'));
				
				$this->redirect(array('action' => 'admin_general_settings'));
				
			} else {
				$this->Session->setFlash(
					__('General Settings could not be saved. Please, try again.'), 
					'default', 
					array('class'=>'flash_failure')
				);
				
			}
		}
		
		if (empty($this->request->data)) {
			$this->Shop->recursive = -1;
			$shopSetting = $this->Shop->find('first', array(
				'conditions'=>array(
					'Shop.id'=>Shop::get('Shop.id')
				), 
				'contain' => array('ShopSetting')
			));
			
			
			$this->set(compact('shopSetting'));
		} 
		
	}
	

	public function admin_account() {

		// display a list of stuff like pricing, usage, team members, etc
		

	}

	public function admin_cancelaccount() {

		// display a form for cancelling account.
		if (!empty($this->request->data)) {
			// cancel account
			$shopId = Shop::get('Shop.id');
			$this->Shop->id = $shopId;
			
			$this->Shop->RecurringPaymentProfile->recursive = -1;
			$profile = $this->Shop->RecurringPaymentProfile->find('first', array('conditions'=>array('shop_id'=>$shopId,
														 'status'=>'active')));
			
			$result = false;
			
			
			if (isset($profile['RecurringPaymentProfile']['gateway_reference_id'])) {
				
				if ($profile['RecurringPaymentProfile']['gateway'] == 'paypal') {
					$result = $this->cancelPaypalSubscription($profile['RecurringPaymentProfile']['gateway_reference_id']);
					if (isset($result['ACK']) && strtoupper($result['ACK']) == 'SUCCESS') {
						
						$profile['RecurringPaymentProfile']['status'] = 'cancel';
						
					}	
				} else if ($profile['RecurringPaymentProfile']['gateway'] == 'paydollar') {
					$result = $this->runDeleteSchPay($profile['RecurringPaymentProfile']['gateway_reference_id']);
					if (isset($result['resultCode']) && $result['resultCode'] == 0) {
						
						$profile['RecurringPaymentProfile']['status'] = 'cancel';
						
					}
				}
				
				// now need to reflect the status of the recurring payment profile
				$this->Shop->RecurringPaymentProfile->save($profile);
				
			}
			
			if ($result) {
				// we need to change the deny_access value to true in database
				$result = $this->Shop->saveField('deny_access', true);
				
			}
			
			
			
			if($result) {
				
				// create cancellation records
				$this->request->data['Cancellation']['shop_id'] = $shopId;
				$this->request->data['Cancellation']['user_id'] = User::get('User.id');
				
				$cancellation = ClassRegistry::init('Cancellation');
				
				$cancellation->create();
				
				$cancellation->save($this->request->data);
				
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
	
	private function cancelPaypalSubscription($ProfileID) {
		
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
	
	private function runDeleteSchPay($mSchPayId) {
		
		$PayDollarConfig = array('Sandbox' => Configure::read('paydollar.sandbox'),
                         'APIMerchantID' => Configure::read('paydollar.api.merchantid'),
                         'APILoginID' => Configure::read('paydollar.api.loginid'),
                         'APIPassword' => Configure::read('paydollar.api.password'),
                         'UrlEncodeStringValues' => true);
		
		$PayDollar = new PayDollar($PayDollarConfig);
		
		$DSPFields = array('mSchPayId' => $mSchPayId);
		
		$PayDollarRequestData = array('DSPFields' => $DSPFields,);
		
		return $PayDollar->DeleteSchPay($PayDollarRequestData);
		
	}
	

}
?>