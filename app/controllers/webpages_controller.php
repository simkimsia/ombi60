<?php
class WebpagesController extends AppController {

	var $name = 'Webpages';
	
	var $components = array('Permission');
	
	var $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce');

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('view', 'shopfront', 'frontpage');
	
		if ($this->request->action == 'admin_toggle' ||
		    $this->request->action == 'admin_menu_action') {
			$this->Security->enabled = false;
		}
		
	}

	function view($handle = false) {
		
		if (!$handle) {
			
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$webpage = $this->Webpage->getDetails($handle);
		
		if ($webpage == false) {
			$this->cakeError('error404',array(array('url'=>'/', 'viewVars' =>$this->viewVars)));
		}
		
		$page = Webpage::getTemplateVariable($webpage, false);
		
		$this->set(compact('page'));
		$this->set('page_title', $page['title']); // this is hardcoded for index page
		$this->render('page');
		
	}


	// this is where the / will get routed to
	// this is supposed to use the index.tpl inside pages folder within the theme
	function frontpage() {
		
		$this->set('page_title', 'Welcome'); // this is hardcoded for index page
		$this->render('index');
	}
	
	function admin_index() {
		$this->Webpage->recursive = 0;
		
		$shopid = Shop::get('Shop.id');
		$this->paginate = array('conditions'=>array('Webpage.shop_id'=>$shopid));
		$webpages = $this->paginate();
		
		$blogModel = $this->Webpage->Shop->Blog;
		$blogModel->Behaviors->attach('Containable');
		
		$blogs = $blogModel->find('all', array('conditions'=>array('Blog.shop_id'=>$shopid),
						       'contain'=>array('Post'=>array('fields'=>array('Post.id', 'Post.blog_id'),
										      'limit'=>3,
										      'order'=>'Post.modified DESC'))));
		
		$this->set(compact('blogs', 'webpages'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webpage'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$webpage = $this->Webpage->getDetails($id, HIDDEN_AND_VISIBLE_ENTITY);
		
		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));

		$this->set(compact('authors', 'webpage'));
	}
	
	function admin_toggle($id = false) {
		
		$result = $this->Webpage->toggle($id, 'visible');
		
		if ($this->request->params['isAjax']) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../json/empty');
			} else {
				$errors = $this->Webpage->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../json/error');
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

	function admin_add() {
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
	
	function admin_menu_action() {
		$resultArray = $this->Webpage->handleMenuAction($this->request->data);
		if ($resultArray['success']) {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_success'));	
		} else {
			$this->Session->setFlash(__($resultArray['message']), 'default', array('class'=>'flash_failure'));	
		}
		$this->redirect(array('action' => 'index'));
	}

	function admin_edit($id = null) {
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

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webpage'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Webpage->delete($id)) {
			$this->Session->setFlash(__('webpage deleted'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('webpage was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

}
?>
