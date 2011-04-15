<?php
class ProductGroupsController extends AppController {

	var $name = 'ProductGroups';
	
	var $helpers = array('TinyMce.TinyMce');
	
	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
	}

	function admin_index() {
		$this->ProductGroup->recursive = -1;
		$shopId = Shop::get('Shop.id');
		$customCollections = $this->ProductGroup->find('all', array('conditions'=>array('ProductGroup.status'=>0,
												'ProductGroup.shop_id'=>$shopId)));
		$smartCollections = $this->ProductGroup->find('all', array('conditions'=>array('ProductGroup.status'=>1,
											       'ProductGroup.shop_id'=>$shopId)));
		$this->set(compact('customCollections', 'smartCollections'));
	}

	function admin_view_smart($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	}

	function admin_add_smart() {
		if (!empty($this->data)) {
			// set the type to smart
			$this->data['ProductGroup']['type'] = 1;
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		
	}

	function admin_edit_smart($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// set the type to smart
			$this->data['ProductGroup']['type'] = 1;
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGroup->read(null, $id);
		}
		
	}
	
	function admin_view_custom($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	}
	
	function admin_add_custom() {
		if (!empty($this->data)) {
			// set the type to custom
			$this->data['ProductGroup']['type'] = 0;
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		
	}
	
	function admin_edit_custom($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// set the type to custom
			$this->data['ProductGroup']['type'] = 0;
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGroup->read(null, $id);
		}
		
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductGroup->delete($id)) {
			$this->Session->setFlash(__('Product group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
}
?>