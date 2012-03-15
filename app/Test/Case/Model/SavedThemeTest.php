<?php
/* SavedTheme Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('SavedTheme', 'Model');
App::uses('User', 'Model');
App::uses('Shop', 'Model');

/**
 * SavedTheme Test Case
 *
 */
class SavedThemeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
public $fixtures = array(
	'app.aro', 'app.aco', 'app.aros_aco',
	'app.shop',  'app.domain',
	'app.shop_setting', 'app.language',
	'app.user', 'app.group',
	'app.merchant', 'app.customer', 'app.casual_surfer',
	'app.cart', 'app.cart_item',
	'app.order', 'app.order_line_item', 'app.fulfillment', 'app.address', 
	'app.product', 'app.product_image', 'app.wishlist', 
	'app.variant', 'app.variant_option', 'app.products_in_group', 'app.product_group',  
	'app.product_type', 'app.vendor',
	'app.smart_collection_condition',
	'app.webpage', 'app.page_type', 
	'app.link_list', 'app.link', 
	'app.blog', 'app.post', 'app.comment', 
	'app.paypal_payment_module',
	'app.payment', 'app.shops_payment_module', 'app.payment_module',
	'app.log', 'app.saved_theme', 'app.theme',
	'app.country',
	'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
	'app.price_based_rate', 'app.weight_based_rate',
	'app.invoice', 'app.recurring_payment_profile',	
);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->SavedTheme = ClassRegistry::init('SavedTheme');
		
		// setting up Shop and User singleton
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$cachedUserId = User::get('User.id');
		
		if($cachedUserId != 1) {
			User::store($this->User->read(null, 1));
		}
		// this is to allow User singleton to work properly
		// look at AppController beforeFilter
		Configure::write('run_test', true);
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SavedTheme);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
	
	/**
	*
	* private test of an expected SavedTheme
	*
	**/
	private function savedThemeShouldBeValid($expected) {
		$result = $this->SavedTheme->find('first', array(
			'conditions' => array('SavedTheme.id' => $expected['id'])
			)
		);
		
		if (!$result) {
			return false;
		}

		foreach ($result['SavedTheme'] as $key=>$value) {
			if ($key != 'created' && $key != 'modified') {
				$this->assertEquals($expected[$key], $value);
			}
		}
		
		$resultOfFolder = $this->savedThemeFolderExists($expected['folder_name']);

		$this->assertTrue($resultOfFolder);
		
		return $resultOfFolder;

	}
	
	/**
	*
	* check for the folder and the files
	*
	**/
	private function savedThemeFolderExists($folderName) {
		$result = $this->SavedTheme->folderOrFileExists($folderName, SAVED_THEMES_DIR);

		$baseFoldersExpected = array(
			'Config', 'Templates', 'Layouts', 'Snippets', 'webroot'
		);
		
		$result = $result && $this->SavedTheme->entriesExistInFolder($baseFoldersExpected, SAVED_THEMES_DIR . $folderName);
		
		return $result;
	}
	
/**
*
* test if the create a new SavedTheme by uploading a zipfile
*
* @return void
**/
	public function testCreateByUploadFile() {
		// GIVEN an actual zip file
		$pathToZipFile = dirname(dirname(dirname(__FILE__))) . DS . 'Fixture' . DS . 'File' . DS . 'themename.zip';
		
		// AND we do NOT have the SavedTheme folder Shop2SavedTheme2 yet
		$this->SavedTheme->deleteFolder('Shop2SavedTheme2');
		
		// AND uploaded data array is of the following format
		$inputData = array(
			'SavedTheme' => array(
				'upload' => array(
					'name' 		=> 'themename.zip',
					'tmp_name' 	=> $pathToZipFile
				)
			)
		);
		
		// WHEN we run createByUploadFile
		$result = $this->SavedTheme->createByUploadFile($inputData);
		
		// THEN we expect the result to be true
		$this->assertTrue($result);
		
		// AND we expect the corresponding record
		$expected = array(
			'id' => '2',
			'name' => 'themename',
			'description' => '',
			'author' => 'Barry Allen',
			'folder_name' => 'Shop2SavedTheme2',
			'shop_id' => '2',
			'theme_id' => '0',
			'featured' => false

		);
		
		// AND we expect the record inside database 
		// AND the folder exists as well as the files inside
		$this->assertTrue($this->savedThemeShouldBeValid($expected));
		
		// AND we need to clean up the SavedTheme folder
		$this->SavedTheme->deleteFolder('Shop2SavedTheme2');
		
	}


}
?>