<?php
class Merchant extends AppModel {

	public $name = 'Merchant';
	
	

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

	);

	/**
	 * override the beforeSave method in AppModel
	 * always set the group_id to MERCHANTS and to set ownership of new shop to this newly created merchant
	 *
	 * @param array $options Array of options
	 *
	 * @return boolean True so that the save operation can continue
	 *
	 **/
	public function beforeSave($options = array()) {
		if (empty($this->data['Merchant']['id']) AND empty($this->data['Merchant']['owner'])) {
			$this->data['Merchant']['owner'] = true;
		}
		$this->data['User']['group_id'] = MERCHANTS;
		return true;

	}

	
	/** 
	*
	* we want to use transaction to rollback in case of errors
	*
	* 1) Domain
	* 2) ShopSetting
	* 3) Invoice
	* 4) ShippedToCountry and ShippingRate
	* 5) Blog and Post
	* 6) Webpage
	* 7) LinkList and Link
	* 8) Vendor and ProductType
	*
	* This is outside of the transaction because copyable does not work well with transaction
	* Product via copyable
	* FrontPage Collection
	* 
	***/
	public function signupNewAccount($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;

			// now to start the transaction

			$datasource = $this->getDataSource();

			$datasource->begin($this);

			$result = $this->saveAll($data, array('validate'=>'first',
							      'atomic'=>false));

			App::uses('SaveAllLib', 'UtilityLib.Lib');
			
			$fail = !SaveAllLib::hasASuccessful($result);

			if ($fail) {
				$datasource->rollback($this);
				return false;
			}


			// we need to create domain entries
			$domain = $this->Shop->Domain;

			$domainData = array();

			$domainData['Domain']['domain']  = $data['Shop']['primary_domain'];
			$domainData['Domain']['primary'] = true;
			$domainData['Domain']['shop_id'] = $this->Shop->id;
			$domainData['Domain']['shop_web_address'] = true;
			$domain->create();
			$result = $domain->save($domainData);

			if (!$result) {
				$datasource->rollback($this);
				return false;
			}

			// we need to create shop settings
			$shopSetting = $this->Shop->ShopSetting;

			$settingData = array();


			$settingData['ShopSetting']['shop_id'] = $this->Shop->id;

			/* timezone, unit_system, currency, checkout language dependent on country */
			$settingData['ShopSetting']['timezone']  = 'Asia/Singapore';
			$settingData['ShopSetting']['unit_system'] = 'metric';		
			$settingData['ShopSetting']['currency'] = 'SGD';
			$settingData['ShopSetting']['checkout_language'] = 1;


			/* money in html, email with or without currency */
			$settingData['ShopSetting']['money_in_html']  = '{{amount}}';
			$settingData['ShopSetting']['money_in_html_with_currency'] = '${{amount}}';		
			$settingData['ShopSetting']['money_in_email'] = '{{amount}}';
			$settingData['ShopSetting']['money_in_email_with_currency'] = '${{amount}}';

			$shopSetting->create();
			$result = $shopSetting->save($settingData);

			if (!$result) {
				$datasource->rollback($this);
				return false;
			}


			// we need to create invoice entries
			$invoice = $this->Shop->Invoice;

			$invoiceData = array();

			$invoiceData['Invoice']['title']  = $data['Invoice']['title'];
			$invoiceData['Invoice']['description'] = $data['Invoice']['description'];
			$invoiceData['Invoice']['shop_id'] = $this->Shop->id;
			$invoice->create();
			$invoiceData = $invoice->save($invoiceData);

			if (!$invoiceData) {
				$datasource->rollback($this);
				return false;
			}

			// now we need to populate the shipping rates

			$shippedCountriesArray = array('native_country' => 192,
						       'rest_of_world' => 0);

			$shippedToCountry = ClassRegistry::init('ShippedToCountry');

			foreach ($shippedCountriesArray as $countryID) {

				$shippedData = array();	
				$shippedData['ShippedToCountry']['country_id'] = $countryID;
				$shippedData['ShippedToCountry']['shop_id'] = $this->Shop->id;

				$shippedToCountry->create();
				$result = $shippedToCountry->save($shippedData);

				if ($result) {
					// standard weight
					$shippedData = array();
					$shippedData['WeightBasedRate']['displayed_min_weight'] = 10;
					$shippedData['WeightBasedRate']['displayed_max_weight'] = 20;
					$shippedData['WeightBasedRate']['unit'] = 'kg';
					$shippedData['ShippingRate']['price'] = 10;
					$shippedData['ShippingRate']['shipped_to_country_id'] = $shippedToCountry->id;
					$shippedData['ShippingRate']['name'] = 'Standard Shipping';

					$shippedToCountry->ShippingRate->create();
					$shippedToCountry->ShippingRate->saveAll($shippedData, array('atomic'=>false));

					// heavy duty
					$shippedData = array();
					$shippedData['WeightBasedRate']['displayed_min_weight'] = 20;
					$shippedData['WeightBasedRate']['displayed_max_weight'] = 50;
					$shippedData['WeightBasedRate']['unit'] = 'kg';
					$shippedData['ShippingRate']['price'] = 25;
					$shippedData['ShippingRate']['shipped_to_country_id'] = $shippedToCountry->id;
					$shippedData['ShippingRate']['name'] = 'Heavy Duty';

					$shippedToCountry->ShippingRate->create();
					$shippedToCountry->ShippingRate->saveAll($shippedData, array('atomic'=>false));

				} else {
					$datasource->rollback($this);
					return false;
				}

			}

			// now we set up the blog
			$blog = ClassRegistry::init('Blog');

			$blogData = array('Blog'=>array('title'=>'news',
							'shop_id'=>$this->Shop->id));

			$blog->create();
			$result = $blog->save($blogData);
$this->log('blog');
			if (!$result) {
				$datasource->rollback($this);
				return false;
			}

			// store the new blog data into variable called $shopBlog
			$shopBlog = $result;

			// now we set up the first post announcing open for business!
			$post = ClassRegistry::init('Post');

			$postData = array('Post'=>array('title'=>'Open for business!',
							'content'=>'We are OPEN for business!!',
							'author_id'=>$this->User->id,
							'blog_id'=>$blog->id,
							));


			$post->create();
			$result = $post->save($postData);
$this->log('post');
			if (!$result) {
				$datasource->rollback($this);
				return false;
			}

			// now we set up the shopfront page and other pages
			$webpage = ClassRegistry::init('Webpage');
			$webpage->recursive = -1;
			$homePage = array(
			             'title'=>'Welcome',
					     'content'=>'<div>
	                                <h2>Welcome</h2>
	                                <p>Congratulations on starting your own e-commerce store and on your way towards buiding a business empire!</p>
	                                <p>This is the front page of your store - the first thing your customers will see when they arrive</p>
	                                <p>To start adding products or edit this page, head over to <a href="/">Admin</a></p>
	                                <p>Enjoy our services, <br />
	                                Team OMBI60</p>
	                                </div>',
						'shop_id'=>$this->Shop->id,
						'author'=>$this->User->id,
						'handle'=>'shopfront');

			$aboutUsPage = array('title'=>'About Us',
					     'content'=>'<p>The <strong>About Us</strong> page is important.</p>
					     <p>Customers visit About Us page when they are new to your online shop. They want to establish a level of trust in your business.  Since trust is crucial when selling online, it\'s a good idea to provide a fair amount of information about yourself and your business.  Here are a few things you should touch on:</p>
	<ul>

	  <li>Who you are</li>

	  <li>Why you are selling these items</li>

	  <li>Where your business is located</li>

	  <li>How long you have been in business</li>

	  <li>Who are the people on your team</li>
	</ul>
	<p>Go to the <a href="/admin/pages">Blogs &amp; Pages</a> in administration menu.</p>',
							'shop_id'=>$this->Shop->id,
							'author'=>$this->User->id,
							'handle'=>'about-us');

			$tosPage = array('title'=>'Terms of Service',
					     'content'=>'<p>The <strong>Terms of Service</strong> page is for you to enter any privacy statements or terms of service you wish to render.</p>
					     <p>Customers may need to know the limits of their patronage, so here are a few things you should touch on:</p>
	<ul>

	  <li>Who you are</li>

	  <li>What you would consider as acceptable customer behavior</li>

	  <li>Any limits as to whom you can serve or which regions you can serve</li>

	  <li>What legal recourses you would seek if customers abuse your service</li>

	  <li>What rights you reserve as a business owner</li>
	</ul>
	<p>Go to the <a href="/admin/pages">Blogs &amp; Pages</a> in administration menu.</p>',
							'shop_id'=>$this->Shop->id,
							'author'=>$this->User->id,
							'handle'=>'terms-of-service');


			$pageData = array('Webpage'=>array('homePage'=>$homePage,
							   'aboutUsPage'=>$aboutUsPage,
							   'tosPage' => $tosPage));
			$pageIDs = array();

			foreach($pageData['Webpage'] as $pageName => $page) {
				$webpage->create();
				$result = $webpage->save($page);
				$this->log('webpage');
				
				if (!$result) {
					$datasource->rollback($this);
					return false;
				}
				$pageIDs[$pageName] = $webpage->id;
			}

			// now we set up the links
			$this->Shop->LinkList->create();
			$linkListData = array(
				'LinkList' => array(
					'shop_id' => $this->Shop->id,
					'name'    => 'Main Menu',
					'handle'  => 'main-menu'),
				'Link'     => array(
					array('name'	=> 'Home',
					      'route'	=> '/',
					      'model'	=> '/',
					      'order'	=> '0'),
					array('name'	=> 'About Us',
					      'route'	=> '/pages/about-us',
					      'model'	=> '/pages/',
					      'action'	=> 'about-us',
					      'order'	=> '1',
					      'parent_model' => 'Webpage',
					      'parent_id' => $pageIDs['aboutUsPage']),
					array('name'	=> 'Catalogue',
					      'route'	=> '/collections/all',
					      'model'	=> '/collections/all',
					      'order'	=> '2'),
					array('name'	=> 'Blog',
					      'route'	=> '/blogs/news' ,
					      'model'	=> '/blogs/',
					      'action'	=> $shopBlog['Blog']['short_name'],
					      'order'	=> '3',
					      'parent_model' => 'Blog',
					      'parent_id' => $blog->id),
					array('name'	=> 'Cart',
					      'route'	=> '/cart',
					      'model'	=> '/cart',
					      'order'	=> '4')
					));

			$result = $this->Shop->LinkList->saveAll($linkListData, array(
				'atomic' => false
			));
			
			$fail = !SaveAllLib::hasASuccessful($result);
			
			$this->log($result);
			
			$this->log('linklist');

			$this->log($fail);

			if ($fail) {
				$datasource->rollback($this);
				return false;
			}

			$this->Shop->LinkList->create();
			$linkListData = array(
				'LinkList' => array(
					'shop_id' => $this->Shop->id,
					'name'    => 'Footer Menu',
					'handle'  => 'footer-menu'),
				'Link'     => array(
					array('name'	=> 'Terms of Service',
					      'route'	=> '/pages/terms-of-service',
					      'model'	=> '/pages/',
					      'action'	=> 'terms-of-service',
					      'order'	=> '0',
					      'parent_model' => 'Webpage',
					      'parent_id' => $pageIDs['tosPage']),
					array('name'	=> 'About Us',
					      'route'	=> '/pages/about-us',
					      'model'	=> '/pages/',
					      'action'	=> 'about-us',
					      'order'	=> '1',
					      'parent_model' => 'Webpage',
					      'parent_id' => $pageIDs['aboutUsPage'])

					));

			$result = $this->Shop->LinkList->saveAll($linkListData, array(
				'atomic' => false
			));
			
			$this->log($result);
			$fail = !SaveAllLib::hasASuccessful($result);
			$this->log('linklist');

			$this->log($fail);
						
			if ($fail) {
				$datasource->rollback($this);
				return false;
			}


			// now we set up the theme
			$savedTheme = ClassRegistry::init('SavedTheme');

			$options = array('theme_id' => $data['Merchant']['theme_id'],
					 'shop_id' => $this->Shop->id,
					 'author' => $data['User']['full_name'],
					 'user_id' => $this->User->id);

			$result = $savedTheme->saveThemeAtSignUp($options);


$this->log('theme');
$this->log($result);
			if (!$result) {
				$datasource->rollback($this);

				$folder = new Folder();
				$folder->delete(ROOT . DS . 'app' . DS . 'views' . DS . 'themed' . DS . $this->Shop->id . '_cover');


				return false;
			} else {
				$datasource->commit($this);
			}

			// create new vendor
			$vendorModel = $this->Shop->Vendor;

			$vendorModel->create();
			$vendorData = array('title'	=>'OMBI60',
					    'shop_id'	=> $this->Shop->id);
			$vendorModel->save($vendorData);

			// create new product type
			$typeModel = $this->Shop->Product->ProductType;
			$typeModel->create();
			$typeData = array('title'	=>'Shirts',
					  'shop_id'	=> $this->Shop->id);
			$typeModel->save($typeData);

			// since copyable does not allow non-atomic transaction so we put this outside the transaction.
			// now we create the dummy default product for this shop.
			$parentIDs = array('shop_id'   		=> $this->Shop->id,
					   'vendor_id' 		=> $vendorModel->id,
					   'product_type_id'	=> $typeModel->id);
			$result = $this->Shop->Product->duplicate(DEFAULT_PRODUCT_ID, $parentIDs);

			// this is the product id of the newly minted dummy product
			$productID = $this->Shop->Product->getLastInsertID();

			// create the Frontpage collection
			$data = array('ProductGroup'=>array('title'=>'Frontpage',
							    'shop_id'=>$this->Shop->id),
				      'ProductsInGroup'=>array(array('product_id'=>$productID)));

			$saveGroupResult = $this->Shop->Product->ProductsInGroup->ProductGroup->saveAll($data);


			if ($saveGroupResult)	{
				$productGroupID = $this->Shop->Product->ProductsInGroup->ProductGroup->getLastInsertID();
				$productModel = $this->Shop->Product;

				$productModel->updateCounterCacheForM2M('VisibleProductInGroup', array($productGroupID));
				$productModel->updateCounterCacheForM2M('AllProductInGroup', array($productGroupID));	

			}



			if ($invoice->id > 0) {
				// now we need to generate a unique reference number for the created invoice
				$invoiceData = $invoice->updateReference($invoice->id, $invoiceData);

				return $invoiceData;	
			}

			return false;		

		}
		
		
		/**
		*
		* Update merchant's profile
		*
		* @param array $data Data array containing User and Shop model data
		* @return boolean Returns true if successful. False otherwise
		**/
		public function updateProfile($data = NULL) {
			$data['User']['group_id'] = MERCHANTS;
			return $this->saveAll($data, array('validate'=>'first'));
		}

		/**
		*
		* Retrieve Shop, User, Language model data based on User id
		*
		* @param integer $id User id
		* @return array Returns data array if successful. False otherwise
		**/	
		public function retrieveShopUserLanguageByUserId($id = false) {
			if (!$id) {
				return false;
			}

			$this->Behaviors->load('Linkable.Linkable');
			$result = $this->find('first', array(
				'conditions'=>array(
					'Merchant.user_id'=>$id
				),
				'link' => array(
					'User' => array(
						'Language'
					),
					'Shop'
				)

			));

			return $result;

		}

}
?>
