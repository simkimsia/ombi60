<?php
	if (isset($product['ProductImage']['filename'])) {
		echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $product['ProductImage']['filename'],
								      array('alt'=>$productTitle,
									    'height'=>$height,
									    'width'=>$width));	
	} else {
		echo $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . 'dummy.jpg',
								      array('alt'=>$productTitle,
									    'height'=>$height,
									    'width'=>$width));	
	}
 ?>