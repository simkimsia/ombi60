<?php
class LinkListsController extends AppController {

	var $name = 'LinkLists';
	
	var $components = array('Permission' =>
				array('redirect' =>
					array('controller'=> 'links',
					      'action' 	  => 'index',
					      'admin'     => true,
					))
				);
	
	function beforeFilter() {
		parent::beforeFilter();
		
		if ($this->action== 'admin_edit') {
			$this->Security->validatePost = false;
		}
	
	}

	/** the $id here is referring to the linklistid, and not the linkid.
	 *
	 * we need to saveAll for the entire list rather than individual links
	 * */
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid linklist', true));
			$this->redirect(array('controller' => 'links',
					      'admin' => true,
					      'action' => 'index'));
		}
		if (!empty($this->data)) {
			
			if ($this->LinkList->saveAll($this->data)) {
				$this->Session->setFlash(__('The linklist has been saved', true));
				
			} else {
				$this->Session->setFlash(__('The linklist could not be saved. Please, try again.', true));
			}
			$this->redirect(array('controller' => 'links',
					      'admin' => true,
					      'action' => 'index'));
		}
		
	}

}
?>