<?php
class UsersController extends AppController {

	var $name = 'Users';

	var $helpers = array('Html', 'Form', 'Session');

	var $belongsTo = array('Group');

	function beforeFilter() {
		parent::beforeFilter();

		if ($this->action == 'platform_login') {
			$this->Auth->loginRedirect = '/platform/users';
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

	}

	private function setMerchantPermissions($group) {
		$this->Acl->deny($group, 'controllers');
		// allow for products
		$this->Acl->allow($group, 'controllers/Pages/display');
		$this->Acl->allow($group, 'controllers/Products/admin_add');
		$this->Acl->allow($group, 'controllers/Products/admin_edit');
		$this->Acl->allow($group, 'controllers/Products/admin_delete');
		$this->Acl->allow($group, 'controllers/Products/admin_view');
		$this->Acl->allow($group, 'controllers/Products/admin_index');

		$this->Acl->allow($group, 'controllers/ProductImages/admin_add');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_edit');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_delete');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_view');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_index');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_list_by_product');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_make_this_cover');
		$this->Acl->allow($group, 'controllers/ProductImages/admin_add_by_product');

		$this->Acl->allow($group, 'controllers/Merchants/admin_index');
		$this->Acl->allow($group, 'controllers/Merchants/edit');
		$this->Acl->allow($group, 'controllers/Merchants/logout');
		$this->Acl->allow($group, 'controllers/Merchants/login');

		$this->Acl->allow($group, 'controllers/Domains/admin_add');
		$this->Acl->allow($group, 'controllers/Domains/admin_edit');
		$this->Acl->allow($group, 'controllers/Domains/admin_delete');
		$this->Acl->allow($group, 'controllers/Domains/admin_view');
		$this->Acl->allow($group, 'controllers/Domains/admin_index');

		$this->Acl->allow($group, 'controllers/Shops/edit');
		
		$this->Acl->allow($group, 'controllers/Payments/admin_index');
		$this->Acl->allow($group, 'controllers/Payments/admin_update_settings');
		
		$this->Acl->allow($group, 'controllers/Orders/admin_index');
		$this->Acl->allow($group, 'controllers/Orders/admin_view');
		//$this->Acl->allow($group, 'controllers/Orders/admin_index');
		//$this->Acl->allow($group, 'controllers/Orders/admin_index');
		
		$this->Acl->allow($group, 'controllers/Themes/admin_settings');
	}

	private function setCustomerPermissions($group) {
		$this->Acl->deny($group, 'controllers');
		// allow for products

		$this->Acl->allow($group, 'controllers/Pages/display');
		$this->Acl->allow($group, 'controllers/Users/edit');
		$this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/login');

		$this->Acl->allow($group, 'controllers/Customers/edit');
		$this->Acl->allow($group, 'controllers/Customers/logout');
		$this->Acl->allow($group, 'controllers/Customers/login');
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