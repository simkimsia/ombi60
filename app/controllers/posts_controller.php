<?php
class PostsController extends AppController {

	var $name = 'Posts';
	
	var $helpers = array('TinyMce.TinyMce', 'Text');
	
	var $view = 'Theme';
	
	var $components = array(
				'Theme' => array(
					'actions'=>array(
						'index',
						'view',)
				));

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow('view', 'index');
	}


	function view($short_name = false, $id = false, $slug = false) {
		if (!$short_name || !$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'post'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Post->Behaviors->attach('Linkable.Linkable');
		
		$post = $this->Post->find('first', array('conditions'=>array(
									'Blog.short_name'=>$short_name,
									'Post.id'=>$id,
									'Blog.shop_id'=>Shop::get('Shop.id')),
							 'link'=>array('Blog', 'User'),
							 'fields'=>array('Post.*',
									 'Blog.name',
									 'Blog.short_name')));
		$this->set(compact('post'));
		
		
	}
	
	function index($short_name = false) {
		
		if (!$short_name) {
			$this->Session->setFlash(__('Invalid blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect('/');
		}
		$this->Post->Blog->recursive = -1;
		$blog = $this->Post->Blog->find('first', array('conditions'=>array('Blog.short_name' => $short_name,
						    				   'Blog.shop_id'=>Shop::get('Shop.id'))));
		
		if (!$blog) {
			$this->Session->setFlash(__('Invalid blog', true), 'default', array('class'=>'flash_failure'));
			$this->redirect('/');
		}
		
		$this->paginate = array('conditions'=>array('Post.blog_id'=>$blog['Blog']['id']),
					'order' => array('Post.created DESC'),
					'fields' => array('Post.id',
							  'Post.blog_id','Post.author_id',
							  'Post.author_id', 'Post.status',
							  'Post.title', 'Post.slug',
							  'Post.body', 'Post.created'));
		
		$posts = $this->paginate();
		
		$this->set(compact('posts', 'blog'));
	}
	
	

	function admin_view($blog_id = false, $id = false) {
		if (!$blog_id || !$id) {
			$this->Session->setFlash(__('Invalid post', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		$post = $this->Post->find('first', array('conditions'=>array('Post.id'=>$id,
									     'Post.blog_id'=>$blog_id)));
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		$this->set(compact('post', 'authors'));

		
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
		$blog_name_info = $this->Post->find('first', array('conditions' => array('Post.blog_id' => $blog_id), 'fields' => array('Blog.name')));
		$blog_name = $blog_name_info['Blog']['name'];
		$this->set(compact('blog_id', 'authors', 'blog_name'));
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
