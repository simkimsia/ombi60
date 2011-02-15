<?php
class Merchant extends AppModel {

	var $name = 'Merchant';
	
	

	var $belongsTo = array(
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
	function beforeSave($options = array()) {
		if (empty($this->data['Merchant']['id']) AND empty($this->data['Merchant']['owner'])) {
			$this->data['Merchant']['owner'] = true;
		}
		$this->data['User']['group_id'] = MERCHANTS;
		return true;

	}

	function signupNewAccount($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		
		// now to start the transaction
		
		$datasource = $this->getDataSource();
		
		$datasource->begin($this);

		$result = $this->saveAll($data, array('validate'=>'first',
						      'atomic'=>false));

		if (!$result) {
			$datasource->rollback($this);
			return false;
		}


		// we need to create domain entries
		$domain = $this->Shop->Domain;

		$domainData = array();

		$domainData['Domain']['domain']  = $data['Shop']['web_address'];
		$domainData['Domain']['primary'] = true;
		$domainData['Domain']['shop_id'] = $this->Shop->id;
		$domainData['Domain']['shop_web_address'] = true;
		$domain->create();
		$result = $domain->save($domainData);
		
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
				$shippedData['WeightBasedRate']['min_weight'] = 10;
				$shippedData['WeightBasedRate']['max_weight'] = 20;
				$shippedData['ShippingRate']['price'] = 10;
				$shippedData['ShippingRate']['shipped_to_country_id'] = $shippedToCountry->id;
				$shippedData['ShippingRate']['name'] = 'Standard Shipping';
				
				$shippedToCountry->ShippingRate->create();
				$shippedToCountry->ShippingRate->saveAll($shippedData, array('atomic'=>false));
				
				// heavy duty
				$shippedData = array();
				$shippedData['WeightBasedRate']['min_weight'] = 20;
				$shippedData['WeightBasedRate']['max_weight'] = 50;
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
		
		$blogData = array('Blog'=>array('name'=>$data['Shop']['name'],
						'shop_id'=>$this->Shop->id));
		
		$blog->create();
		$result = $blog->save($blogData);
		
		if (!$result) {
			$datasource->rollback($this);
			return false;
		}
		
		// store the new blog data into variable called $shopBlog
		$shopBlog = $result;
		
		// now we set up the first post announcing open for business!
		$post = ClassRegistry::init('Post');
		
		$postData = array('Post'=>array('title'=>'Open for business!',
						'body'=>'We are OPEN for business!!',
						'author_id'=>$this->User->id,
						'blog_id'=>$blog->id));
		
		$post->create();
		$result = $post->save($postData);
		
		if (!$result) {
			$datasource->rollback($this);
			return false;
		}
		
		// now we set up the shopfront page and other pages
		$webpage = ClassRegistry::init('Webpage');
		
		$homePage = array('title'=>'Welcome',
				  'text'=>'<div class="item">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Lorem ipsum dolor sit amet, consectetur 
					adipiscing elit. <a href="#">Sed semper est sed</a> eros sodales 
					in lacinia dolor egestas. Integer seper imperdiet enim eu 
					convallis. Suspendisse nec orci tellus. Aenean consectetur 
					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a 
					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna 
					quam. Etiam ac risus magna, nec pretium diam. <a href="#">
					Phasellus euismod</a> 
					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi 
					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. 
					Praesent aliquet sem sit amet massa scelerisque vitae semper 
					purus varius. Pellentesque habitant morbi tristique senectus et 
					netus et malesuada fames ac turpis egestas.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Jellyfish.jpg" alt="Picture 1" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>
<div class="itemAlt">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Proin mauris tortor, ultricies 
					interdum posuere eu, placerat vitae orci. Duis non laoreet 
					libero. Suspendisse aliquam congue metus non elementum. Cras 
					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci 
					tortor. Suspendisse potenti. Nulla luctus interdum massa in 
					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel 
					orci. <a href="#">Nullam sollicitudin</a> nibh ac dolor tempor 
					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class 
					aptent taciti sociosqu ad litora torquent per conubia nostra, 
					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing 
					ultrices. Nunc eros lectus, bibendum eu consequat id, 
					<a href="#">cursus non quam</a>. Nam vel dolor dolor. 
					Pellentesque ante tortor, mattis auctor condimentum ut, 
					convallis a dui. Mauris scelerisque dapibus libero, vitae 
					facilisis tellus mattis a. Pellentesque metus nulla, tristique 
					at venenatis et, egestas a diam.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Koala.jpg" alt="Picture 2" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>
<div class="item">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Nulla auctor sapien lorem. Ut vitae 
					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam 
					eu magna tempus eleifend. Donec interdum interdum lacus eget 
					iaculis. Nulla facilisi. Phasellus <a href="#">eget lacus auctor</a> 
					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt 
					pellentesque, orci lorem vestibulum elit, ac tristique justo 
					magna at ante. <a href="#">Lorem ipsum</a> dolor sit amet, 
					consectetur adipiscing elit. Curabitur rutrum interdum tempus. 
					Nunc et sapien eros, et ultrices elit. <a href="#">Maecenas in 
					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut 
					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui 
					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus 
					fringilla sit amet. Vivamus faucibus nisl a enim lacinia 
					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae 
					orci ut nibh tristique laoreet.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Hydrangeas.jpg" alt="Picture 3" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>',
						'shop_id'=>$this->Shop->id,
						'author'=>$this->User->id,
						'handle'=>'shopfront');
		
		$aboutUsPage = array('title'=>'About Us',
				     'text'=>'<p>The <strong>About Us</strong> page is important.</p>
				     <p>Customers visit About Us page when they are new to your online shop. They want to establish a level of trust in your business.  Since trust is crucial when selling online, it’s a good idea to provide a fair amount of information about yourself and your business.  Here are a few things you should touch on:</p>
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
				     'text'=>'<p>The <strong>Terms of Service</strong> page is for you to enter any privacy statements or terms of service you wish to render.</p>
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
		
		
		$pageData = array('Webpage'=>array($homePage, $aboutUsPage, $tosPage));
		
		$webpage->create();
		$result = $webpage->saveAll($pageData['Webpage']);
		
		if (!$result) {
			$datasource->rollback($this);
			return false;
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
				      'order'	=> '1'),
				array('name'	=> 'Catalogue',
				      'route'	=> '/products/',
				      'model'	=> '/products/',
				      'order'	=> '2'),
				array('name'	=> 'Blog',
				      'route'	=> '/blogs/' . $shopBlog['Blog']['short_name'],
				      'model'	=> '/blogs/',
				      'action'	=> $shopBlog['Blog']['short_name'],
				      'order'	=> '3'),
				array('name'	=> 'Cart',
				      'route'	=> '/cart/view',
				      'model'	=> '/cart/view',
				      'order'	=> '4')
				));
		
		$result = $this->Shop->LinkList->saveAll($linkListData);
		
		if (!$result) {
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
				      'order'	=> '0'),
				array('name'	=> 'About Us',
				      'route'	=> '/pages/about-us',
				      'model'	=> '/pages/',
				      'action'	=> 'about-us',
				      'order'	=> '1'),
				
				));
		
		$result = $this->Shop->LinkList->saveAll($linkListData);
		
		if (!$result) {
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
		
		
		
		if (!$result) {
			$datasource->rollback($this);
			
			$folder = new Folder();
			$folder->delete(ROOT . DS . 'app' . DS . 'views' . DS . 'themed' . DS . $this->Shop->id . '_cover');
		
			
			return false;
		} else {
			$datasource->commit($this);
		}
		
		
		// since copyable does not allow non-atomic transaction so we put this outside the transaction.
		// now we create the dummy default product for this shop.
		$result = $this->Shop->Product->duplicate(DEFAULT_PRODUCT_ID, $this->Shop->id);
		
		
		if ($invoice->id > 0) {
			// now we need to generate a unique reference number for the created invoice
			$invoiceData = $invoice->updateReference($invoice->id, $invoiceData);
			
			return $invoiceData;	
		}
		
		return false;		

	}
	
	
	

	function updateProfile($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	function retrieveShopUserLanguageByUserId($id = false) {
		if (!$id) {
			return false;
		}
		
		$this->Behaviors->attach('Linkable.Linkable');
		$this->User->Behaviors->attach('Linkable.Linkable');
		
		return $this->find('first', array('conditions'=>array('Merchant.user_id'=>$id),
					   'link'=>array('Shop', 'User'=>array('Language'))));
	}

}
?>
