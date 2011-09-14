<?php
App::import('Vendor', 'PayDollar', array('file'=>'paydollar'.DS.'includes'.DS.'paydollar.nvp.class.php'));
class PaydollarTransactionsController extends AppController {

	public $name = 'PaydollarTransactions';
	
	public $components = array('Paydollar.Paydollar');


	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		if(isset($this->Security) && $this->request->action == 'datafeed') {
			$this->Security->enabled = false;
		}

		
		$this->Auth->allow('datafeed');
	}
	
	public function datafeed() {
		
		$this->autoRender = false;
		
		Configure::write('debug', 0);
		
		if($this->request->is('post')) {
			
			$PayDollarConfig = array('Sandbox' => Configure::read('paydollar.sandbox'),
                         'APIMerchantID' => Configure::read('paydollar.api.merchantid'),
                         'APILoginID' => Configure::read('paydollar.api.loginid'),
                         'APIPassword' => Configure::read('paydollar.api.password'),
                         'UrlEncodeStringValues' => true);

			$PayDollar = new PayDollar($PayDollarConfig);
			
			// collect the fields from the POST params
			$DFFields = $PayDollar->ConvertPOSTToDataFeed($_POST);
			
			$data = array('PaydollarTransaction' => array());
			
			
			foreach($DFFields as $key=>$value) {
				$data['PaydollarTransaction'][strtolower($key)] = $value;
			}
			
			$result = $this->PaydollarTransaction->save($data);
			
			if($result) {
				echo 'OK';
			} else {
				echo 'FAIL because cannot save';
			}

		} else {
			echo 'FAIL because not POST';
		}
	}


}
?>