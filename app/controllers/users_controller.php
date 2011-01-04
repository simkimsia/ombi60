<?php
class UsersController extends AppController {

	var $name = 'Users';

	var $helpers = array('Html', 'Form', 'Session');

	var $belongsTo = array('Group');

	function beforeFilter() {
		//parent::beforeFilter();

		if ($this->action == 'platform_login') {
			$this->Auth->loginRedirect = '/platform/users';
		}
		
		if ($this->action == 'initDB') {
			$this->Auth->allow('initDB');
		}

	}

	function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		$data = $this->data;

		if (empty($this->data)) {
			$data = $this->read();
		}

		if (!$data['User']['group_id']) {
			return null;
		} else {
			return array('Group' => array('id' => $data['User']['group_id']));
		}
	}

	/**
	 * for the acos_aros table permissions setting
	 * */
	function initDB() {
		$group =& $this->User->Group;
		//Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		//allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->allow($group, 'controllers/Pages/display');
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Products');
		$this->Acl->allow($group, 'controllers/Shops');
		$this->Acl->allow($group, 'controllers/Users');
		$this->Acl->allow($group, 'controllers/Domains');
		$this->Acl->allow($group, 'controllers/Themes');

		//set Permissions for Merchants
		$group->id = 3;
		$this->setMerchantPermissions($group);

		//allow users to only add and edit on posts and widgets
		$group->id = 4;
		$this->setCustomerPermissions($group);
		
		echo "all done";    exit;

	}

	private function setMerchantPermissions($group) {
		$this->Acl->deny($group, 'controllers');
		
		$this->log('=============start to set permissions for merchants=============');
		
		// allow for products
		$this->log('products');
		$this->Acl->allow($group, 'controllers/Pages/display');
		$this->Acl->allow($group, 'controllers/Products/admin_add');
		$this->Acl->allow($group, 'controllers/Products/admin_edit');
		$this->Acl->allow($group, 'controllers/Products/admin_delete');
		$this->Acl->allow($group, 'controllers/Products/admin_view');
		$this->Acl->allow($group, 'controllers/Products/admin_index');
		$this->Acl->allow($group, 'controllers/Products/admin_upload');
		$this->Acl->allow($group, 'controllers/Products/admin_duplicate');
		$this->Acl->allow($group, 'controllers/Products/admin_toggle');
		
		// navigation
		$this->log('navi');
		$this->Acl->allow($group, 'controllers/Links/admin_index');
		$this->Acl->allow($group, 'controllers/Links/admin_add');
		$this->Acl->allow($group, 'controllers/Links/admin_edit');
		$this->Acl->allow($group, 'controllers/Links/admin_delete');


		$this->log('product_images');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_add');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_delete');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_list_by_product');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_make_this_cover');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_add_by_product');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_list_by_product');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_uploadify');

		$this->log('merchants');
		$this->Acl->allow($group, 'controllers/Merchants/admin_index');
		$this->Acl->allow($group, 'controllers/Merchants/admin_edit');
		$this->Acl->allow($group, 'controllers/Merchants/admin_logout');
		$this->Acl->allow($group, 'controllers/Merchants/admin_login');

		$this->log('domains');
		$this->Acl->allow($group, 'controllers/Domains/admin_add');
		$this->Acl->allow($group, 'controllers/Domains/admin_edit');
		$this->Acl->allow($group, 'controllers/Domains/admin_delete');
		$this->Acl->allow($group, 'controllers/Domains/admin_view');
		$this->Acl->allow($group, 'controllers/Domains/admin_index');
		$this->Acl->allow($group, 'controllers/Domains/admin_make_this_primary');
		
		$this->log('savedthemes');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_index');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_edit');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_add');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_delete');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_feature');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_edit_image');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_delete_image');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_edit_css');
		$this->Acl->allow($group, 'controllers/SavedThemes/admin_switch');
		
		$this->log('shops');
		$this->Acl->allow($group, 'controllers/Shops/admin_account');
		$this->Acl->allow($group, 'controllers/Shops/admin_cancelaccount');
		
		$this->log('payments');
		$this->Acl->allow($group, 'controllers/Payments/admin_index');
		$this->Acl->allow($group, 'controllers/Payments/admin_update_settings');
		$this->Acl->allow($group, 'controllers/Payments/admin_add_custom_payment');
		$this->Acl->allow($group, 'controllers/Payments/admin_edit_custom_payment');
		$this->Acl->allow($group, 'controllers/Payments/admin_delete_custom_payment');
		$this->Acl->allow($group, 'controllers/Payments/admin_add_paypal_payment');
		$this->Acl->allow($group, 'controllers/Payments/admin_edit_paypal_payment');		
		
		$this->log('shippingrates');
		$this->Acl->allow($group, 'controllers/ShippingRates/admin_index');
		$this->Acl->allow($group, 'controllers/ShippingRates/admin_add_price_based');
		$this->Acl->allow($group, 'controllers/ShippingRates/admin_add_weight_based');
		$this->Acl->allow($group, 'controllers/ShippingRates/admin_edit');
		$this->Acl->allow($group, 'controllers/ShippingRates/admin_delete');
		
		$this->log('orders');
		$this->Acl->allow($group, 'controllers/Orders/admin_index');
		$this->Acl->allow($group, 'controllers/Orders/admin_view');
		
		$this->log('themes');
		$this->Acl->allow($group, 'controllers/Themes/admin_index');
		
		// for blogs and pages
		$this->log('pages');
		$this->Acl->allow($group, 'controllers/Webpages/admin_add');
		$this->Acl->allow($group, 'controllers/Webpages/admin_edit');
		$this->Acl->allow($group, 'controllers/Webpages/admin_delete');
		$this->Acl->allow($group, 'controllers/Webpages/admin_view');
		$this->Acl->allow($group, 'controllers/Webpages/admin_index');
		
		$this->log('blogs');
		$this->Acl->allow($group, 'controllers/Blogs/admin_add');
		$this->Acl->allow($group, 'controllers/Blogs/admin_edit');
		$this->Acl->allow($group, 'controllers/Blogs/admin_delete');
		$this->Acl->allow($group, 'controllers/Blogs/admin_view');
		$this->Acl->allow($group, 'controllers/Blogs/admin_index');
		
		$this->log('posts');
		$this->Acl->allow($group, 'controllers/Posts/admin_add');
		$this->Acl->allow($group, 'controllers/Posts/admin_edit');
		$this->Acl->allow($group, 'controllers/Posts/admin_delete');
		$this->Acl->allow($group, 'controllers/Posts/admin_view');
		
		$this->log('=============end of setting permissions for merchants=============');
		
	}

	private function setCustomerPermissions($group) {
		$this->Acl->deny($group, 'controllers');
		// allow for products

		$this->Acl->allow($group, 'controllers/Pages/display');
		
	}

	/**
	 * end of initDb for users permissions settings
	 **/
	

	function login() {

	}

	function logout() {

	}

	function platform_login() {

	}

	function platform_logout() {

	}

	function platform_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	

	
	/**
	 *
	 *
	 * After save callback
	 * Update the aro for the user.
	 *
	 * @access public *
	 * @return void
	 * */
	function afterSave($created) {
		if (!$created) {
			$parent = $this->parentNode();
			$parent = $this->node($parent);

			$node = $this->node();

			$aro = $node[0];

			$aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
			$this->Aro->save($aro);
		}
	}

}
?>