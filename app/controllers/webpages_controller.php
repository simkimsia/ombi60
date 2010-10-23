<?php
class WebpagesController extends AppController {

	var $name = 'Webpages';
	
	var $components = array('Theme');
	
	var $view = 'Theme';
	
	var $helpers = array('Session');

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
	}

	

	function view($handle = false) {
		if (!$handle) {
			$this->Session->setFlash(__('Invalid webpage', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		$webpage = $this->Webpage->find('first', array('conditions'=>array('handle'=>$handle,
									'shop_id'=>Shop::get('Shop.id'))));
		
		$this->set(compact('webpage'));
		
		// set class attributes for the pages
		if ($handle == 'shopfront') {
			$this->set('classForContainer', 'homepage');
		}
		
	}

	
	function admin_index() {
		$this->Webpage->recursive = 0;
		
		$this->set('webpages', $this->paginate());
		
		$blogModel = $this->Webpage->Shop->Blog;
		$blogModel->Behaviors->attach('Containable');
		
		$blogs = $blogModel->find('all', array('conditions'=>array('Blog.shop_id'=>Shop::get('Shop.id')),
						       'contain'=>array('Post'=>array('limit'=>3,
										   'order'=>'Post.modified DESC'))));
		
		$this->set(compact('blogs'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webpage', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('webpage', $this->Webpage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			
			$this->Webpage->create();
			if ($this->Webpage->save($this->data)) {
				$this->Session->setFlash(__('The webpage has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webpage could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}


		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));

		$this->set(compact('authors'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid webpage', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Webpage->save($this->data)) {
				$this->Session->setFlash(__('The webpage has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webpage could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Webpage->read(null, $id);
		}

		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		
		$this->set(compact('authors'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webpage', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Webpage->delete($id)) {
			$this->Session->setFlash(__('webpage deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('webpage was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

}
?>