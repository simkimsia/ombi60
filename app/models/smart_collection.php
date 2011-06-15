<?php
class SmartCollection extends AppModel
{
  var $name = 'SmartCollection';

  var $validate = array(
                   'title' => array('notempty'),
                  );

  //The Associations below have been created with all possible keys, those that are not needed can be removed
  var $hasMany = array(
                  'SmartCollectionCondition' => array(
                                                 'className'    => 'SmartCollectionCondition',
                                                 'foreignKey'   => 'smart_collection_id',
                                                 'dependent'    => false,
                                                 'conditions'   => '',
                                                 'fields'       => '',
                                                 'order'        => '',
                                                 'limit'        => '',
                                                 'offset'       => '',
                                                 'exclusive'    => '',
                                                 'finderQuery'  => '',
                                                 'counterQuery' => '',
                                                ),
                 );

    /**
    * This action is used to save the smart collection
    * 
    * @param array   $data array of data
    * 
    * @return boolean true on successfull execution and false in failure
    */
  public function saveSmartCollection($data) {
    //First create an empty row in smart_collections table
    $this->create();
    //Save posted data in smart_collections table
    if ($this->save($data)) {
      //Get the last inserted id
      $smart_collection_id = $this->getLastInsertID();
      //Check if last smart collection conditions are set

      if (!empty($data['SmartCollectionCondition']) && is_array($data['SmartCollectionCondition'])) {
        if (!$this->__validateSmartCollectionCondition($data['SmartCollectionCondition'])) {
          return false;
        }
        //
        foreach ($data['SmartCollectionCondition'] as $smartCollectionCondtion) {
          //Set smart collection id to array
          $smartCollectionCondtion['smart_collection_id'] = $smart_collection_id;
          $this->SmartCollectionCondition->create();
          if ($this->SmartCollectionCondition->save($smartCollectionCondtion)) {
            //Select all the products with condition selected
            //get products from product model
            //ClassRegistry::init('Product')->conditionalProducts($smartCollectionCondtion);
          }
        }
      }
      return true;
    }
    return false;
  }//end saveSmartCollection()


  /**
    * This function is used to save smart collection condition
    * 
    * @param array   $data array of data
    * @param integer $smart_collection_id Smart Collection Id
    * 
    * @return boolean true on successfull execution and false in failure
    */
  function saveSmartCollectionCondition($data, $smart_collection_id = null) {
    $error = false;
    if (!empty($data['SmartCollectionCondition']) && is_array($data['SmartCollectionCondition'])) {
      if (!$this->__validateSmartCollectionCondition($data['SmartCollectionCondition'])) {
        return false;
      }
      //Check if rows are already present in table for smart_collection_id
  
      if ($smart_collection_id != null) {
        //Get all the records of this smart_collection_id
        $conditions        = array('SmartCollectionCondition.smart_collection_id' => $smart_collection_id);
        $fields            = array('SmartCollectionCondition.id');
        $smart_collections = $this->SmartCollectionCondition->find('all', array(
                                                                           'conditions' => $conditions, 
                                                                           'fields'     => $fields,
                                                                          ));
        $ids               = Set::extract('{n}.SmartCollectionCondition.id', $smart_collections);
        if (!empty($ids) && count($ids) > 0) {
          //Now we will delete all old ids from table
          $this->SmartCollectionCondition->deleteAll(array('SmartCollectionCondition.id' =>$ids));
        }
      }
      foreach ($data['SmartCollectionCondition'] as $smartCollectionCondtion) {
        //Set smart collection id to array
        $smartCollectionCondtion['smart_collection_id'] = $smart_collection_id;
        $this->SmartCollectionCondition->create();
        if ($this->SmartCollectionCondition->save($smartCollectionCondtion)) {
          //Select all the products with condition selected
          //get products from product model
          //ClassRegistry::init('Product')->conditionalProducts($smartCollectionCondtion);
          $error = true;
        }
      }
      return $error;
    }
    return $error;
  }//end saveSmartCollectionCondition()


  /**
    * This function is used to save smart collection condition
    * 
    * @param integer $id Smart Collection Id
    * 
    * @return boolean true on successfull execution and false in failure
    */
  public function getSmartCollectionProducts($smart_collection, $findBy = "all") {
    $tmp = $test = $products = array();
    $tmp['Product.shop_id'] = $smart_collection['SmartCollection']['shop_id'];    
    
    if (!empty($smart_collection['SmartCollectionCondition'])) {
      foreach ($smart_collection['SmartCollectionCondition'] as $smart_collection_condition) {
        $condition = ClassRegistry::init('Product')->conditionalProducts($smart_collection_condition);
        if (array_key_exists(key($condition), $tmp)) {
          $test[key($condition)][] = $tmp[key($condition)];
          $test[key($condition)][] = $condition[key($condition)];
        }
        $tmp[key($condition)] = $condition[key($condition)];
      }
      if (!empty($test)) {
        foreach ($test as $key => $value) {
          $tmp[$key] = $value;
        }
      }
      $productsOptions = array(
                          'conditions' => $tmp,
                          'contain' => 'ProductImage',
                        );
      $products = ClassRegistry::init('Product')->find($findBy, $productsOptions);

    }
    return $products;
  }//end getStartCollectionProducts()


  /**
    * This function is used to validate smart collection condition
    *
    * @return boolean true on successfull execution and false in failure
    */
  function __validateSmartCollectionCondition($data) {
    if (!empty($data) && is_array($data)) {
      foreach ($data as $value) {
        if ($value['condition'] =="" || $value['condition'] == null) {
          return false;
        }
      }
    }
    return true;
  }//end validateSmartCollectionCondition()


}//end class