<?php
class PostsController extends AppController {

	var $name = 'Posts';
	
	var $helpers = array('TinyMce.TinyMce');

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow('view');
	}


	function view($short_name = false, $id = false, $slug = false) {
		
		if (!$short_name || !$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Post->Behaviors->attach('Linkable.Linkable');
		
		$post = $this->Post->find('first', array('conditions'=>array('Blog.short_name'=>$short_name,
									'Post.id'=>$id,
									'Blog.shop_id'=>Shop::get('Shop.id')),
							 'link'=>array('Blog', 'User'),
							 'fields'=>array('Post.*')));
		
		$this->set(compact('post'));
		
		
	}
	
	

	function admin_view($blog_id = false, $id = false) {
		if (!$blog_id || !$id) {
			$this->Session->setFlash(__('Invalid post', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		$post = $this->Post->find('first', array('conditions'=>array('Post.id'=>$id,
									     'Post.blog_id'=>$blog_id)));
		$this->set(compact('post'));
	}

	function admin_add($blog_id = false) {
		
		if (!$blog_id) {
			$this->Session->setFlash(__('Invalid post', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		
		$this->set(compact('blog_id', 'authors'));
	}

	function admin_edit($blog_id = false, $id = false) {
		if ((!$blog_id || !$id) && empty($this->data)) {
			$this->Session->setFlash(__('Invalid post', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Post->find('first', array('conditions'=>array('Post.id'=>$id,
									     'Post.blog_id'=>$blog_id)));
		}
		
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		$this->set(compact('authors', 'blog_id'));
	}

	function admin_delete($blog_id = false, $id = false) {
		if (!$blog_id || !$id) {
			$this->Session->setFlash(__('Invalid id for post', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
		}
		$this->Session->setFlash(__('Post was not deleted', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
	}
}
?>