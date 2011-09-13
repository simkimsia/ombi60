<?php
class PostsController extends AppController {

	var $name = 'Posts';
	
	var $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce',
			     'Text');
	
	var $view = 'TwigView.Twig';
	
	var $components = array(
				'Theme' => array(
					'actions'=>array(
						'index',
						'view',)
				),
				'TimeZone.TimeZone',);

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow('view', 'index');
		if ($this->request->action == 'admin_toggle') {
			$this->Security->enabled = false;
		}
	}


	function view($short_name = false, $id = false, $slug = false) {
		if (!$short_name || !$id) {
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$this->Post->Behaviors->attach('Linkable.Linkable');
		
		$post = $this->Post->find('first', array('conditions'=>array(
									'Blog.short_name'=>$short_name,
									'Post.id'=>$id,
									'Blog.shop_id'=>Shop::get('Shop.id')),
							 'link'=>array('Blog', 'User'),
							 'fields'=>array('Post.*',
									 'Blog.title',
									 'Blog.short_name')));
		
		
		
		if ($post == false) {
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$blog = Blog::getTemplateVariable($post['Blog'], false);
		$article = Post::getTemplateVariable($post, false);
		
		$timezone  = Shop::get('ShopSetting.timezone');
		
		// convert string datetime to datetime object
		$article = $this->TimeZone->convert($article, new DateTimeZone($timezone));
		
		$this->set(compact('article', 'blog'));
		$this->set('page_title', $article['title']); // this is hardcoded for index page
		$this->render('article');
		
	}
	
	function index($short_name = false) {
		
		if (!$short_name) {
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		$this->Post->Blog->recursive = -1;
		$blog = $this->Post->Blog->find('first', array('conditions'=>array('Blog.short_name' => $short_name,
						    				   'Blog.shop_id'=>Shop::get('Shop.id'))));
		
		if (!$blog) {
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$this->paginate = array('conditions'=>array('Post.blog_id'=>$blog['Blog']['id'],
							    'Post.visible'=>true),
					'order' => array('Post.created DESC'),
					'fields' => array('Post.id',
							  'Post.blog_id'));
		
		$posts = $this->paginate();
		
		$all_post_ids = Set::extract('{n}.Post.id', $posts);
		
		$blog['Post'] = $this->Post->find('all', array('conditions'=>array('Post.id'=>$all_post_ids)));
		
		if (empty($blog['Post'] )) {
			$blog['Post'] = array();
		}
		
		$blog = Blog::getTemplateVariable($blog, false);
		
		$this->set(compact('blog'));
		
		$this->set('page_title', $blog['title']); // this is hardcoded for index page
		$this->render('blog');
	}
	
	

	function admin_view($blog_id = false, $id = false) {
		if (!$blog_id || !$id) {
			$this->Session->setFlash(__('Invalid post'), 'default', array('class'=>'flash_failure'));
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
			$this->Session->setFlash(__('Invalid post'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		if (!empty($this->request->data)) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		$blog_name_info = $this->Post->find('first', array('conditions' => array('Post.blog_id' => $blog_id), 'fields' => array('Blog.title')));
		$blog_name = $blog_name_info['Blog']['title'];
		$this->set(compact('blog_id', 'authors', 'blog_name'));
	}

	function admin_edit($blog_id = false, $id = false) {
		if ((!$blog_id || !$id) && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid post'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		if (!empty($this->request->data)) {
			if ($this->Post->save($this->request->data)) {
				
				$this->Session->setFlash(__('The post has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		
		if (empty($this->request->data)) {
			$this->request->data = $this->Post->find('first', array('conditions'=>array('Post.id'=>$id,
									     'Post.blog_id'=>$blog_id)));
		}
		
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		$this->set(compact('authors', 'blog_id'));
	}

	function admin_delete($blog_id = false, $id = false) {
		if (!$blog_id || !$id) {
			$this->Session->setFlash(__('Invalid id for post'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
		}
		$this->Session->setFlash(__('Post was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('controller'=>'blogs',
						      'action' => 'view',
						      $blog_id));
	}
	
	function admin_toggle($id = false) {
		
		$result = $this->Post->toggle($id, 'visible');
		
		if ($result) {
			$this->Post->updatePublishedAt($id);
		}
		
		if ($this->request->params['isAjax']) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../json/empty');
			} else {
				$errors = $this->Post->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('Post status has been changed'), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Post status could not be changed. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			// the view is wrong without blog_id
			$this->redirect(array('action' => 'view'));
		}
	}
	
}
?>
