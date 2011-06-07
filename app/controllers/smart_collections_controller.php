<?php
class SmartCollectionsController extends AppController {
  
  /**
   * This variable specifies the name of controller
   */
  var $name = "SmartCollections";
  
  var $helpers = array('Javascript',
           'Ajax',
           'TinyMce.TinyMce');
  /**
   * This action is executed all before any other action is executed
   */
  public function beforeFilter() {
  
    // call the AppController beforeFilter method after all the $this->Auth settings have been changed.
    parent::beforeFilter();
    $this->Auth->allow($this->action);  
    Configure::write('debug', 2);
    if ($this->action == 'admin_toggle') {
      $this->Security->enabled = false;
    }
  }//end beforeFilter()

  
  /**
   * This action is used to add smart collections
   */
  public function admin_add() {
    //First we check whether data is posted?    
    if (!empty($this->data)) {
      $i = 0;
      foreach ($_POST['fields'] as $field) {
        $this->data['SmartCollectionCondition'][$i]['field'] = $field;
        $i++;
      }
      $i = 0;
      foreach ($_POST['relations'] as $relation) {
        $this->data['SmartCollectionCondition'][$i]['relation'] = $relation;
        $i++;
      }
      $i = 0;
      foreach ($_POST['conditions'] as $condition) {
        $this->data['SmartCollectionCondition'][$i]['condition'] = $condition;
        $i++;
      }
      if ($this->SmartCollection->saveSmartCollection($this->data)) {
        $this->redirect(array(
                         'controller' => 'product_groups',
                         'admin'      => true,
                         'action'     => 'index',
                        ));
      }
    }
  }//end admin_add


  function admin_edit($id = null) {    
    if (!$id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }
    if (!empty($this->data)) {
      if ($this->SmartCollection->save($this->data)) {
        $this->redirect(array('action' => 'view', $id));
      }
    }
    $this->data = $this->SmartCollection->read(null, $id);
    //$this->__getSmartCollection($id);
    //$this->set('view', true);
  }//end admin_edit()


  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }
    $this->__getSmartCollection($id);
    $this->set('view', true);
  }//end admin_view()


  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }
    if ($this->SmartCollection->delete($id)) {
      $this->Session->setFlash(__('Smart collection deleted successfully', true));
      $this->redirect(array('controller' => 'product_groups', 'action' => 'index'));
    }
  }//end admin_view()

  
  function admin_remove_condition($condition_id = null, $smart_collection_id = null) {
    if (!$condition_id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }

    if ($this->SmartCollection->SmartCollectionCondition->delete($condition_id)) {
      $this->layout = 'ajax';
      $this->__getSmartCollection($smart_collection_id);
      $this->render('/elements/admin_smart_collection_products');
    }
    die;
  }//end admin_remove_condition()

  function admin_save_condition() {
    $i = 0;
    foreach ($_POST['fields'] as $field) {
      $this->data['SmartCollectionCondition'][$i]['field'] = $field;
      $i++;
    }
    $i = 0;
    foreach ($_POST['relations'] as $relation) {
      $this->data['SmartCollectionCondition'][$i]['relation'] = $relation;
      $i++;
    }
    $i = 0;
    foreach ($_POST['conditions'] as $condition) {
      $this->data['SmartCollectionCondition'][$i]['condition'] = $condition;
      $i++;
    } 
    $smart_collection_id = $_POST['smart_collection_id'];
    if ($this->SmartCollection->saveSmartCollectionCondition($this->data, $smart_collection_id)) {
      if ($this->RequestHandler->isAjax()) {
        $this->layout = 'ajax';
      }
      $this->__getSmartCollection($smart_collection_id);
      $this->render('/elements/admin_smart_collection_products');
    }
    //die;
  }


  function __getSmartCollection($id) {
    $smart_collection = $this->SmartCollection->read(null, $id);
    $ids = array();
    foreach ($smart_collection['SmartCollectionCondition'] as $smart_collection_condition) {
      $smart_products    = ClassRegistry::init('Product')->conditionalProducts($smart_collection_condition);
      $smart_product_ids = Set::extract('{n}.Product.id', $smart_products);
      
      foreach ($smart_product_ids as $smart_product_id) {
        array_push($ids, $smart_product_id);
      }
    }
    $product_ids = array_unique($ids);
    $shopId = Shop::get('Shop.id');
    $conditions  = array(
                    'Product.id'      => $product_ids,
                    'Product.shop_id' => $shopId,
                   );
  
    $products = ClassRegistry::init('Product')->find('all', array('conditions' => $conditions, 'contain' => 'ProductImage'));
    $this->set(compact('smart_collection', 'products'));
  }//end __getSmartCollection()
  
}//end class