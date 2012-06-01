<?php
class ProductImage extends AppModel {

	public $name = 'ProductImage';

	/**
	 *
	 * @var string Fieldname used in datatable to store filename of image.
	 *
	 * set this variable to work in conjunction with MeioUpload and Product model
	 **/
	public $defaultNameForImage = 'filename';

	public $actsAs = array(
		// for uploading of image,
		'MeioDuplicate.MeioDuplicate' => array(
			'filename' => array(
				'thumbsizes' => array(
					'icon'  => array('width'=>32, 'height'=>32),
					'thumb'  => array('width'=>50, 'height'=>50),
					'small'  => array('width'=>100, 'height'=>100),
					'medium'  => array('width'=>240, 'height'=>240),
					'large'  => array('width'=>480, 'height'=>480),
				),
				'dir' => 'uploads{DS}products',
				'default' => 'default.jpg', /*  if the field is left blank,
							       like a default picture for users who don�t have one,
							       set this option to the name of this file.
							       Make sure it is inside the folder specified in the �dir� option.*/

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
	public $recursive = -1;

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true,
		)
	);
	
	public function chooseAsCoverImage($id = null, $product_id = null) {
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
	
     	public function createMultipleForExistingProduct($data = null, $product_id = null, $count = 0) {
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
	
	public function convertTypeBasedOnExtension($file) {
		
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
	
	/**
	 * @param int $product_id the id of the product which we are going to save
	 * these images to
	 * @param boolean $brandNewProductCreated Set as true if this product associated with
	 * the images is a newly created product. This is so that the first file is automatically set as cover
	 **/
	public function saveFILESAsProductImages($product_id, $brandNewProductCreated = true) {
		$this->log('1');
		if (!empty($_FILES)) {
			$tmp = array();		
			foreach ($_FILES['product_images'] as $key => $valueArray) {
				$i=0;
				foreach ($valueArray as $value) {
					//Only consider first 4 photos
					if ($i < 4) {
						$tmp[$i][$key] = $value;
						$i++;
					}
				}
			}    
			
			$allowedExtensions 	= array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico');
			$i 					= 0;
			
			foreach ($tmp as $tempFile) {

				$name 	= $tempFile['name'];
				$str 	= strtolower(substr(strrchr($tempFile['name'], '.'), 1));
				
				if (in_array($str, $allowedExtensions)) {
					
					$this->create();
					$data = array('ProductImage'=>array('filename'=>$tempFile,
								'product_id' => $product_id,));

					$result = $this->save($data);   
					
					if ($result != false && $i++ == 0 && $brandNewProductCreated) {
						$this->chooseAsCoverImage($this->id, $product_id);
					}    
				}
			}
			
		  }
	}//end saveFILESAsProductImages()


}
?>