<?php
class ShopsController extends AppController {

	var $name = 'Shops';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array('Session');

	

	function admin_edit() {

		if (!empty($this->data)) {
			if ($this->Shop->save($this->data)) {
				$this->Session->setFlash(__('The Shop has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect('/admin');
			} else {
				$this->Session->setFlash(__('The Shop could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}

		$themes = $this->Shop->Theme->find('list');
		$this->set(compact('themes'));

		if (empty($this->data)) {
			$this->data = Shop::getInstance();
			return;
		}

	}

	

}
?>