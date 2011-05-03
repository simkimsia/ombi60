<?php
class ProductGroupsController extends AppController {

	var $name = 'ProductGroups';
	
	var $helpers = array('Javascript',
			     'Ajax',
			     'TinyMce.TinyMce');
	
	function beforeFilter() {
	  
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow($this->action);	
    Configure::write('debug', 2);
		if ($this->action == 'admin_toggle') {
			$this->Security->enabled = false;
		}
	}

	function admin_index() {
		$this->ProductGroup->recursive = -1;
		$shopId = Shop::get('Shop.id');
		$customCollections = $this->ProductGroup->find('all', array('conditions'=>array('ProductGroup.type'=>0,
												'ProductGroup.shop_id'=>$shopId)));
		$smartCollections = $this->ProductGroup->find('all', array('conditions'=>array('ProductGroup.type'=>1,
											       'ProductGroup.shop_id'=>$shopId)));
		$this->set(compact('customCollections', 'smartCollections'));
	}
	
	

	function admin_view_smart($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	}

	function admin_add_smart() {
		if (!empty($this->data)) {
			// set the type to smart
			$this->data['ProductGroup']['type'] = 1;
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		
	}

	function admin_edit_smart($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// set the type to smart
			$this->data['ProductGroup']['type'] = 1;
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGroup->read(null, $id);
		}
		
	}
	
	function admin_view_custom($id = null) {
    Configure::write('debug', 2);
		if (!$id) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
    $this->ProductGroup->recurive = 3;
    
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
	
	function admin_add_custom() {
	  
		if (!empty($this->data)) {
			// set the type to custom
			$this->data['ProductGroup']['type'] = 0;
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		
	}
	
	function admin_add_product_in_group($group_id,$product_id) {
	      
	    
	    if (!empty($group_id) && !empty($product_id))  {
	       
	         $data['ProductsInGroup']['product_id'] = $product_id;
	         $data['ProductsInGroup']['product_group_id'] = $group_id;
	         $recordExists = $this->ProductGroup->ProductsInGroup->find('count',array('conditions' => array('product_id' => $product_id , 'product_group_id' => $group_id)));
	         
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
             
            $group_products = $this->ProductGroup->Shop->Product->find('all', array('conditions' => array('Product.visible' => 1,'Product.id' => $product_in_groups), 'contain' => array('ProductImage')));
            
            $product_group_id = $group_id;
            $this->set(compact('product_group_id','group_products'));             	          
	          
	    } else {
	      //$data['success'] = false;
	    } 
	    $this->layout = '';
	    $this->autoRender = false;
      $this->render('admin_product_group_list', 'ajax',ELEMENTS.'/admin_product_group_list.ctp');
	   // $this->sendJson($data);
	    	    
	}
	
	function admin_remove_product_from_group($group_id,$product_id) {
	      
	    
	     if (!empty($group_id) && !empty($product_id))  {
	       
	         $record = $this->ProductGroup->ProductsInGroup->find('first',array('conditions' => array('product_id' => $product_id , 'product_group_id' => $group_id)));
	         
	          if (!empty($record) && is_array($record)) {
              // $this->ProductGroup->ProductsInGroup->create();
               $this->ProductGroup->ProductsInGroup->delete($record['ProductsInGroup']['id']);
            } else {
              $this->set('error','Record does not exists');
            }
            $product_group = $this->ProductGroup->read(null, $group_id);
            $group_products = array();
            if (isset($product_group['ProductsInGroup']) && !empty($product_group['ProductsInGroup'])) {
                  foreach($product_group['ProductsInGroup'] as $val) {
                      $product_in_groups[] = $val['product_id'];
                  }
                  
                   $group_products = $this->ProductGroup->Shop->Product->find('all', array('conditions' => array('Product.visible' => 1,'Product.id' => $product_in_groups), 'contain' => array('ProductImage')));
             }
           
           
            
            $product_group_id = $group_id;
            $this->set(compact('product_group_id','group_products')); 	         	          
	    } 
	    
	    $this->layout = '';
	    $this->autoRender = false;
      $this->render('admin_product_group_list', 'ajax',ELEMENTS.'/admin_product_group_list.ctp');
	   	    	    
	}
	/**
     * Function to send json response. This function is generally used when an ajax request is made
     *
     * @param array   $data        Data to be sent in json response
     * @param boolean $jsonHeaders Whether to include json header or not
     *
     * @return void
     */
   /* function sendJson($data, $jsonHeaders = true)
    {
        // Set the data for view
        $this->set('data', $data);
        $this->set('json_headers', $jsonHeaders);
        // We will use no layout
        $this->layout = '';
        // Render the json view
        $this->render(null, null, VIEWS . 'elements' . DS . 'json.ctp');
   }//end sendJson() */
    
    
	function admin_edit_custom($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid product group', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			// set the type to custom
			$this->data['ProductGroup']['type'] = 0;
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The product group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGroup->read(null, $id);
		}
		
		 $this->ProductGroup->recurive = 3;
    
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

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for product group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductGroup->delete($id)) {
			$this->Session->setFlash(__('Product group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Product group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_toggle($id = false) {
		
		$result = $this->ProductGroup->toggle($id, 'visible');
		
		if ($this->params['isAjax']) {
			
			$this->layout = 'json';
			if ($result) {
				
				$successJSON  = true;
				$this->set(compact('successJSON'));
				$this->render('../json/empty');
			} else {
				$errors = $this->ProductGroup->validationErrors;
				$successJSON  = false;
				
				$this->set(compact('successJSON', 'errors'));
				$this->render('../json/error');
			}
				
		} else {
			if ($result) {
				$this->Session->setFlash(__('Collection status has been changed', true), 'default', array('class'=>'flash_success'));
			} else {
				$this->Session->setFlash(__('Collection status could not be changed. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}


}//end class
