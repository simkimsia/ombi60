<?php
class SmartCollection extends AppModel {

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
  }

}//end class