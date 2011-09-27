<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
App::uses('HttpSocket', 'Network/Http');

class ProductsController extends AppController {

	public $name = 'Products';
	
	public $helpers = array('Javascript', 'Ajax',
			     'TinyMce.TinyMce', 'Text');
	
	public $components = array('Permission'=>array(
					'prefixActionsWithPrimaryForeignKey' => array(
						'Variant'=>array('admin_edit_variant',
								 'admin_delete_variant')),
					'prefixActionsWithPrimaryKey' => array(
						'Variant'=>array('admin_add_variant',
								 )),
					),
				'Paypal.Paypal',
				
				'Theme' => array('actions'=>array('view_cart',
								  'view',
								  'index',
								  'view_by_group',
								  'view_within_group',
								)),
				
				
				);
	
	public $view = 'TwigView.Twig';
	
	public $cartModel = '';
	public $cartItemModel = '';

	public function beforeFilter() {
		/**
		 * initialize the cartModel and cartItemModel
		 * **/
		$this->cartModel 	= $this->Product->Shop->Cart;
		$this->cartItemModel 	= $this->cartModel->CartItem;
		
		// for uploadify to work, we must ensure that debug set to zero in admin_add and admin_edit
		

		// this is to allow admin_upload to work with Session component
		if ($this->request->action=='admin_upload') {
			
            $this->Session->id($this->request->params['url']['sess']);
			$this->Session->start();
			
		}
		
		// this is to override the cookie user id for products checkout for
		// crossing custom domains
		if(($this->request->action == 'checkout') AND (!empty($this->request->params['url']['ss']))) {
			
			$uuid = $this->request->params['url']['ss'];
			$siteTransfer = ClassRegistry::init('SiteTransfer');
			$data = $siteTransfer->findById($uuid);
			$this->Session->id($data['SiteTransfer']['sess_id']);
			
			// if session read write fails for paymentoption then need to re-evaluate this.
			$siteTransfer->delete($uuid);
			
			
			
		}


		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow('view', 'index',
				   'add_to_cart', 'view_cart',
				   'delete_from_cart', 'change_qty_for_1_item_in_cart',
				   'checkout', 'view_by_group', 'view_within_group');

		
		if ($this->request->action == 'view_cart' OR
		    $this->request->action == 'view' OR
		    $this->request->action == 'index'){
			
			// set the class for the overallcontainer
			$this->set('classForContainer', $this->configureContainerClass($this->name, $this->request->action));
		}
		
		// this is to allow the jquery to change the elements that control the file upload.
		$image = $this->Product->ProductImage;

		$this->Security->unlockedFields[] = $image->name . '.' . $image->defaultNameForImage;
		
		
		$this->checkoutLink = Router::url('/', true);
		
		if (($this->request->action == 'admin_index')
		    OR ($this->request->action == 'admin_add')
		    OR ($this->request->action == 'checkout')
		    ) {
			$this->Security->validatePost = false;
		}
		
		if ($this->request->action == 'admin_toggle' ||
		    $this->request->action == 'admin_edit'   ||
		    $this->request->action == 'admin_add_variant' ||
		    $this->request->action == 'admin_edit_variant' ||
		    $this->request->action == 'admin_menu_action'  ||
		    $this->request->action == 'add_to_cart' || 
			$this->request->action == 'view_cart'
		) {
			$this->Components->disable('Security');
		}
	}
	
	public function admin_menu_action() {
		$resultArray = $this->Product->handleMenuAction($this->request->data);
		if ($resultArray['success']) {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_success'));	
		} else {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_failure'));	
		}
		$this->redirect(array('action' => 'index'));
	}
	
	public function checkout() {
		// flag for paypal express checkout
		$paypal = false;
		$uuid = '';
		
		$userId = User::get('User.id');
		
		$cart = $this->cartModel->getLiveCartByCustomerId($userId, true);
		$postFields = array();
		
		if ($this->request->is('post')) {
			$shopId = Shop::get('Shop.id');
			$count = $this->request->data['Product']['products_count'];
			
			if ($count > 0) {
				
				
				$postFields['cart'] = $cart;
				
				$postFields['shopId'] = $shopId;
				$postFields['userId'] = $userId;
				$postFields['cancelURL'] = Router::url(array('controller'=>'products', 'action'=>'view_cart'), true);
				
				if(isset($this->request->params['form']['checkoutBtn'])) {
					// user clicked the submit button named proceedToCheckout... so we'll do that
					$postFields['paypal'] = 0;
				} else if (isset($this->request->params['form']['checkout'])) {
					$postFields['paypal'] = 1;
					$paypal = true;
				}
				
				$postFields['payments'] = $this->Session->read('Shop.' . $shopId . '.Payments');
				$postFields['paymentAmount'] = $this->Session->read('Shop.' . $shopId . '.paymentAmount');
				
				// transfer the session over	
				$postFields['uuid'] = $this->transferSession();
				$PPRedirectURL = '';
				
				// 1 final check in database on whether paypal option is turned on
				$paypalExpressOn = $this->Product->Shop->getPaypalExpressOn($shopId);
				
				
				if ($paypal AND $paypalExpressOn AND isset($cart['Cart']['hash'])) {
					$PayPalResult = $this->prepareSEC($postFields, $cart['Cart']['hash']);
					//$this->log('productspreparesec');
					//$this->log($PayPalResult);
					$PPRedirectURL = $PayPalResult['REDIRECTURL'];
				}
				
				// write the Payments to Session for the Paypal to work at the Payment Option stage
				$this->Session->write('Shop.'.$shopId.'.Payments', $postFields['payments']);
				
				if(!$paypal) {
					$step1Link = $this->makeCheckoutStep1Link($shopId, $cart['Cart']['hash'], $postFields['uuid']);
					$this->redirect($step1Link);	
				} else {
					$this->redirect($PPRedirectURL);
				}
				
			}
			$this->Session->setFlash(__('You need to have products in your cart'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action'=>'view_cart'));
		
	}
	
	
	private function prepareSEC($postFields, $hash) {
		
		
		$accountEmail = $this->Product->Shop->getAccountEmailPaypal($postFields['shopId']);
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'),
				      'APISubject' => $accountEmail);
		
		
		$PayPal = new PayPal($PayPalConfig);
		
		// return url refers to the page where the user sees shop page after paypal payment
		// should be the step 2 in shopify.com
		// since we redirect there from carts/checkout so we set it to carts/checkout first
		// subject to change based on security concerns
		$returnURL = '';
		$returnURL = Router::url(array('controller'=>'orders',
					       'shop_id'=>$postFields['shopId'],
					       'hash'=>$hash,
					       'action'=>'checkout',), true); 
		
		
		$returnURL .= '?paypal&uuid=' . $postFields['uuid'];
		
		
		$SECFields = $this->Paypal->buildSECFields(array('returnurl'=>$returnURL,
								 'cancelurl'=>$postFields['cancelURL'],
								 'maxamt'=>number_format($postFields['payments'][0]['amt'] + 1000, 2, '.', '')));
		
		
		
		$PayPalRequest = array(
				'SECFields' => $SECFields, 
				'SurveyChoices' => $this->Paypal->buildSurveyChoices(), 
				'Payments' => $postFields['payments']
				);
		
		
		$PayPalResult = $PayPal->SetExpressCheckout($PayPalRequest);
		if ($PayPalResult['ACK'] == 'Failure') {
			// may need to do a redirect to the normal checkout
			$this->log('direct result in products_controller.php line 207');
			$this->log($PayPalResult);	
		}
		
		// update the token inside sitetransfer
		$siteTransfer = ClassRegistry::init('SiteTransfer');
		$siteTransfer->id =  $postFields['uuid'];
		$siteTransfer->saveField('paypal_token', $PayPalResult['TOKEN']);
		
		/* does not work for some mysterious reason cannot pass sessions between this action and orders/checkout
		$this->Session->write('Shop.'.$postFields['shopId'].'.PayPalResult', $PayPalResult);
		$this->Session->write('Shop.'.$postFields['shopId'].'.Payments', $postFields['payments']);
		*/
		
		return $PayPalResult;
	}
	
	private function transferSession() {
		
		App::uses('String', 'Utility');
		$data = array();
		$data['SiteTransfer']['sess_id'] = $this->Session->id();
		
		$siteTransfer = ClassRegistry::init('SiteTransfer');
		$siteTransfer->id = String::uuid();
		if ($siteTransfer->save($data)) {
			return $siteTransfer->id;
		}
		
	}
	
	/**
	 * 
	 * Update quantity for single item in Cart
	 *
	 * @param integer $variant_id Id of the variant 
	 * @return void
	**/
	public function change_qty_for_1_item_in_cart($variant_id = 0) {

		$paramExist = !is_blank($this->params4GETAndNamed['quantity']);

		if ($paramExist) {
			$variantIsPositive 	= is_numeric($variant_id) && ($variant_id > 0);

			$quantity 			= $this->params4GETAndNamed['quantity'];
			$qtyIsNonNegative 	= is_numeric($quantity) && ($quantity >= 0);

			$continue = $variantIsPositive && $qtyIsNonNegative;

			if ($continue) {
				$this->cartModel->changeQuantityFor1Item($variant_id, $quantity);
			}

		}

		$this->redirect(array('action' => 'view_cart'));
	}
	
	/**
	 * 
	 * Action for viewing cart. Also handles postback for update cart and checkout.
	 *
	 * @param void
	 * @return void
	**/
	public function view_cart() {
		
		// need to check for POST and the Update button
		// update button is named as update (singular)
		// the update_x is to work with input type="image" for the update button
		$updateButtonUsed 		= isset($this->request->data['update']);
		$updateImageButtonUsed 	= isset($this->request->data['update_x']);
		$updateButtonTriggered	= ($updateButtonUsed OR $updateImageButtonUsed);

		if ($updateButtonTriggered) {
			$this->cartModel->editQuantities();
			$this->redirect(array('action' => 'view_cart'));
		}
		
		
		$checkoutButtonUsed 		= isset($this->request->data['checkout']);
		$checkoutImageButtonUsed 	= isset($this->request->data['checkout_x']);
		$checkoutButtonTriggered	= ($checkoutButtonUsed OR $checkoutImageButtonUsed);
		
		
		if ($checkoutButtonTriggered) {
			$this->log('checkout button works');
			$this->redirect(array('action' => 'view_cart'));
		}
		
		
		$products = array();
		$shop_id  = Shop::get('Shop.id');
		
		// check if shop wants to have paypal option
		$paypalExpressOn = $this->Product->Shop->getPaypalExpressOn($shop_id);
		
		// retrieve live cart of customer
		$productsInCart = $this->cartModel->getLiveCartByCustomerId(User::get('User.id'), true, true);
		
		
		
		$paymentAmount = 0.00;
			
		$PaymentOrderItems = array();
		$Payments = array();
		$currency = '';	
		
		$products = (isset($productsInCart['CartItem'])) ? $productsInCart['CartItem'] : array();
		
		$prepareSessionForPaypal = !empty($productsInCart) && $paypalExpressOn;
		
		if ($prepareSessionForPaypal) {
		
			// loop thru the cart inside Session
			foreach($products as $cart_id => $product) {
				// total the amount
				$paymentAmount += $product['product_price'] * number_format($product['product_quantity'],1);
				
				// build the item url
				$itemUrl = $this->Product->getProductUrl($product['product_id']);
			
				// build the item
				$item = $this->Paypal->buildItem(array(
							       'amt'=>$product['product_price'],
							       'name'=>$product['product_title'],
							       'qty'=>$product['product_quantity'],
							       'number'=>$product['product_id'],
							       'itemurl'=>$itemUrl,
							       'itemweightvalue'=>$product['product_weight'],
							       'itemweightunit'=>'grams'));
				
				array_push($PaymentOrderItems, $item);
				
				$currency = $product['currency'];
			}
			
			$paymentAmount = number_format($paymentAmount, 2);
			
			$Payment = $this->Paypal->buildPayment(array('amt'=>$paymentAmount,
								     'currencycode'=> $currency,
								     'itemamt'=>$paymentAmount,
								     'shippingamt'=>'0.00',
								     'taxamt'=>'0.00'));
			
			$Payment['order_items'] = $PaymentOrderItems;
			array_push($Payments, $Payment);
			
			// save all the payments into session
			$this->Session->write('Shop.'.$shop_id.'.Payments', $Payments);
			
		}
		
		$this->Session->write('Shop.' . $shop_id . '.paymentAmount', $paymentAmount);
		$cart_id = $productsInCart['Cart']['id'];
		
		
		// reassign the products into items
		$cart = Cart::getTemplateVariable($productsInCart);

		$this->set(compact('cart', 'paypalExpressOn', 'paymentAmount', 'cart_id'));
		
		$sessionString = '';
		$mainUrl = Shop::get('Shop.primary_domain');
		
		//$this->log('user id in view_cart ' . User::get('User.id'));
		
		// now we are going to pass the session into the database for the crossover for checkout
		
		if (!$this->Product->Shop->isCurrentBaseThisDomain($mainUrl)) {
			// test if we need to send User id over
			$this->Session->write('User.id', User::get('User.id'));
			//$this->log('new user id in session write ' . $this->Session->read('User.id'));
			$sessionString = '?ss='.$this->transferSession();
		}
		$this->set('sessionString', $sessionString);
		
		$this->render('cart');
	}
	
	public function admin_index() {
		
		$shop_id = Shop::get('Shop.id');
		
		$this->log($shop_id);
		
		$this->paginate = array(
			'conditions' => array(
				'AND' => array(
					'Product.shop_id' => $shop_id
				),// end AND
				'OR' => array(
					array('ProductImage.cover' => true),
					array('ProductImage.cover' => null),
				)// end OR	
			),// end conditions
			'link'=>array('ProductImage'),
			'fields'=>array(
				'Product.*', 
				'ProductImage.id', 
				'ProductImage.filename', 
				'ProductImage.dir'
			),
		);

		$this->set('products', $this->paginate());

	}
	

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$product_id = $id;
		$this->Product->recursive = -1;
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shopId = Shop::get('Shop.id');
		
		// get the product details
        $product = $this->Product->getDetails($id, true); //This action gets complete product information
		$this->set(compact('collections', 'product', 'variantOptions'));
		// for uploadify
		// the images list related code
		// to make paging easier to test, we set as 1 per page.
		$this->paginate = array('conditions'=>array('ProductImage.product_id'=>$id),
                                      'order' => 'ProductImage.cover desc',
                                      'limit'=>'10');
	
		$productImages = $this->paginate('ProductImage');
		
		$errors = array();
		
		$count = count($productImages);
	    
		$uploadifySettings = array('browseButtonId' => 'fileInput',
                                         'script' => Router::url("/admin/products/upload/".$product_id, true),
                                         'auto' => true,
                                                                       'buttonText' => __('Choose File'),
                                         'onComplete' => true,);
		    
		
		
		$this->set(compact('product_id', 'productImages',
				   'errors', 'uploadifySettings'));

	}

	public function view($handle = false) {
		$productFound = $this->prepareProductForView($handle);

		$product = Product::getTemplateVariable($productFound, false);

		$this->set('product', $product);
		$this->set('page_title', $product['title']); // this is hardcoded for index page
		$this->render('product');
	}

	/**
	 *
	 * Return product that is not yet formatted for theme. 
	 * Used by view and view_within_group actions
	 * 
	 * @param string $handle Handle retrieved from url to get Product
	 * @return array Array containing data from database representing Product, ProductImage, ProductGroup
	**/
	private function prepareProductForView($handle = false) {


		if (!$handle) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/','viewVars' =>$this->viewVars,)));
		}

		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');

		// get the product details
		$productFound = $this->Product->find('first', array('conditions'=>array('Product.visible' => true,
											'Product.handle'=>$handle,
											'Product.shop_id'=>$shop_id),
								    'contain' => array('Variant' => array(
												'order'=>'Variant.order ASC',
												'VariantOption' => array(
													'fields' => array('id', 'value', 'field'),
													'order'  => 'VariantOption.order ASC',
												)
											),
										       'ProductImage'=>array(
												'fields' => array('filename'),
												'order'=>array('ProductImage.cover DESC'),
											),
											'ProductsInGroup'=>array(
												'fields' => array('id', 'product_id'),
												'ProductGroup'=>array(
													'fields' => array('id', 
															  'title', 'handle',
															  'description', 'visible_product_count',
															  'url', 'vendor_count'),
													)
												)
											)
									));	



		// must be valid shop
		$invalidShop = !($shop_id > 0);
		// product must exist
		$noSuchProduct = ($invalidShop) ? true : empty($productFound['Product']);

		if (   $invalidShop OR $noSuchProduct) {

			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/','viewVars' =>$this->viewVars,)));

		}

		return $productFound;
	}

	public function view_within_group($handle = false, $product_handle = false) {

		$shopId = Shop::get('Shop.id');

		$exists = $this->Product->ProductsInGroup->checkProductInCollection($product_handle, $handle, $shopId);

		if (!$exists) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));			
		}

		$productFound = $this->prepareProductForView($product_handle);

		// check for handle
		if (!$handle) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}

		// this will retrieve the collection details as well as the conditions needed for pagination of Product
		$collection = $this->Product->ProductsInGroup->ProductGroup->getByUrl($handle, $this->params4GETAndNamed);

		if ($collection == false) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}

		$product = Product::getTemplateVariable($productFound, false);

		$collection = ProductGroup::getTemplateVariable($collection, false);

		$this->set(compact('product', 'collection'));
		$this->set('page_title', $collection['title'] . ' > ' . $product['title']);
		$this->render('product');

	}	
	
	public function view_by_group($handle = false) {
		
		// check for handle
		if (!$handle) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		// this will retrieve the collection details as well as the conditions needed for pagination of Product
		$collection = $this->Product->ProductsInGroup->ProductGroup->getByUrl($handle, $this->params4GETAndNamed);
		
		if ($collection == false) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}

		// assign the conditions for the pagination of Product
		$this->paginate = $collection['ProductGroup']['product_paginate'];
		
		// paginate using the parent model Product
		$products = $this->paginate('Product');
		
		// assign the paginated products back into $collection
		$collection['Product'] = $products;
		
		// prepare the template variable
		$collection = ProductGroup::getTemplateVariable($collection, false);
		
		$domainPagePath = Router::url('/collections/'.$handle.'/', true);
		
		// check for any sorting or ordering parameters
		$sort = isset($this->request->params['named']['sort']) ? $this->request->params['named']['sort'] : 'created';
		
		$order = isset($this->request->params['named']['direction']) ? $this->request->params['named']['direction'] : 'desc';

		$this->set(compact('sort', 'order', 'domainPagePath', 'collection'));
		
		$this->set('page_title', $collection['title']); // this is hardcoded for index page
		
		$this->render('collection');
		
	}


	public function admin_add() {
		
		$this->set('title_for_layout', 'Add Product');
		
		if ($this->request->is('post')) {

			$this->Product->create();
			if ($this->Product->createDetails($this->request->data)) {
				$id = $this->Product->getLastInsertId();
		
				//$this->Product->ProductImage->saveFILESAsProductImages($product_id); //This will save product images
			
				$this->Session->setFlash(__('Product has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			
			} else {
				$this->Session->setFlash(__('Product could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			
			
		}
		
		
		$errors = $this->Product->getAllValidationErrors();
		
		$collections = $this->Product->ProductsInGroup->ProductGroup->find('list', array('conditions'=>array('ProductGroup.type'=>CUSTOM_COLLECTION,
												'ProductGroup.shop_id'=>Shop::get('Shop.id'))));
		
		$this->set(compact('errors', 'collections'));
		
	}
	
	/**
	 * should be called by ONLY uploadify plugin
	 **/
	public function admin_upload($id = null) {
	
		$this->layout = 'json';
		$successJSON = false;
		$contents = array();
		
	
		if ($id == null) {
			echo "0";
		}
		
		if (!empty($_FILES)) {
	
			$tempFile = $_FILES['Filedata'];
			
			$this->Product->ProductImage->create();
			$data = array('ProductImage'=>array('filename'=>$tempFile,
							    'product_id' => $id,));
			
			$result = $this->Product->ProductImage->uploadifySave($data);
			
			if ($result != false) {
				$contents = array('id'=>$this->Product->ProductImage->id,
						  'filename'=>$result['ProductImage']['filename'],
						  'cover'=>$result['ProductImage']['cover']);
			}
			$successJSON = true;
			
			$this->set(compact('contents', 'successJSON'));
			$this->render('json/response');
		
		}
		
		
	}
	
	public function admin_toggle($id = false) {
		
		$result = $this->Product->toggle($id, 'visible');
		
		// update all the visible_product_count
		if ($result) {
			$this->Product->updateCounterCacheForM2MMain($id, array(), false);	
		}
		
		if ($this->request->params['isAjax']) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				$errors = $this->Product->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('Product status has been changed'), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Product status could not be changed. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			$this->redirect(array('action' => 'index'));
		}
		
	}
	
	public function admin_edit($id = null) {
   
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
   
		if (!empty($this->request->data)) {		  
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}

		if (empty($this->request->data)) {
			// get the product details
			$this->request->data = $this->Product->getDetails($id, true); //This action gets complete product information
		}

		$product_id = $id;
		
		$errors = array();
		
		$collections = $this->Product->ProductsInGroup->ProductGroup->find('list', array('conditions'=>array('ProductGroup.type'=>CUSTOM_COLLECTION,
												'ProductGroup.shop_id'=>Shop::get('Shop.id'))));
		
	
   		
    
    
		$this->set(compact('product_id', 'errors', 'collections'));
				
		$this->render('admin_edit');

	}
	
	
	
	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be deleted. Please, try again.'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

	public function admin_duplicate($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->duplicate($id)) {
			$this->log('success duplicating product. in file ' . __FILE__ . ' under function name ' . __FUNCTION__ . ' line ' . __LINE__);
			$this->Session->setFlash(__('Product duplicated'), 'default', array('class'=>'flash_success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be duplicated. Please, try again.'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

	public function platform_index() {

		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());

	}

	public function platform_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	public function platform_add() {
		if ($this->request->is('post')) {
			$this->Product->set($this->request->data);

			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		$this->set('errors', $this->Product->invalidFields());
	}

	public function platform_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The Product has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Product->read(null, $id);
		}
	}

	public function platform_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be deleted. Please, try again.'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	public function add_to_cart() {
		$id = !empty($_POST['id']) ? $_POST['id'] : false;
		
		if(!$id) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect($this->referer());
		}
		
		$qty = 1;
		
		$qtyExists = !empty($_POST['quantity']);
		$qtyIsPositive = $qtyExists ? is_numeric($_POST['quantity']) AND ($_POST['quantity'] > 0) : false;
		if ($qtyIsPositive) {
			$qty = 	$_POST['quantity'];
		}
		
		if($this->addToCart($id, $qty)) {
			$this->Session->setFlash(__('Product added to cart'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'view_cart'));
		}
		$this->Session->setFlash(__('The Product could not be added to cart. Please, try again.'), 'default', array('class'=>'flash_failure'));
		$this->redirect($this->referer());
	}
	
	/**
	 * 
	 * Add Variant to Cart given the variant id and quantity. 
	 * Wrapper function that bridges between the public action and the model function that does the lifting.
	 *
	 * @param integer $id 
	 * @param integer $quantity
	 * @return boolean Returns true if successful.
	**/
	private function addToCart($id = null, $quantity = 1) {
		$cartModel = $this->cartModel;
		return $cartModel->addProductForCustomer(User::get('User.id'), array($id=>$quantity));
	}
		
	private function makeCheckoutAppLink () {
		if (!empty($this->checkoutLink)) {
			
			return $this->checkoutLink . '/carts/add';
		}
		return false;
	}
	
	private function makeCheckoutStep1Link($shopId, $hash, $uuid) {
		if (!empty($this->checkoutLink) AND !empty($hash) AND $shopId) {
			
			return $this->checkoutLink . 'orders/' . $shopId . '/' . $hash . '/checkout?uuid='.$uuid;
		}
		return false;
	} 
  

  
	/**
	 * This action is used to search product from database
	 *
	 */
	public function admin_search() {
		$products = "";
		$product_group_id = "";
	  
		if (!empty($this->request->data)) {
			if (isset($this->request->data['Product']['title'])) {
				$title = addslashes(trim($this->request->data['Product']['title']));
				$product_group_id = (int)$this->request->data['Product']['product_group_id'];
				$conditions = array(
					       'Product.title LIKE "%'.$title.'%"',
					       'Product.shop_id' => Shop::get('Shop.id'),
					      );
				
				
				$products = $this->Product->find('all', array('conditions' => $conditions, 'contain' => array('ProductsInGroup', 'ProductImage')));
			}
		}
		$this->autoRender = false;
		$this->layout = '';
		$this->ext = '.ctp';
		$this->set(compact('products', 'product_group_id'));
		
		
		$this->render('admin_product_search', 'ajax',APP . 'View' . DS . 'Elements' . DS.'/admin_product_search.ctp');
	       
	}//end admin_search()
        
        /**
         * This action is used to manupulate variant option
         * 
         * @param Array $product Array of productInfo
         * 
         * @return array of options
         * */
        public function admin_remove_variant_option($id) {
                if ($this->request->params['isAjax']) {
                        $this->layout = "";
                }
                if ($this->Product->Variant->VariantOption->delete($id)) {
                        $successJSON  = true;
                        $this->set(compact('successJSON'));
                        $this->render('../Json/empty');
                }
        }
	
	public function admin_add_variant($productId = false) {
		if(!($productId)) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'admin_index'));
		}
		if (!empty($this->request->data)) {
			$this->Product->Variant->create();
			
			$this->request->data['Variant']['product_id'] = $productId;
			
			if ($this->Product->Variant->saveAll($this->request->data))	{
				$this->Session->setFlash(__('Variant added'), 'default', array('class'=>'flash_success'));	
			} else {
				$this->Session->setFlash(__('Adding new Variant failed'), 'default', array('class'=>'flash_failure'));	
			}
			$this->redirect($this->referer());	
		}
		
	}
	
	public function admin_edit_variant($productId = false, $variantId = false) {
		
		if(!($variantId) || !($productId)) {
			$this->Session->setFlash(__('Invalid id for Product or Variant'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'admin_index'));
		}
		
		if (!empty($this->request->data)) {
			
			if ($this->Product->Variant->saveAll($this->request->data))	{
				$this->Session->setFlash(__('Variant edited successfully'), 'default', array('class'=>'flash_success'));
				
			} else {
				$this->Session->setFlash(__('Update Variant failed'), 'default', array('class'=>'flash_failure'));	
			}
			
			$this->redirect($this->referer());	
		}
		
	}
	
	public function admin_delete_variant($productId = false, $variantId = false) {
		if(!($variantId) || !($productId)) {
			$this->Session->setFlash(__('Invalid id for Product or Variant'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'admin_index'));
		}
			
		if ($this->Product->Variant->delete($variantId))	{
			$this->Session->setFlash(__('Variant deleted successfully'), 'default', array('class'=>'flash_success'));
			
		} else {
			$this->Session->setFlash(__('Deleting Variant failed'), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect($this->referer());	
		
		
	}
  
    
}
?>
