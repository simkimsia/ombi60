<?php
class WebpagesController extends AppController {

	public $name = 'Webpages';
	
	public $components = array('Permission');
	
	public $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce',
				'Number',
				'Time');

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('view', 'shopfront', 'frontpage', 'error');
	
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
		
		/* for sorting */
		$columns = array(
			'0' => 'Webpage.title',
			'1' => 'Webpage.modified'
		);
		
		
		$this->Webpage->recursive = 0;
		
		$shopId = Shop::get('Shop.id');		
		
		$limit	= 25;
		$page	= 1;
		$fieldToSort = 'Webpage.title';
		$sortDir = 'asc';

		$currentPageLength = $limit;
		
		$fieldsToFilter = array();

		if (isset($this->request->query['iDisplayLength'])) {
			$currentPageLength = $this->request->query['iDisplayLength'];
		}

		if ($this->request->is('ajax')) {
			$start	= $this->request->query['iDisplayStart'];
			$limit	= $this->request->query['iDisplayLength'];
			$page	= ($start / $limit) + 1;

			if (isset($this->request->query['iSortCol_0'])) {
				if (is_numeric($this->request->query['iSortCol_0'])) {

					$fieldToSort = $columns[$this->request->query['iSortCol_0']];
					$sortDir = 'asc';
					if (isset($this->request->query['sSortDir_0'])) {
						$sortDir = $this->request->query['sSortDir_0'];
					}
				}
			} 

		}

		$defaultFilter = array('Webpage.shop_id' => $shopId);
		$conditions = array_merge($defaultFilter, $fieldsToFilter);

		$this->paginate = array(
			'conditions' => $conditions,
			'page' => $page,
			'limit' => $limit,
			'order' => array(
				$fieldToSort => $sortDir
			)
		);


		$webpages = $this->paginate();
		
		if ($this->request->is('ajax')) {


			$iTotal 		= $this->request->params['paging']['Webpage']['count'];
			$iTotalDisplay 	= $iTotal;


			$sEcho			= $this->request->query['sEcho'];
			$this->layout = 'json_html';

			// no views rendered
			$this->autoRender = false;

	        $this->set(compact('webpages', 'iTotal', 'iTotalDisplay', 'sEcho'));

	        $this->render('admin_index_json');

			return;
		} else if ($this->request->is('get')) {
			$this->set(compact('webpages', 'currentPageLength'));
			
		}
		
		
		
		
		$blogModel = $this->Webpage->Shop->Blog;
		$blogModel->Behaviors->load('Containable');
		
		$blogs = $blogModel->find('all', array(
			'conditions'=>array('Blog.shop_id'=>$shopId),
			'contain'=>array(
				'Post'=>array(
					'Author' => array('fields' => array('Author.full_name')),
					'fields'=>array(
						'Post.id', 
						'Post.blog_id',
						'Post.title', 
						'Post.modified',
						'Post.visible'),
					'limit'=>5,
					'order'=>'Post.modified DESC'
				)
			),
			'order' => 'Blog.title ASC'
		));
		
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
		$this->set('title_for_layout', $webpage['Webpage']['title']);
	}
	
	public function admin_toggle($id = false) {
		
		$result = $this->Webpage->toggle($id, 'visible');
		
		if ($this->request->is('ajax')) {
			
			$this->layout = 'json_data';
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
			$this->request->data = $this->Webpage->getDetails($id, HIDDEN_AND_VISIBLE_ENTITY);
		}

		$authors = $this->Webpage->Shop->getAllMerchantUsersInList(Shop::get('Shop.id'));
		
		$this->set(compact('authors'));
		$this->set('title_for_layout', $this->request->data['Webpage']['title']);
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

	/**
	*
	* the default action for all 404 public pages
	*
	**/
    public function error() {

        $this->set(array(
            'code' => '404',
            'name' => __('Not Found'),
            'page_title' => 'Page Not Found',
            'template' => '404',
        ));


        $this->render('/templates/404');

    }


}
?>
