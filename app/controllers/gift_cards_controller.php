<?php
class GiftCardsController extends AppController {

	var $name = 'GiftCards';

	function index() {
		$this->GiftCard->recursive = 0;
		$this->set('giftCards', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('giftCard', $this->GiftCard->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->GiftCard->create();
			if ($this->GiftCard->save($this->data)) {
				$this->Session->setFlash(__('The gift card has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GiftCard->save($this->data)) {
				$this->Session->setFlash(__('The gift card has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GiftCard->read(null, $id);
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GiftCard->delete($id)) {
			$this->Session->setFlash(__('Gift card deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gift card was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->GiftCard->recursive = 0;
		$this->set('giftCards', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('giftCard', $this->GiftCard->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->GiftCard->create();
			if ($this->GiftCard->save($this->data)) {
				$this->Session->setFlash(__('The gift card has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GiftCard->save($this->data)) {
				$this->Session->setFlash(__('The gift card has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GiftCard->read(null, $id);
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gift card', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GiftCard->delete($id)) {
			$this->Session->setFlash(__('Gift card deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gift card was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
}
?>