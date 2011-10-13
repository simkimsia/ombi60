<?php
class LinkListsController extends AppController {

	public $name = 'LinkLists';
	
	public $components = array('Permission' =>
				array('redirect' =>
					array('controller'=> 'links',
					      'action' 	  => 'index',
					      'admin'     => true,
					))
				);
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		if ($this->request->action== 'admin_edit') {
			$this->Security->validatePost = false;
		}
	
	}

	/** the $id here is referring to the linklistid, and not the linkid.
	 *
	 * we need to saveAll for the entire list rather than individual links
	 * */
	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid linklist'));
			$this->redirect(array('controller' => 'links',
					      'admin' => true,
					      'action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->LinkList->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The linklist has been saved'));
				
			} else {
				$this->Session->setFlash(__('The linklist could not be saved. Please, try again.'));
			}
			
		}
		$this->redirect(array('controller' => 'links',
					      'admin' => true,
					      'action' => 'index'));
		
	}

}
?>