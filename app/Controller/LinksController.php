<?php
class LinksController extends AppController {

	public $name = 'Links';
	
	public $helpers = array('Javascript', 'Ajax');
	
	public function beforeFilter() {
		parent::beforeFilter();
		if ($this->request->action== 'admin_order') {
			$this->Components->disable('Security');
		}
		if ($this->request->action== 'admin_edit' || $this->request->action == 'admin_add') {
			$this->Security->validatePost = false;
		}
	}
	
	public function admin_index() {
		
		$shopId = Shop::get('Shop.id');
		
		$this->Link->LinkList->recursive = -1;
		$this->Link->LinkList->Behaviors->attach('Containable');
		$lists = $this->Link->LinkList->find('all',
						     array('conditions' => array('LinkList.shop_id'=>$shopId),
							   'contain'    => array('Link'=>array('order' => array('Link.order ASC'))),
							  ));
		
		$this->set('lists', $lists);
		
		// now we set the blogs, products, pages belonging to this shop
		$blog = ClassRegistry::init('Blog');
		$blog->recursive = -1;
		$blogs = $blog->find('all', array('conditions' => array('Blog.shop_id'=>$shopId),
						  'fields'     => array('Blog.id', 'Blog.title', 'Blog.short_name')));
		
		$product = ClassRegistry::init('Product');
		$product->recursive = -1;
		$products = $product->find('all', array('conditions'=>array('Product.shop_id'=>$shopId),
							'fields'     => array('Product.id', 'Product.handle','Product.title')));
		
		$page = ClassRegistry::init('Webpage');
		$page->recursive = -1;
		$pages = $page->find('all', array('conditions'=>array('Webpage.shop_id'=>$shopId),
						  'fields'     => array('Webpage.id', 'Webpage.handle','Webpage.title')));
		
		
		$this->set(compact('blogs', 'products', 'pages'));
		
		
	}
	
	/**
	 * there is no need to disable security
	 * because we are not using data to transmit the POST data
	 * */
	public function admin_order($listId) {
		if ($this->request->is('ajax')) {
				
			// the $_POST data is expected to be 2011-01-10 11:07:36 Error: Array
			//(
			//    [displayrow] => Array
			//        (
			//            [0] => 3
			//            [1] => 1
			//            [2] => 2
			//        )
			//
			//)
			
			$result = $this->Link->saveOrder($_POST['displayrow'], $listId);
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				$errors = $this->Link->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('The link has been saved'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}
	
	private function convertEmptyOptions() {
		$array = array();
		$array[''] = '';
		
		return $array;
	}
	
	private function convertBlogOptions($blogs) {
		$array = array();
		foreach($blogs as $blog) {
			$array[$blog['Blog']['short_name']] = $blog['Blog']['title'];
		}
		return $array;
	}
	
	private function convertProductOptions($products) {
		$array = array();
		foreach($products as $product) {
			$array[$product['Product']['handle']] = $product['Product']['title'];
		}
		return $array;
	}
	
	private function convertPageOptions($pages) {
		$array = array();
		foreach($pages as $page) {
			$array[$page['Webpage']['handle']] = $page['Webpage']['title'];
		}
		return $array;
	}
	
	private function populateActionForNewLink($link) {
		
		$shopId = Shop::get('Shop.id');
		$model  = $link['Link']['model'];
		$actions = array();
		
		
		if (strpos($model, 'blog') !== false) {
			// now we set the blogs, products, pages belonging to this shop
			$blog = ClassRegistry::init('Blog');
			$blog->recursive = -1;
			$blogs = $blog->find('all', array('conditions' => array('Blog.shop_id'=>$shopId),
							  'fields'     => array('Blog.id', 'Blog.title', 'Blog.short_name')));
			
			$actions = array(
				'options'	=> $this->convertBlogOptions($blogs),
				'actionNeeded'	=> true,
				'textBoxNeeded'	=> false);
			
			return $actions;
			
		} else if  (($model === '/collections/all') ||
			    ($model === '/') ||
			    ($model === '/cart') ) {
			
			$actions = array(
				'options'	=> $this->convertEmptyOptions(),
				'actionNeeded'	=> false,
				'textBoxNeeded'	=> false);
			
			return $actions;
		
		} else if (($model === 'web')) {
			
			$actions = array(
				'options'	=> $this->convertEmptyOptions(),
				'actionNeeded'	=> false,
				'textBoxNeeded'	=> true);
			
			return $actions;
			
		} else if (strpos($model, 'product') !== false) {
			$product = ClassRegistry::init('Product');
			$product->recursive = -1;
			$products = $product->find('all', array('conditions'=>array('Product.shop_id'=>$shopId),
								'fields'     => array('Product.id','Product.title', 'Product.handle')));
			
			
			$actions = array(
				'options'	=> $this->convertProductOptions($products),
				'actionNeeded'	=> true,
				'textBoxNeeded'	=> false);
			
			return $actions;
			
		} else if (strpos($model, 'page') !== false) {
			
			$page = ClassRegistry::init('Webpage');
			$page->recursive = -1;
			$pages = $page->find('all', array('conditions'=>array('Webpage.shop_id'=>$shopId),
							  'fields'     => array('Webpage.id', 'Webpage.handle','Webpage.title')));
			
			
			$actions = array(
				'options'	=> $this->convertPageOptions($pages),
				'actionNeeded'	=> true,
				'textBoxNeeded'	=> false);
			
			return $actions;
		}
	
		return false;
		
	}

	public function admin_add() {
		$result = false;
		
		if (!empty($this->request->data)) {
			
			$this->Link->create();
			$result = $this->Link->save($this->request->data);
		}
		
		if ($this->request->params['isAjax']) {
				
			$this->layout = 'json';
			if ($result) {
				$link 	       = $this->fetchCurrent();
				$actionResult  = $this->populateActionForNewLink($link);
				
				$actionOptions = isset($actionResult['options']) ? $actionResult['options'] : false;
				$actionNeeded  = isset($actionResult['actionNeeded']) ? $actionResult['actionNeeded'] : false;
				$textBoxNeeded = isset($actionResult['textBoxNeeded']) ? $actionResult['textBoxNeeded'] : false;
				
				$successJSON   = true;
				
				$this->set(compact('link',
						   'actionOptions',
						   'successJSON',
						   'actionNeeded',
						   'textBoxNeeded'));
				
				$this->render('new_link');
			} else {
				$errors = $this->Link->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('The link has been saved'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'));
			}
			$this->redirect(array('action' => 'index'));
		}
		
	}
	
	private function fetchCurrent() {
		
		$this->Link->recursive = -1;
		
		return $this->Link->read(null, $this->Link->id);
		
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for link'));
			$this->redirect(array('action'=>'index'));
		}
		
		$result = $this->Link->delete($id);
		
		if ($this->request->params['isAjax']) {
				
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				
				$errors = $this->Link->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			
			if($result) {
				$this->Session->setFlash(__('Successfully delete'));
			} else {
				$this->Session->setFlash(__('Unable to delete'));
			}
			$this->redirect(array('action' => 'index'));
		}
		
		
	}
}
?>