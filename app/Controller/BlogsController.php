<?php
class BlogsController extends AppController {

	public $name = 'Blogs';
	
	public $viewClass = 'Theme';
	
	public $components = array('Permission' =>
				array('redirect' =>
					array('controller'=>'webpages',
					      'action'    => 'index',
					      'admin'     => true,
					))
				);
	
	
	
	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		if ($this->request->action == 'admin_edit') {
			$this->Security->validatePost = false;
		}
		
	}

	
	public function admin_index() {
		$this->Blog->recursive = 0;
		$this->Paginator->settings = array('conditions'=>array('Blog.shop_id'=>Shop::get('Shop.id')));
		$this->set('blogs', $this->paginate());
		
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid blog'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Blog->recursive 	      = 0;
		$blog                         = $this->Blog->read(null, $id);
		
		$this->paginate = array(
            'conditions' => array('Post.blog_id' => $blog['Blog']['id']),
		    'order'      => array('Post.created DESC'),
		    'fields'     => array('Post.id', 'Post.blog_id', 'Post.title',
						      'Post.created', 'Post.modified', 'Post.visible'));
		
		$posts                        = $this->paginate('Post');

		$this->set(compact('blog', 'posts'));	
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('controller'=>'blogs',
					      'action' => 'view', $this->Blog->id));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid blog'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->request->data)) {
			$this->Blog->recursive = -1;
			$this->Blog->bindModel( array('hasMany' => array('Post')) );
			$this->request->data = $this->Blog->read(null, $id);
		}
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for blog'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		if ($this->Blog->delete($id)) {
			$this->Session->setFlash(__('Blog deleted'), 'default', array('class'=>'flash_success'));
			$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
		}
		$this->Session->setFlash(__('Blog was not deleted'), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('controller'=>'webpages',
					      'action' => 'index'));
	}
}
?>
