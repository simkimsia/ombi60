<?php
class DomainsController extends AppController {

	var $name = 'Domains';
	
	var $helpers = array('Ajax', 'Javascript', 'Number');
	
	function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
	
	}

	function admin_index() {
		$this->Domain->recursive = 0;
		$mainUrl = Shop::get('Shop.web_address');
		$this->set('mainUrl', $mainUrl);
        $shopId = User::get('Merchant.shop_id');
		$this->set('domains', $this->paginate('Domain', array(
								      'Domain.shop_id ' => User::get('Merchant.shop_id')) ));
		$this->set('shopId', $shopId);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('domain', $this->Domain->read(null, $id));
	}

	function admin_add() {
	    $result = true;
		if (!empty($this->data)) {
		    if (!empty($this->data['Domain']['domain'])) {
		        $this->data['Domain']['domain'] = 'http://' . $this->data['Domain']['domain'];
			
			    $this->Domain->create();
			    if (!$this->Domain->save($this->data)) {
			        $result = false;
			    }
			    if ($this->params['isAjax']) {
			
			        $this->layout = 'json';
			        if ($result) {
				        $domains = $this->fetchCurrent();
				        $successJSON  = true;
				        $this->set(compact('domains', 'successJSON'));
				
				        $this->render('admin_domain_list');
			        } else {
				        //$errors = $this->Domain->validationErrors;
				        $response['successJSON'] = false;
        		        $response['message'] = "This domain already exists.";
        		        $this->sendJson($response);
        		        return ;
			        }
			
			
		        } else {
			        $this->redirect(array('action' => 'index'));
		        }
		    } else {
		        $response['successJSON'] = false;
		        $response['message'] = "Please enter domain name.";
		        $this->sendJson($response);
		        return ;
		    }
			
		}
		$shopId = Shop::get('Shop.id');
		$this->set(compact('shopId'));
	}
	
	function admin_make_this_primary($id = false, $shopId = false) {
		
		
		if (!$id OR !$shopId) {
			$this->Session->setFlash(__('Invalid id for domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}

		if ($this->Domain->make_this_primary($id, $shopId)) {
			$this->Session->setFlash(__('Domain now primary', true), 'default', array('class'=>'flash_failure'));

			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('This domain could not be primary. Please, try again.', true), 'default', array('class'=>'flash_failure'));
		$this->redirect(array('action' => 'index'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Domain->save($this->data)) {
				$this->Session->setFlash(__('The domain has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Domain->read(null, $id);
		}
		$shops = $this->Domain->Shop->find('list');
		$this->set(compact('shops'));
	}

	function admin_delete($id = false) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for domain', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));
		}
		
		$userId = User::get('User.id');
		$shopId = Shop::get('Shop.id');
		$this->Domain->Shop->Merchant->Behaviors->attach('Linkable.Linkable');
		
		$merchantAllowed = $this->Domain->Shop->Merchant->find('count',
								       array('conditions' =>
									     array('Merchant.user_id' => $userId,
										   'Merchant.shop_id' => $shopId,
										   'Domain.id'=>$id,
										   'Domain.shop_web_address' => false),
									     'link' =>
									     array('Shop' => array('Domain'))
									     ));
		
		
		if ($merchantAllowed) {
			if ($this->Domain->delete($id)) {
				$this->Session->setFlash(__('Domain deleted', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Domain was not deleted', true), 'default', array('class'=>'flash_failure'));
		} else {
			$this->Session->setFlash(__('You are not authorized to delete this domain', true), 'default', array('class'=>'flash_failure'));
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	private function fetchCurrent() {
	
		$this->Domain->recursive = 0;
		
		$mainUrl = Shop::get('Shop.web_address');
		$this->set('mainUrl', $mainUrl);
		
        $shopId = User::get('Merchant.shop_id');
		
		return $this->paginate('Domain', array(
								      'Domain.shop_id ' => User::get('Merchant.shop_id')) );
		
	}
}
?>
