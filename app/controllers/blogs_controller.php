<?php
class BlogsController extends AppController {

	var $name = 'Blogs';
	
	var $view = 'Theme';
	
	var $components = array('Theme' => array('actions'=>array('view')),);
	
	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

	

	function view($slug = false) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect('/');
		}
		
		$blog = $this->Blog->find('first', array('conditions'=>array('short_name'=>$slug,
									'shop_id'=>Shop::get('Shop.id'))));
		
		$this->set(compact('blog'));
	}


	function admin_index() {
		$this->Blog->recursive = 0;
		$this->paginate = array('conditions'=>array('Blog.shop_id'=>Shop::get('Shop.id')));
		$this->set('blogs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('blog', $this->Blog->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Blog->create();
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash(__('The blog has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
					      'action' => 'view', $this->Blog->id));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash(__('The blog has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Blog->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if ($this->Blog->delete($id)) {
			$this->Session->setFlash(__('Blog deleted', true), 'default', array('class'=>'flash_success'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		$this->Session->setFlash(__('Blog was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
	}
}
?>