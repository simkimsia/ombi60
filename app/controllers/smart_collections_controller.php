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

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }
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
  }
  
}//end class