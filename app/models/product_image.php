<?php
class ProductImage extends AppModel {

	var $name = 'ProductImage';

	/**
	 *
	 * @var string Fieldname used in datatable to store filename of image.
	 *
	 * set this variable to work in conjunction with MeioUpload and Product model
	 **/
	var $defaultNameForImage = 'filename';

	var $actsAs = array(
		// for uploading of image,
		'MeioDuplicate.MeioDuplicate' => array(
			'filename' => array(
				'thumbsizes' => array(
					'small'  => array('width'=>60, 'height'=>60),
					'large'  => array('width'=>800, 'height'=>400),
					'shop'  => array('width'=>265, 'height'=>265)
				),
				'dir' => 'uploads{DS}products',
				'default' => 'default.jpg', /*  if the field is left blank,
							       like a default picture for users who don’t have one,
							       set this option to the name of this file.
							       Make sure it is inside the folder specified in the ‘dir’ option.*/

			)
		),

		// to make it easy for pagination of products,
		// we use Linkable and grab 1 product and its 1 cover image
		'Linkable.Linkable'
	);

	/**
	 * @var int Recursive level for ProductImage
	 *
	 * to make it easy for pagination of products,
	 * we use Linkable and hence set this to -1
	  */
	var $recursive = -1;

	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true,
		)
	);
	
	// this is to deal with obnoxious behavior of uploadify that treats all files as application/octet-stream
	function uploadifySave($data) {
		if (isset($data['ProductImage']['filename']) && is_array($data['ProductImage']['filename'])) {
			$data['ProductImage']['filename'] = $this->convertTypeBasedOnExtension($data['ProductImage']['filename']);
		}
		
		return $this->save($data);
	}

	function change_active_status($id = false) {
		if (!$id) {
			if (!$this->id) {
				return false;
			}
			$id = $this->id;
		}

		return $this->updateAll(
			// fields to change
			 array('ProductImage.status' => '!ProductImage.status'),
			 // conditions
			 array('ProductImage.id' => $id)
			 );


	}
	
	function make_this_cover($id = null, $product_id = null) {
		if (!$id) {
			if (!$this->id) {
				return false;
			}
			$id = $this->id;
		}
		
		if (!$product_id) {
			$data = $this->read(null, $id);
			$product_id = $data['ProductImage']['product_id'];
		}
		
		$result = $this->updateAll(
			// fields to change
			 array('ProductImage.cover' => true),
			 // conditions
			 array('ProductImage.id' => $id,
			       'ProductImage.product_id' => $product_id)
			 );
		
		if ($result) {
			$result = $this->updateAll(
			// fields to change
			 array('ProductImage.cover' => intval(false)),
			 // conditions
			 array('ProductImage.id != ' => $id,
			       'ProductImage.product_id' => $product_id)
			 );
			
		}
		
		return $result;
	}
	
        function createMultipleForExistingProduct($data = null, $product_id = null, $count = 0) {
		if ($count == 0) {
			$count = $this->find('count', array(
				'conditions' => array('ProductImage.product_id' => $product_id,
						      'ProductImage.cover' => true),
				'fields' =>'ProductImage.id',
			));	
		}
                
                
		if (!empty($data['ProductImage']) AND is_array($data['ProductImage'])) {
			$firstValidImage = ($count == 0) ? true : false;
                        
			foreach ($data['ProductImage'] as $key => $value) {
                                
				if (is_array($value) AND ($value[$this->defaultNameForImage]['error'] === UPLOAD_ERR_NO_FILE)) {
					unset($data['ProductImage'][$key]);
				} elseif ($firstValidImage) {
					// we make the first image for this new product its default cover
					$data['ProductImage'][$key]['cover'] = true;
					$firstValidImage                     = false;
				}
			}

			if (empty($data['ProductImage'])) {
				unset($data['ProductImage']);
			}
		}
                
		
        
                $result = true;
                foreach ($data['ProductImage'] as $key => $value) {
			if (is_numeric($key)) {
				
				$value['filename'] = $this->convertTypeBasedOnExtension($value['filename']);
			
				$this->create();
				$value['product_id'] = $product_id;
				if ($this->save($value)) {
					
					$result = true;
					continue;
				} else {
					
					$result = false;
					break;
				}
			}
        
                }

                return $result;
		

	}
	
	function convertTypeBasedOnExtension($file) {
		
		$types = array('.jpg' =>'image/jpeg',
			       '.jpeg' =>'image/pjpeg',
			       '.png' =>'image/png',
			       '.gif' =>'image/gif',
			       '.bmp' =>'image/bmp',
			       '.ico' => 'image/vnd.microsoft.icon'
				);
		if (is_array($file) && isset($file['name']) && isset($file['type'])) {
			if ($file['type'] == 'application/octet-stream') {
				$parts = pathinfo($file['name']);
				$extension = strtolower('.'.$parts['extension']);
				if (array_key_exists($extension, $types)) {
					$file['type'] = $types[$extension];
				}
 
			}
			
		}
		
		return $file;
	}


}
?>