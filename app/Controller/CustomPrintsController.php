<?php
App::uses('AppController', 'Controller');
/**
 * CustomPrints Controller
 *
 * @property CustomPrint $CustomPrint
 */
class CustomPrintsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CustomPrint->recursive = 0;
		$this->set('customPrints', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->CustomPrint->id = $id;
		if (!$this->CustomPrint->exists()) {
			throw new NotFoundException(__('Invalid custom print'));
		}
		$this->set('customPrint', $this->CustomPrint->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CustomPrint->create();
			if ($this->CustomPrint->save($this->request->data)) {
				$this->Session->setFlash(__('The custom print has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The custom print could not be saved. Please, try again.'));
			}
		}
		$products = $this->CustomPrint->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->CustomPrint->id = $id;
		if (!$this->CustomPrint->exists()) {
			throw new NotFoundException(__('Invalid custom print'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CustomPrint->save($this->request->data)) {
				$this->Session->setFlash(__('The custom print has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The custom print could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CustomPrint->read(null, $id);
		}
		$products = $this->CustomPrint->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->CustomPrint->id = $id;
		if (!$this->CustomPrint->exists()) {
			throw new NotFoundException(__('Invalid custom print'));
		}
		if ($this->CustomPrint->delete()) {
			$this->Session->setFlash(__('Custom print deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Custom print was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
