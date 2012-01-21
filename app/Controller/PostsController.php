<?php
class PostsController extends AppController {

	public $name = 'Posts';
	
	public $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce',
			     'Text');
	
	public $view = 'TwigView.Twig';
	
	public $components = array(
				'Theme' => array(
					'actions'=>array(
						'index',
						'view'
					)
				),
				'Permission' => array(
					'redirect' => array(
						'controller'=>'webpages',
						'action'    => 'index',
						'admin'     => true,
					),
					'actionsWithForeignKey' => array(
						'admin_add_to_blog'
					)
				),
				'TimeZone.TimeZone'
	);

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow('view', 'index');
		if ($this->request->action == 'admin_toggle') {
			$this->Components->disable('Security');
		}
	}


	public function view($short_name = false, $id = false, $slug = false) {
		if (!$short_name || !$id) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$this->Post->Behaviors->load('Linkable.Linkable');
		
		$post = $this->Post->find('first', array('conditions'=>array(
									'Blog.short_name'=>$short_name,
									'Post.id'=>$id,
									'Blog.shop_id'=>Shop::get('Shop.id')),
							 'link'=>array('Blog', 'User'),
							 'fields'=>array('Post.*',
									 'Blog.title',
									 'Blog.short_name')));
		
		
		
		if ($post == false) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
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
	
	public function index($short_name = false) {
		
		if (!$short_name) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		$this->Post->Blog->recursive = -1;
		$blog = $this->Post->Blog->find('first', array('conditions'=>array('Blog.short_name' => $short_name,
						    				   'Blog.shop_id'=>Shop::get('Shop.id'))));
		
		if (!$blog) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
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
	
	

	public function admin_view($blog_id = false, $id = false) {
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

	public function admin_add_to_blog($blog_id = false) {
		
		if (!$blog_id) {
			$this->Session->setFlash(__('Invalid post'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		
		$this->admin_create_new($blog_id);
		
	}
	
	public function admin_add() {
		
		$this->admin_create_new();
		
	}
	
	/*
	*
	* private function that is responsible for controller code for creating new article
	* we use this as there is overlap between the actions admin_add and admin_add_to_blog
	*/
	private function admin_create_new($blog_id = null) {
		if (isset($blog_id)) {
			$cancelLink = array('controller'=>'blogs','action' => 'view', $blog_id);
		} else {
			$cancelLink = array('controller'=>'webpages','action' => 'index');
		}
		$this->set('cancelLink', $cancelLink);
		
		// get all blogs of this shop
		$shop_id = Shop::get('Shop.id'); 
		$blogs = $this->Post->Blog->find('list', array(
			'conditions' => array(
				'Blog.shop_id' => $shop_id
			),
			'order' => array(
				'Blog.title'
			)
		));
		
		$authors = $this->Post->Blog->Shop->getAllMerchantUsersInList($shop_id);

		$this->set(compact('blogs', 'authors'));

		if ($this->request->is('get')) {
			
			// set selected value for dropdown
			if (isset($blog_id)) {
				$this->request->data['Post']['blog_id'] = $blog_id;
			}
		}
		
		else if (!empty($this->request->data)) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'), 'default', array('class'=>'flash_success'));
				$blog_id = $this->request->data['Post']['blog_id'];
				
				$this->redirect(array(
					'controller'=>'blogs',
					'action' => 'view',
					$blog_id
				));
				
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}

		$this->render('admin_add');
		
	}

	public function admin_edit($blog_id = false, $id = false) {
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

	public function admin_delete($blog_id = false, $id = false) {
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
	
	public function admin_toggle($id = false) {
		
		$result = $this->Post->toggle($id, 'visible');
		
		if ($result) {
			$this->Post->updatePublishedAt($id);
		}
		
		if ($this->request->is('ajax')) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				$errors = $this->Post->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
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
