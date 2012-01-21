<?php
class ProductGroupsController extends AppController {

	public $name = 'ProductGroups';
	
	public $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce');
	
	public $components = array(
		'Permission' => array(
			'actionsWithPrimaryKey' => array(
				'admin_view_smart',
				'admin_edit_smart',
			    'admin_view_custom',
			    'admin_edit_custom',
			    'admin_delete',
				'admin_toggle',
			),
			'actionsWithShopId' => array(
				'admin_add_smart',
				'admin_add_custom',
			),
			'errorMessage' => 'You do not have permissions for this Collection',
		)
	);
	
	public function beforeFilter() {
	 	// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		if ($this->request->action == 'admin_toggle' ||  
			$this->request->action == 'admin_add_smart' ||
			$this->request->action == 'admin_save_condition' ) {
			$this->Components->disable('Security');
		}
	}

	public function admin_index() {
		
		$this->ProductGroup->recursive = 1;
		$shopId = Shop::get('Shop.id');
		$customCollections = $this->ProductGroup->find('all', array(
			'conditions'=>array(
				'ProductGroup.type'=>CUSTOM_COLLECTION,
				'ProductGroup.shop_id'=>$shopId,
			),
		));

		$smartCollections = $this->ProductGroup->find('all', array(
			'conditions'=>array(
				'ProductGroup.type'=>SMART_COLLECTION,
				'ProductGroup.shop_id'=>$shopId,
			),
		));
		
		$this->set(compact('customCollections', 'smartCollections'));
	}
	
	

	public function admin_view_smart($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid smart collection'));
			$this->redirect($this->refer());
		      }
		
			
		
		$this->__getSmartCollection($id);
		$this->set('view', true);
	}

	public function admin_add_smart() {
		//First we check whether data is posted?
		if (!empty($this->request->data)) {
			$i = 0;
			foreach ($_POST['fields'] as $field) {
				$this->request->data['SmartCollectionCondition'][$i]['field'] = $field;
				$i++;
			}
			$i = 0;
			foreach ($_POST['relations'] as $relation) {
				$this->request->data['SmartCollectionCondition'][$i]['relation'] = $relation;
				$i++;
			}
			$i = 0;
			foreach ($_POST['conditions'] as $condition) {
				$this->request->data['SmartCollectionCondition'][$i]['condition'] = $condition;
				$i++;
			}
			$this->request->data['ProductGroup']['type'] = SMART_COLLECTION;
			if ((bool)$this->ProductGroup->createSmartCollection($this->request->data)) {
				$this->redirect(array(
						 'controller' => 'product_groups',
						 'admin'      => true,
						 'action'     => 'index',
						));
			}
		}
		
	}

	public function admin_edit_smart($id = null) {
		
		if (!$id) {
		  $this->Session->setFlash(__('Invalid smart collection'));
		  $this->redirect($this->refer());
		}
		if (!empty($this->request->data)) {
			$this->request->data['ProductGroup']['type'] = SMART_COLLECTION;
			
			if ($this->ProductGroup->save($this->request->data)) {
				$this->redirect(array('action' => 'admin_view_smart', $id));
			} else {
				$this->Session->setFlash(__('Unable to save smart collection'));
			}
		}
		$this->request->data = $this->__getSmartCollection($id);
		$this->set('view', true);
	}
	
	public function admin_view_custom($id = null) {
    
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group'));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$product_group = $this->ProductGroup->find('first', array(
			'conditions' => array(
				'ProductGroup.id' => $id,
			),
			'contain' => array('ProductsInGroup')
		));
		
		$group_products = array();

		if (isset($product_group['ProductsInGroup']) && !empty($product_group['ProductsInGroup'])) {
			foreach($product_group['ProductsInGroup'] as $val) {
				$product_in_groups[] = $val['product_id'];
		    }
		}
$group_products = $this->ProductGroup->ProductsInGroup->getProductsWithImagesByGroupId($id);
    
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	
		$products = $this->ProductGroup->ProductsInGroup->Product->getAllWithImagesByShopId(Shop::get('Shop.id'));
		
		$product_group_id = $id;
		$this->set(compact('products','product_group_id','group_products'));
	}
	
	public function admin_add_custom() {
	  
		if (!empty($this->request->data)) {
			// set the type to custom
			$this->request->data['ProductGroup']['type'] = CUSTOM_COLLECTION;
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The product group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.'));
			}
		}
		
	}
	
	public function admin_add_product_in_group($group_id,$product_id) {
	      
	    
		if (!empty($group_id) && !empty($product_id))  {
		   
			$data['ProductsInGroup']['product_id'] = $product_id;
			$data['ProductsInGroup']['product_group_id'] = $group_id;
			$recordExists = $this->ProductGroup->ProductsInGroup->find('count',
						array('conditions' => array(
							'product_id' => $product_id ,
							'product_group_id' => $group_id)
						      ));
		     
			if (!$recordExists) {
				$this->ProductGroup->ProductsInGroup->create();
				$this->ProductGroup->ProductsInGroup->save($data);
			} else {
				$this->set('error','Record already exists');
			}
			$product_group = $this->ProductGroup->read(null, $group_id);
			if (isset($product_group['ProductsInGroup']) && !empty($product_group['ProductsInGroup'])) {
				foreach($product_group['ProductsInGroup'] as $val) {
					$product_in_groups[] = $val['product_id'];
				}
			}
			$group_products = $this->ProductGroup->ProductsInGroup->getProductsWithImagesByGroupId($group_id);
	
			$product_group_id = $group_id;
			$this->set(compact('product_group_id','group_products'));             	          
		      
		} else {
		  //$data['success'] = false;
		} 
		$this->layout = '';
		$this->autoRender = false;
		$this->render(DS . 'Elements' . DS . 'admin_product_group_list');
	   
	}
	
	public function admin_remove_product_from_group($group_id,$product_id) {
	      
	    
		if (!empty($group_id) && !empty($product_id))  {
		  
			$record = $this->ProductGroup->ProductsInGroup->find('first',array('conditions' => array('product_id' => $product_id , 'product_group_id' => $group_id)));
		    
			if (!empty($record) && is_array($record)) {
				$this->ProductGroup->ProductsInGroup->delete($record['ProductsInGroup']['id']);
			} else {
				$this->set('error','Record does not exists');
			}
			
			$product_group = $this->ProductGroup->read(null, $group_id);
			
			$group_products = $this->ProductGroup->ProductsInGroup->getProductsWithImagesByGroupId($group_id);

			$product_group_id = $group_id;
			$this->set(compact('product_group_id','group_products')); 	         	          
		} 
	       
		$this->layout = '';
		$this->autoRender = false;
		$this->render(DS . 'Elements' . DS . 'admin_product_group_list');
	   	    	    
	}
	
	public function admin_edit_custom($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid product group'));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->request->data)) {
			// set the type to custom
			$this->request->data['ProductGroup']['type'] = CUSTOM_COLLECTION;
			if ($this->ProductGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The product group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ProductGroup->read(null, $id);
		}
		
		$product_group = $this->ProductGroup->read(null, $id);
		
		$group_products = array();
		if (isset($product_group['ProductsInGroup']) && !empty($product_group['ProductsInGroup'])) {
			foreach($product_group['ProductsInGroup'] as $val) {
				$product_in_groups[] = $val['product_id'];
			}
		    
			$group_products = $this->ProductGroup->Shop->Product->find('all', array('conditions' => array('Product.visible' => 1,'Product.id' => $product_in_groups), 'contain' => array('ProductImage')));
		}
   
    
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
		$conditions = array('Product.visible' => 1);
		$products = $this->ProductGroup->Shop->Product->find('all', array('conditions' => $conditions, 'contain' => array('ProductsInGroup', 'ProductImage')));
		$product_group_id = $id;
		$this->set(compact('products','product_group_id','group_products'));
		
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product group'));
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->ProductGroup->delete($id)) {
			$this->Session->setFlash(__('Product group deleted'));
		} else {
			$this->Session->setFlash(__('Product group was not deleted'));	
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_toggle($id = false) {
		
		$result = $this->ProductGroup->toggle($id, 'visible');
		
		if ($this->request->is('ajax')) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../Json/empty');
			} else {
				$errors = $this->ProductGroup->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../Json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('Collection status has been changed'), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Collection status could not be changed. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}// end admin_toggle

	private function __getSmartCollection($id) {
		$smart_collection = $this->ProductGroup->find('first', array(
			'conditions'=>array(
				'ProductGroup.id'=>$id, 
				'ProductGroup.type'=>SMART_COLLECTION
			),
			'contain' => array('SmartCollectionCondition')
		));
	
		//Get list of all the products
		//$products = $this->ProductGroup->getSmartCollectionProducts($smart_collection); this is by automated logic
		
		$products = $this->ProductGroup->ProductsInGroup->getProductsWithImagesByGroupId($id); // this assumes porducts_in_groups does all the matching
		
		$this->set(compact('smart_collection', 'products'));
		
		return $smart_collection;
	}//end __getSmartCollection()

	public function admin_remove_condition($condition_id = null, $smart_collection_id = null) {
		if (!$condition_id) {
			$this->Session->setFlash(__('Invalid smart collection'));
			$this->redirect($this->refer());
		}
	    
		if ($this->ProductGroup->SmartCollectionCondition->deleteAll($condition_id)) {
			$this->layout = 'ajax';
			$this->__getSmartCollection($smart_collection_id);
			$this->render('/elements/admin_smart_collection_products');
		}
		die;
	}

	public function admin_save_condition() {
		$i = 0;
		foreach ($_POST['fields'] as $field) {
			$this->request->data['SmartCollectionCondition'][$i]['field'] = $field;
			$i++;
		}
		$i = 0;
		foreach ($_POST['relations'] as $relation) {
			$this->request->data['SmartCollectionCondition'][$i]['relation'] = $relation;
			$i++;
		}
		$i = 0;
		foreach ($_POST['conditions'] as $condition) {
			$this->request->data['SmartCollectionCondition'][$i]['condition'] = $condition;
			$i++;
		} 
		$smart_collection_id = $_POST['smart_collection_id'];
		
		
		$this->set('view', true);
		$this->set('smart_collection_id', $smart_collection_id);
		if ($this->ProductGroup->saveSmartCollectionCondition($this->request->data, $smart_collection_id)) {
			if ($this->request->is('ajax')) {
				$this->layout = 'ajax';
			}
			$this->__getSmartCollection($smart_collection_id);
			
		}
		$this->render('/elements/admin_set_smart_collection_condition');
		
	}

}