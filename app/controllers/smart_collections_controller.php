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
    $this->Security->enabled = false;
    //if ($this->action == 'admin_toggle') {
    //  $this->Security->enabled = false;
    //}
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
      if ((bool)$this->SmartCollection->saveSmartCollection($this->data)) {
        $this->redirect(array(
                         'controller' => 'product_groups',
                         'admin'      => true,
                         'action'     => 'index',
                        ));
      }
    }
  }//end admin_add


  public function admin_edit($id = null) {    
//debug($this->data);exit;
    if (!$id) {
      $this->Session->setFlash(__('Invalid smart collection', true));
      $this->redirect($this->refer());
    }
    if (!empty($this->data)) {
//print_r($this->params);
      if ($this->SmartCollection->save($this->data)) {
        
      } else {
        $this->Session->setFlash(__('Unable to save smart collection', true));
      }
    }
    $this->redirect(array('action' => 'view', $id));
    //$this->data = $this->SmartCollection->read(null, $id);
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

    if ($this->SmartCollection->SmartCollectionCondition->deleteAll($condition_id)) {
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
    $this->set('view', true);
    $this->set('smart_collection_id', $smart_collection_id);
    if ($this->SmartCollection->saveSmartCollectionCondition($this->data, $smart_collection_id)) {
      if ($this->RequestHandler->isAjax()) {
        $this->layout = 'ajax';
      }
      $this->__getSmartCollection($smart_collection_id);
      //$this->render('/elements/admin_smart_collection_products');
    }
    $this->render('/elements/admin_set_smart_collection_condition');
    //die;
  }


  function __getSmartCollection($id) {
    $smart_collection = $this->SmartCollection->read(null, $id);

    $products         = $this->SmartCollection->getStartCollectionProducts($smart_collection); //Get list of all the products
     
    $this->set(compact('smart_collection', 'products'));
  }//end __getSmartCollection()
  
}//end class