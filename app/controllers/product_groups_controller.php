<?php
class ProductGroupsController extends AppController {

	var $name = 'ProductGroups';

	function admin_index() {
		$this->ProductGroup->recursive = 0;
		$this->set('productGroups', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		$shops = $this->ProductGroup->Shop->find('list');
		$this->set(compact('shops'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
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
		$shops = $this->ProductGroup->Shop->find('list');
		$this->set(compact('shops'));
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