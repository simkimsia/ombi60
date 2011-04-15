<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
App::import('Core', 'HttpSocket');

class ProductsController extends AppController {

	var $name = 'Products';

	var $helpers = array('Javascript', 'Ajax',
			     'TinyMce.TinyMce', 'Text');
	
	var $components = array(
				'Paypal.Paypal',
				'Filter.Filter'  => array(
					'actions' => array('admin_index'),
					'defaults' => array(),
					'fieldFormatting' => array(
						'string'	=> "LIKE '%%%s%%'",
						'text'		=> "LIKE '%%%s%%'",
						'datetime'	=> "LIKE '%%%s%%'"
					),
					'formOptionsDatetime' => array(),
					'paginatorParams' => array(
						'page',
						'sort',
						'direction',
						'limit'
					),
					'parsed' => false,
					'redirect' => true,
					'useTime' => false,
					'separator' => '/',
					'rangeSeparator' => '-',
					'url' => array(),
					'whitelist' => array(),
					'useSession'=>true,
					'complicatedRelation' => array(),
					),
				'Theme' => array('actions'=>array('view_cart',
								  'view',
								  'index',
								  'view_by_group')),
				
				
				);
	
	var $view = 'TwigView.TwigTheme';

	function beforeFilter() {
		
		
		// for uploadify to work, we must ensure that debug set to zero in admin_add and admin_edit
		

		// this is to allow admin_upload to work with Session component
		if ($this->action=='admin_upload') {
			
                        $this->Session->id($this->params['url']['sess']);
			$this->Session->start();
			
		}
		
		// this is to override the cookie user id for products checkout for
		// crossing custom domains
		if(($this->action == 'checkout') AND (!empty($this->params['url']['ss']))) {
			
			$uuid = $this->params['url']['ss'];
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
				   'delete_from_cart', 'edit_quantities_in_cart',
				   'checkout', 'view_by_group');

		
		if ($this->action == 'view_cart' OR
		    $this->action == 'view' OR
		    $this->action == 'index'){
			
			// set the class for the overallcontainer
			$this->set('classForContainer', $this->configureContainerClass($this->name, $this->action));
		}
		
		// this is to allow the jquery to change the elements that control the file upload.
		$image = $this->Product->ProductImage;

		$this->Security->disabledFields[] = $image->name . '.' . $image->defaultNameForImage;
		
		
		$this->checkoutLink = Router::url('/', true);
		
		if (($this->action == 'admin_index')
		    OR ($this->action == 'admin_add')
		    OR ($this->action == 'checkout')
		    ) {
			$this->Security->validatePost = false;
		}
		
		
		

	}
	
	function checkout() {
		// flag for paypal express checkout
		$paypal = false;
		$uuid = '';
		
		$userId = User::get('User.id');
		
		$cart = $this->Product->CartItem->Cart->getLiveCartByCustomerId($userId, true);
		$postFields = array();
		
		if ($this->RequestHandler->isPost()) {
			$shopId = Shop::get('Shop.id');
			$count = $this->data['Product']['products_count'];
			
			if ($count > 0) {
				
				
				$postFields['cart'] = $cart;
				
				$postFields['shopId'] = $shopId;
				$postFields['userId'] = $userId;
				$postFields['cancelURL'] = Router::url(array('controller'=>'products', 'action'=>'view_cart'), true);
				
				if(isset($this->params['form']['checkoutBtn'])) {
					// user clicked the submit button named proceedToCheckout... so we'll do that
					$postFields['paypal'] = 0;
				} else if (isset($this->params['form']['checkout'])) {
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
			$this->Session->setFlash(__('You need to have products in your cart', true), 'default', array('class'=>'flash_failure'));
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
		
		App::import('Core', 'String');
		$data = array();
		$data['SiteTransfer']['sess_id'] = $this->Session->id();
		
		$siteTransfer = ClassRegistry::init('SiteTransfer');
		$siteTransfer->id = String::uuid();
		if ($siteTransfer->save($data)) {
			return $siteTransfer->id;
		}
		
	}
	
	function view_cart() {
		
		$products = array();
		$shop_id  = Shop::get('Shop.id');
		
		// check if shop wants to have paypal option
		$paypalExpressOn = $this->Product->Shop->getPaypalExpressOn($shop_id);
		
		// retrieve live cart of customer
		$productsInCart = $this->Product->CartItem->Cart->getLiveCartByCustomerId(User::get('User.id'), true, true);
		
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
		$items = $this->Product->CartItem->prepareCartItemInView($products);
		
		$this->set(compact('items', 'paypalExpressOn', 'paymentAmount', 'cart_id'));
		
		$sessionString = '';
		$mainUrl = Shop::get('Shop.primary_domain');
		
		$this->log('user id in view_cart ' . User::get('User.id'));
		
		// now we are going to pass the session into the database for the crossover for checkout
		
		if (!$this->Product->Shop->isCurrentBaseThisDomain($mainUrl)) {
			// test if we need to send User id over
			$this->Session->write('User.id', User::get('User.id'));
			$this->log('new user id in session write ' . $this->Session->read('User.id'));
			$sessionString = '?ss='.$this->transferSession();
		}
		
		$this->set('sessionString', $sessionString);
		
		$this->render('cart');
	}

	function admin_index() {
			
		$this->paginate = array(
			      'conditions' => array('OR' =>
							array (
								array('ProductImage.cover'=>true),
								array('ProductImage.cover'=>null),
							),
						    ),
			      'link'=>array('ProductImage'),
			      'fields'=>array('Product.*', 'ProductImage.id', 'ProductImage.filename', 'ProductImage.dir'),
			      );

		
		$this->paginate['conditions']['AND'] = array_merge($this->Filter->paginate['conditions'], array('Product.shop_id' => User::get('Merchant.shop_id')));

		$this->set('products', $this->paginate());

	}
	

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function view($handle = false) {
		
		if (!$handle) {
			$this->Session->setFlash(__('Invalid product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');
		
		// get the product details
		$productFound = $this->Product->find('first', array('conditions'=>array('handle'=>$handle,
									'shop_id'=>$shop_id)));

		
		// must be valid shop
		$invalidShop = !($shop_id > 0);
		// product must exist
		$noSuchProduct = ($invalidShop) ? true : empty($productFound['Product']);
		// product must belong to said shop
		$productDoesNotBelongToShop = ($noSuchProduct) ? true : $productFound['Product']['shop_id'] != $shop_id;
		// must be active product
		$productNotActive = ($productDoesNotBelongToShop) ? true : !($productFound['Product']['status']);

		if (   $invalidShop
		    OR $noSuchProduct
		    OR $productDoesNotBelongToShop
		    OR $productNotActive
		) {
			$this->Session->setFlash(__('No such product for this shop', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}

		// since valid shop AND active product, we go get images of product.
		// get ALL the images belonging to this product with the cover image as first image.
		$images = $this->Product->ProductImage->find('all',
							     array('conditions' => array('ProductImage.product_id'=>$id),
								   'fields' => array('ProductImage.filename'),
								   'order' => 'ProductImage.cover DESC'));
		
		// attach the images to the product array under the key ProductImages. Note the 's'
		$productFound['Product']['images'] = Set::extract('{n}.ProductImage.filename', $images);
		
		$this->set('product', $productFound['Product']);
		
		$this->set('productsInCart', $this->Session->read('Shop.' . $shop_id . '.cart'));
		
	}
	
	function view_by_group($handle = false) {
		
		// check for handle
		if (!$handle) {
			$this->Session->setFlash(__('Invalid product group', true), 'default', array('class'=>'flash_failure'));
			$this->redirect('/');
		}
		
		// check for any sorting or ordering parameters
		$sort = isset($this->params['named']['sort']) ? $this->params['named']['sort'] : 'created';
		
		$order = isset($this->params['named']['direction']) ? $this->params['named']['direction'] : 'desc';
		
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');
		
		// get the product details
		$groupFound = $this->Product->ProductsInGroup->ProductGroup->find('first', array('conditions'=>array('ProductGroup.handle'=>$handle,
													'ProductGroup.shop_id'=>$shop_id)));


		// must be valid shop
		$invalidShop = !($shop_id > 0);
		// product must exist
		$noSuchProductGroup = ($invalidShop) ? true : empty($groupFound['ProductGroup']);
		// product must belong to said shop
		$groupDoesNotBelongToShop = ($noSuchProductGroup) ? true : $groupFound['ProductGroup']['shop_id'] != $shop_id;
		// must be active product
		$groupNotActive = ($groupDoesNotBelongToShop) ? true : !($groupFound['ProductGroup']['status']);



		if (   $invalidShop
		    OR $noSuchProductGroup
		    OR $groupDoesNotBelongToShop
		    OR $groupNotActive
		) {
			$this->Session->setFlash(__('No such product group for this shop', true), 'default', array('class'=>'flash_failure'));
			$this->redirect('/');
		}

		// to do the pagination across 3 models
		// we need to ensure that the parent model has at least a recursive of Zero
		$this->Product->recursive = 0;

		// add in the ProductImage conditions
		$this->paginate['conditions']['OR'] = array (
								array('ProductImage.cover'=>true),
								array('ProductImage.cover'=>null),
							);
		
		// add in the Product status = 1 and belongs to a certain group
		$this->paginate['conditions']['AND'] = array('Product.status' => 1,
							     'ProductsInGroup.product_group_id' => $groupFound['ProductGroup']['id']);
		
		
		// add in the link param into paginate
		$this->paginate['link']  = array('ProductImage', 'ProductsInGroup');
		
		// add in the order param into paginate
		// for some weird reason cakephp auto overrides this order when user
		// selects the order based on the named params
		// so basically this is the default order we are setting
		$this->paginate['order'] = array('Product.created DESC');
		
		// paginate using the parent model Product
		$products = $this->paginate('Product');
		
		/* here is the ugly code to remove unnecessary fields and to remove the layer involving Product and ProductImage */
		$images = Set::combine($products, '{n}.ProductImage.product_id', '{n}.ProductImage.filename');
		
		$products = Set::extract('{n}.Product', $products);
		
		foreach($products as $key=>$product) {
			
			foreach($images as $product_id => $image) {
				if ($product['id'] == $product_id) {
					$products[$key]['image'] = $image;
					unset($images[$product_id]);
					break;
				}
			}
		}
		
		/* end of ugly code */
		
		
		$domainPagePath = Router::url('/products/index/', true);

		$this->set(compact('sort', 'order', 'products', 'domainPagePath'));
		
		
		$this->render('collection');
		
	}


	function admin_add() {

		$this->set('title_for_layout', 'Add Product');
		
		// for handling ajax request.
		// usually because of the need to upload images using uploadify hence
		// we need ajax to first create the Saved Theme in order to have a proper folder
		// for uploadify to upload the pics to
		if ($this->params['isAjax']) {
			
			$this->layout = 'json';
			$successJSON = false;
			$contents = array();
		
			$this->Product->create();
			if ($this->Product->createProductDetails($this->data)) {
				$this->Session->setFlash(__('Product has been saved', true), 'default', array('class'=>'flash_success'));
				$successJSON = true;
				$contents = array('id' => $this->Product->id);
				
			} else {
				$this->Session->setFlash(__('Product could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
				$contents = array('reason' => $this->Product->validationErrors);
				
			}
			$this->set(compact('contents', 'successJSON'));
			$this->render('json/response');
			
		// this handles all the normal form submission
		// When there is NO images, just a normal POST will create the Product
		// When there ARE images, this will be activated at the very last step to redirect back to the index page
		} else if ($this->RequestHandler->isPost()) {

			$uploadifyUsed = ($this->data['Product']['alt_id'] > 0);
					
			if ($uploadifyUsed) {
				// this is to trigger the afterSave to make first image as cover.
				// regardless save is successful, it is already there.
				$this->Product->id = $this->data['Product']['alt_id'];
				$this->Product->save($this->data);
				$this->Session->setFlash(__('Product has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Product->create();
				if ($this->Product->createProductDetails($this->data)) {
				    $id = $this->Product->getLastInsertId();
				                 
                    $this->save_image($id); //This will save product images

					$this->Session->setFlash(__('Product has been saved', true), 'default', array('class'=>'flash_success'));
					$this->redirect(array('action' => 'index'));
				
				} else {
					$this->Session->setFlash(__('Product could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
				}
			}
			
		}
		
		$uploadifySettings = array('browseButtonId' => 'fileInput',
					   'script' => Router::url('/admin/products/upload', true),
					   'onAllComplete' => true,
					   'buttonText' => __('Choose File', true),
					   );
		
		$errors = $this->Product->getAllValidationErrors();
		
		$this->set(compact('errors', 'uploadifySettings'));
		
	}
	
	/**
	 * should be called by ONLY uploadify plugin
	 **/
	function admin_upload($id = null) {
	
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
	
	function admin_toggle($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->Product->toggle_status($id)) {
			$this->Session->setFlash(__('Product status changed', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The status of Product could not be changed. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_edit($id = null) {

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
			    $this->save_image($id, TRUE); //This will save product images
				$this->Session->setFlash(__('The Product has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}


		// the images list related code
		// to make paging easier to test, we set as 1 per page.
		$this->paginate = array('conditions'=>array('ProductImage.product_id'=>$id),
					'order' => 'ProductImage.cover desc',
					'limit'=>'10');

		$product_id = $id;
		
		
		$productImages = $this->paginate('ProductImage');
		
		$errors = array();
		
		$count = count($productImages);
		
		// for uploadify
		$uploadifySettings = array('browseButtonId' => 'fileInput',
					   'script' => Router::url("/admin/products/upload/".$product_id, true),
					   'auto' => true,
                                           'buttonText' => __('Choose File', true),
					   'onComplete' => true,);
		
		$this->set(compact('product_id', 'productImages', 'errors', 'uploadifySettings'));

		if ($this->RequestHandler->isAjax() == false) {
			// standard view to render
			$this->render('admin_edit');
		} else {
			// must be Ajax request so we only fetch the form and nothing else.
			$this->render('admin_edit_form_only');
		}
	
	}
	
	
	/**
	 * This private action is used to save product images
	 * 
	 * @param integer $product_id Product Id
	 * 
	 * @return void
	 */
	private function save_image($product_id, $edit = FALSE)
	{
	    if (!empty($_FILES)) {
            $tmp = array();
            
            foreach ($_FILES['product_images'] as $key => $valueArray) {
                $i=0;
                foreach ($valueArray as $value) {
                    //Only consider first 4 photos
                    if ($i < 4) {
                        $tmp[$i][$key] = $value;
                        $i++;
                    }
                }
            }
            
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico');
            $i = 0;
            foreach ($tmp as $tempFile) {
                $name = $tempFile['name'];
                $str = strtolower(substr(strrchr($tempFile['name'], '.'), 1));
                
                if (in_array($str, $allowedExtensions)) {
                    $this->Product->ProductImage->create();
                    $data = array('ProductImage'=>array('filename'=>$tempFile,
                						                'product_id' => $product_id,));

                    $result = $this->Product->ProductImage->uploadifySave($data);   

                    if ($result != false && $i++ == 0 && !$edit) {
                        $this->Product->ProductImage->make_this_cover($this->Product->ProductImage->id, $product_id);
                    }    
                }
            }
        }
	}//end save_image()
	
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be deleted. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

	function admin_duplicate($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->duplicate($id)) {
			$this->Session->setFlash(__('Product duplicated', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be duplicated. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

	function platform_index() {

		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());

	}

	function platform_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function platform_add() {
		if ($this->RequestHandler->isPost()) {
			$this->Product->set($this->data);

			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		$this->set('errors', $this->Product->invalidFields());
	}

	function platform_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
	}

	function platform_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Product deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Product could not be deleted. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	
	function edit_quantities_in_cart() {
		if (!empty($this->data)) {
			// for verifying purposes
			$cartId = $this->data['Cart']['id'];
			$userId = User::get('User.id');
			$validCartItems = $this->Product->CartItem->find('all', array('conditions'=>array('Cart.past_checkout_point'=>false,
												 'Cart.user_id'=>$userId,
												 'Cart.id'=>$cartId),
							  'fields'=>array('CartItem.id')
						 ));
			
			// because $validCartItems is not in a good format to test for value
			$cartItemIdArray = Set::extract('{n}.CartItem.id', $validCartItems);
			$cartItemIdArrayFromData = Set::extract('CartItem.{n}.id', $this->data);
			
			$intersect = array_intersect($cartItemIdArray, $cartItemIdArrayFromData);
			
			foreach($this->data['CartItem'] as $key=>$value) {
				
				if (in_array($key, $intersect)) {
					if (is_numeric($value['product_quantity']) &&  $value['product_quantity'] == 0) {
						$this->deleteFromCart($key, $cartId);
					} else if (is_numeric($value['product_quantity']) &&  $value['product_quantity'] > 0){
						// do nothing
					} else {
						unset($this->data['CartItem'][$key]);
					}
				} else {
					unset($this->data['CartItem'][$key]);
				}
			}
			
			$this->Product->CartItem->refreshCart($this->data);	
		}
		
		$this->redirect(array('action'=>'view_cart'));
	}
	
	function add_to_cart($id = null) {
		if(!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		$qty = 1;
		
		$qtyExists = !empty($this->data['Product']['quantity']);
		$qtyIsPositive = $qtyExists ? is_numeric($this->data['Product']['quantity']) AND ($this->data['Product']['quantity'] > 0) : false;
		if ($qtyIsPositive) {
			$qty = 	$this->data['Product']['quantity'];
		}
		
		
		if($this->addToCart($id, $qty)) {
			$this->Session->setFlash(__('Product added to cart', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'view_cart'));
		}
		$this->Session->setFlash(__('The Product could not be added to cart. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	
	private function addToCart($id = null, $quantity = 1) {
		
		return $this->Product->CartItem->Cart->addProductForCustomer(User::get('User.id'), array($id=>$quantity));
		
	}
	
	function delete_from_cart($id = false, $cart_id = false) {
		
		if(!($id) OR !($cart_id)) {
			$this->Session->setFlash(__('Invalid id for Product', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'view_cart'));
		}
		
		if($this->deleteFromCart($id, $cart_id)) {
			$this->Session->setFlash(__('Product removed from cart', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'view_cart'));
		}
		$this->Session->setFlash(__('The Product could not be removed from cart. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'view_cart'));
	}
	
	private function deleteFromCart($id = false, $cartId = false) {
		if (!($id >0) || !($cartId > 0)) {
			return false;
		}
		
		$userId = User::get('User.id');
		
		$validCartItems = $this->Product->CartItem->find('all', array('conditions'=>array('Cart.past_checkout_point'=>false,
											 'Cart.user_id'=>$userId,
											 'Cart.id'=>$cartId),
						  'fields'=>array('CartItem.id')
					 ));
		
		// because $validCartItems is not in a good format to test for value
		$cartItemIdArray = Set::extract('{n}.CartItem.id', $validCartItems);
		
		if (in_array($id, $cartItemIdArray)) {
			$result = $this->Product->CartItem->delete($id);
			if (count($cartItemIdArray) == 1 && $result) {
				return $this->Product->CartItem->Cart->delete($cartId);
			}
		}
		
		return false;
		
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

}
?>
