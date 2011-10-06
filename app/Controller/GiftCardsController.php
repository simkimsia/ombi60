<?php
class GiftCardsController extends AppController {

	public $name = 'GiftCards';

	public function index() {
		$this->GiftCard->recursive = 0;
		$this->set('giftCards', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('giftCard', $this->GiftCard->read(null, $id));
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->GiftCard->create();
			if ($this->GiftCard->save($this->request->data)) {
				$this->Session->setFlash(__('The gift card has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->GiftCard->save($this->request->data)) {
				$this->Session->setFlash(__('The gift card has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->GiftCard->read(null, $id);
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GiftCard->delete($id)) {
			$this->Session->setFlash(__('Gift card deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gift card was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
	public function admin_index() {
		$this->GiftCard->recursive = 0;
		$this->set('giftCards', $this->paginate());
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('giftCard', $this->GiftCard->read(null, $id));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->GiftCard->create();
			if ($this->GiftCard->save($this->request->data)) {
				$this->Session->setFlash(__('The gift card has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->GiftCard->save($this->request->data)) {
				$this->Session->setFlash(__('The gift card has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gift card could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->GiftCard->read(null, $id);
		}
		$shops = $this->GiftCard->Shop->find('list');
		$giftCardTypes = $this->GiftCard->GiftCardType->find('list');
		$gcDesigns = $this->GiftCard->GcDesign->find('list');
		$this->set(compact('shops', 'giftCardTypes', 'gcDesigns'));
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for gift card'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GiftCard->delete($id)) {
			$this->Session->setFlash(__('Gift card deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Gift card was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}
}
?>