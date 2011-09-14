<?php
class ProductsInGroup extends AppModel {
	public $name = 'ProductsInGroup';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductGroup' => array(
			'className' => 'ProductGroup',
			'foreignKey' => 'product_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  
  /**
   * This action is used to get the list of custome collection for this product id
   * @param integer $productId Product Id
   */
  function getProductCustomCollection($productId) {
    $shopId = Shop::get('Shop.id');
    $customCollectionsOption = array(
                                'conditions' => array(
                                                'ProductsInGroup.product_id' => $productId,
                                                ),
                                'contain'    => array(
                                                 'ProductGroup' => array(
                                                                    'conditions' => array(
                                                                                    'ProductGroup.shop_id' => $shopId,
                                                                                    ),
                                                                  ),
                                                ),
                                'fields'     => array(
                                                 'ProductGroup.id',
                                                 'ProductGroup.title',
                                                ),
                               );
    return $this->find('all', $customCollectionsOption);
  }//end getProductCustomCollection()


}//end class