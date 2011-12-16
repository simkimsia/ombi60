<?php
class WebpagesController extends AppController {

	public $name = 'Webpages';
	
	public $components = array('Permission');
	
	public $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce');

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('view', 'shopfront', 'frontpage');
	
		if ($this->request->action == 'admin_toggle' ||
		    $this->request->action == 'admin_menu_action') {
			$this->Components->disable('Security');
		}
		
	}

	public function view($handle = false) {
		
		if (!$handle) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$webpage = $this->Webpage->getDetails($handle);
		
		if ($webpage == false) {
			throw new NotFoundException();
			//$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$page = Webpage::getTemplateVariable($webpage, false);
		
		$this->set(compact('page'));
		$this->set('page_title', $page['title']); // this is hardcoded for index page
		$this->render('page');
		
	}


	// this is where the / will get routed to
	// this is supposed to use the index.tpl inside pages folder within the theme
	public function frontpage() {
		
		$this->set('page_title', 'Welcome'); // this is hardcoded for index page
		$this->render('index');
	}
	
	public function admin_index() {
		$this->Webpage->recursive = 0;
		
		$shopid = Shop::get('Shop.id');
		$this->paginate = array('conditions'=>array('Webpage.shop_id'=>$shopid));
		$webpages = $this->paginate();
		
		$blogModel = $this->Webpage->Shop->Blog;
		$blogModel->Behaviors->load('Containable');
		
		$blogs = $blogModel->find('all', array('conditions'=>array('Blog.shop_id'=>$shopid),
						       'contain'=>array('Post'=>array('fields'=>array('Post.id', 'Post.blog_id'),
										      'limit'=>3,
										      'order'=>'Post.modified DESC'))));
		
		$this->set(compact('blogs', 'webpages'));
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webpage'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$webpage = $this->Webpage->getDetails($id, HIDDEN_AND_VISIBLE_ENTITY);
		
		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));

		$this->set(compact('authors', 'webpage'));
	}
	
	public function admin_toggle($id = false) {
		
		$result = $this->Webpage->toggle($id, 'visible');
		
		if ($this->request->params['isAjax']) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				$errors = $this->Webpage->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('Webpage status has been changed'), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Webpage status could not be changed. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			
			$this->Webpage->create();
			if ($this->Webpage->save($this->request->data)) {
				$this->Session->setFlash(__('The webpage has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webpage could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}


		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));

		$this->set(compact('authors'));
	}
	
	public function admin_menu_action() {
		$resultArray = $this->Webpage->handleMenuAction($this->request->data);
		if ($resultArray['success']) {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_success'));	
		} else {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_failure'));	
		}
		$this->redirect(array('action' => 'index'));
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid webpage'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Webpage->save($this->request->data)) {
				$this->Session->setFlash(__('The webpage has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webpage could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Webpage->getDetails($id);
		}

		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		
		$this->set(compact('authors'));
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webpage'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Webpage->delete($id)) {
			$this->Session->setFlash(__('Webpage deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Webpage was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

}
?>
