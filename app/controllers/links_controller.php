<?php
class LinksController extends AppController {

	var $name = 'Links';
	
	var $helpers = array('Ajax');
	
	function beforeFilter() {
		parent::beforeFilter();
		
		if ($this->action == 'admin_edit') {
			$this->Security->validatePost = false;
		}
	}

	function index() {
		$this->Link->recursive = 0;
		$this->set('links', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid link', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('link', $this->Link->read(null, $id));
		
	}

	function add() {
		if (!empty($this->data)) {
			$this->Link->create();
			if ($this->Link->save($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true));
			}
		}
		$linkLists = $this->Link->LinkList->find('list');
		$this->set(compact('linkLists'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid link', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Link->save($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Link->read(null, $id);
		}
		$linkLists = $this->Link->LinkList->find('list');
		$this->set(compact('linkLists'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for link', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Link->delete($id)) {
			$this->Session->setFlash(__('Link deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Link was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_index() {
		
		$shopId = Shop::get('Shop.id');
		
		$this->Link->LinkList->recursive = -1;
		$this->Link->LinkList->Behaviors->attach('Containable');
		$lists = $this->Link->LinkList->find('all',
						     array('conditions'=>array('LinkList.shop_id'=>$shopId),
							   'contain' => array('Link')));
		
		$this->set('lists', $lists);
		
		// now we set the blogs, products, pages belonging to this shop
		$blog = ClassRegistry::init('Blog');
		$blog->recursive = -1;
		$blogs = $blog->find('all', array('conditions' => array('Blog.shop_id'=>$shopId),
						  'fields'     => array('Blog.id', 'Blog.short_name')));
		
		$product = ClassRegistry::init('Product');
		$product->recursive = -1;
		$products = $product->find('all', array('conditions'=>array('Product.shop_id'=>$shopId),
							'fields'     => array('Product.id','Product.title')));
		
		$page = ClassRegistry::init('Webpage');
		$page->recursive = -1;
		$pages = $page->find('all', array('conditions'=>array('Webpage.shop_id'=>$shopId),
						  'fields'     => array('Webpage.handle','Webpage.title')));
		
		
		$this->set(compact('blogs', 'products', 'pages'));
		
		
	}
	
	private function convertBlogOptions($blogs) {
		$array = array();
		foreach($blogs as $blog) {
			$array[$blog['Blog']['short_name']] = $blog['Blog']['short_name'];
		}
		return $array;
	}
	
	private function convertProductOptions($products) {
		$array = array();
		foreach($products as $product) {
			$array[$product['Product']['id']] = $product['Product']['title'];
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
		$model = $link['Link']['model'];
		
		if (strpos($model, 'blog') !== false) {
			// now we set the blogs, products, pages belonging to this shop
			$blog = ClassRegistry::init('Blog');
			$blog->recursive = -1;
			$blogs = $blog->find('all', array('conditions' => array('Blog.shop_id'=>$shopId),
							  'fields'     => array('Blog.id', 'Blog.short_name')));
			
			return $this->convertBlogOptions($blogs);
			
		} else if (strpos($model, 'product') !== false) {
			$product = ClassRegistry::init('Product');
			$product->recursive = -1;
			$products = $product->find('all', array('conditions'=>array('Product.shop_id'=>$shopId),
								'fields'     => array('Product.id','Product.title')));
			return $this->convertProductOptions($products);
			
		} else if (strpos($model, 'page') !== false) {
			
			$page = ClassRegistry::init('Webpage');
			$page->recursive = -1;
			$pages = $page->find('all', array('conditions'=>array('Webpage.shop_id'=>$shopId),
							  'fields'     => array('Webpage.handle','Webpage.title')));
			
			return $this->convertPageOptions($pages);
		}
	
		return false;
		
	}

	function admin_add() {
		$result = false;
		if (!empty($this->data)) {
			$this->Link->create();
			if ($this->Link->save($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true));
				$result = true;
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true));
			}
		}
		
		if ($this->params['isAjax']) {
				
			$this->layout = 'json';
			if ($result) {
				$link = $this->fetchCurrent();
				$actionOptions = $this->populateActionForNewLink($link);
				
				$successJSON  = true;
				$this->set(compact('link', 'actionOptions', 'successJSON'));
				$this->render('new_link');
			} else {
				$errors = $this->Link->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('json/error');
			}
				
		} else {
			$this->redirect(array('action' => 'index'));
		}
		
	}
	
	private function fetchCurrent() {
		
		$this->Link->recursive = -1;
		
		return $this->Link->read(null, $this->Link->id);
		
	}

	/** the $id here is referring to the linklistid, and not the linkid.
	 *
	 * we need to saveAll for the entire list rather than individual links
	 * */
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid link', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			$this->log($this->data);
			
			if ($this->Link->LinkList->saveAll($this->data)) {
				$this->Session->setFlash(__('The link has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Link->read(null, $id);
		}
		$linkLists = $this->Link->LinkList->find('list');
		$this->set(compact('linkLists'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for link', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Link->delete($id)) {
			$this->Session->setFlash(__('Link deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Link was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>