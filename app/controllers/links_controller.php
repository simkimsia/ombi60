<?php
class LinksController extends AppController {

	var $name = 'Links';
	
	var $helpers = array('Ajax');
	
	function beforeFilter() {
		parent::beforeFilter();
		
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

	function admin_view($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid link', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('link', $this->Link->read(null, $id));
	}

	function admin_add() {
		$result = false;
		if (!empty($this->data)) {
			$this->data['Link']['route'] = $this->data['Link']['model'] . $this->data['Link']['action'];
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
				$successJSON  = true;
				$this->set(compact('link', 'successJSON'));
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

	function admin_edit($id = null) {
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