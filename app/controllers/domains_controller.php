<?php
class DomainsController extends AppController {

	var $name = 'Domains';

	function admin_index() {
		$this->Domain->recursive = 0;
		$this->set('domains', $this->paginate('Domain', array(
								      'Domain.shop_id ' => User::get('Merchant.shop_id')) ));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('domain', $this->Domain->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Domain->create();
			if ($this->Domain->save($this->data)) {
				$this->Session->setFlash(__('The domain has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		$shops = $this->Domain->Shop->find('list');
		$this->set(compact('shops'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Domain->save($this->data)) {
				$this->Session->setFlash(__('The domain has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Domain->read(null, $id);
		}
		$shops = $this->Domain->Shop->find('list');
		$this->set(compact('shops'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Domain->delete($id)) {
			$this->Session->setFlash(__('Domain deleted', true), 'default', array('class'=>'flash_success'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Domain was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>