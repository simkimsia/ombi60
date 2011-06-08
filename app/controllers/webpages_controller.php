<?php
class WebpagesController extends AppController {

	var $name = 'Webpages';
	
	var $components = array('Theme' => array(
					'actions'=>array(
						'view',
						'frontpage')),);
	
	
	//var $view = 'TwigView.TwigTheme';
	
	var $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce');

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('view', 'shopfront', 'frontpage');
		$this->prepareGlobalObjectsInTwigViews();
		if ($this->action == 'admin_toggle') {
			$this->Security->enabled = false;
		}
		
	}

	private function prepareGlobalObjectsInTwigViews() {
		$shop = Shop::getTemplateVariable();
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
		
		$this->set('title_for_layout', $webpage['Webpage']['title']);
		
		$page = $webpage['Webpage'];
		
		$this->set(compact('page'));
		
		$this->viewPath = 'pages';
		$this->render('page');
		
	}


	// this is where the / will get routed to
	// this is supposed to use the index.tpl inside pages folder within the theme
	function frontpage() {
		$this->viewPath = 'pages';
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
			$this->Session->setFlash(__('Invalid webpage', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('webpage', $this->Webpage->read(null, $id));
		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));

		$this->set(compact('authors'));
	}
	
	function admin_toggle($id = false) {
		
		$result = $this->Webpage->toggle($id, 'visible');
		
		if ($this->params['isAjax']) {
			
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
				$this->Session->setFlash(__('Webpage status has been changed', true), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Webpage status could not be changed. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
			$this->redirect(array('action' => 'index'));
		}
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
