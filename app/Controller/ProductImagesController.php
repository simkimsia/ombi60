<?php
class ProductImagesController extends AppController {

	var $name = 'ProductImages';

	var $helpers = array('Html', 'Form', 'Session');

	var $components = array(
				'Auth',
				'Acl',
				'Session',
				'Security',
				'RequestHandler', );

	function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		// this is to allow the jquery to change the elements that control the file upload.
		$image = $this->ProductImage;
		
		$this->Security->disabledFields[] = $image->name . '.' . $image->defaultNameForImage;
		
	}
	
	private function redirectToProductEdit($product_id = null) {
		if (!$product_id) {
			$this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('controller' => 'products',
					 'action' => 'edit',
					 'admin' => true,
					 $product_id,
					 '#' => 'images'
					));
	}

	
	function admin_add() {

		if (!empty($this->request->data)) {
			$this->ProductImage->create();		

			if ($this->ProductImage->createMultipleForExistingProduct($this->request->data)) {
				$this->Session->setFlash(__('Image has been saved'));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Image could not be saved. Please, try again.'));
			}
		}
		
		
	}
	
	function admin_add_by_product($product_id = null) {

		if (!empty($this->request->data) AND $product_id) {
			
			$imagesCount = isset($this->request->data['ProductImage']['imagesCount']) ? $this->request->data['ProductImage']['imagesCount'] : 0;
			
			if ($this->ProductImage->createMultipleForExistingProduct($this->request->data, $product_id, $imagesCount)) {
				$this->Session->setFlash(__('Image has been saved'));
				$this->redirectToProductEdit($product_id);
			} else {
				$this->Session->setFlash(__('Image could not be saved. Please, try again.'));
			}
		}
		
		
	}
	
	
	function admin_uploadify() {

		$data = array('ProductImage' => array('0'=>array('filename'=>array())));
		
		$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
		$count = isset($_POST['count']) ? $_POST['count'] : 0;

	
		if (!empty($_FILES) AND $product_id != null) {
			$data['ProductImage'][0]['filename'] = $_FILES['Filedata'];
			if ($this->ProductImage->createMultipleForExistingProduct($data, $product_id, $count)) {
				echo "1";
			} 
		}
		
		$this->autoRender = false;
		
	}

	function admin_list_by_product($product_id = null) {

		if (!($product_id > 0)) {
			$this->Session->setFlash(__('Invalid url'));
			$this->redirect(array('action' => 'index', 'controller' => 'products', 'admin' => true));
		}
		// to make paging easier to test, we set as 1 per page.
		$this->paginate = array('limit'=>'3');

		$this->set('product_id', $product_id);

		$this->set('productImages', $this->paginate('ProductImage', array('ProductImage.product_id'=>$product_id)));
		
		$this->set('errors', array());
		
		if ($this->request->is('ajax') == false) {
			// standard view to render
			$this->render('admin_list_by_product');
		} else {
			// must be Ajax request so we only fetch the form and nothing else.
			$this->render('admin_list_by_product_only');
		}

	}




	function admin_delete($id = null, $product_id = null) {
		
		$successJSON = false;
		$contents = array();
		
		if ($this->request->params['isAjax']) {
			$this->layout = 'json';
		}
		
		if ($id == null OR $product_id == null) {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Invalid id for image');
			} else {
				$this->Session->setFlash(__('Invalid id for image'));
				$this->redirect(array('action'=>'index'));	
			}
		}
		
		if ($this->ProductImage->delete($id)) {
			if ($this->request->params['isAjax']) {
				$successJSON = true;
				$contents['id'] = $id;
				
			} else {
				$this->Session->setFlash(__('Image deleted'));
				$this->redirectToProductEdit($product_id);	
			}
		} else {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Image was not deleted');
			} else {
				$this->Session->setFlash(__('Image was not deleted'));
				$this->redirectToProductEdit($product_id);
			}
		}
		$this->set(compact('contents', 'successJSON'));
		$this->render('json/response');
	}
	
	function admin_make_this_cover($id = null, $product_id = null) {
		if ($this->request->params['isAjax']) {
			$this->layout = false;
		}
		if (!$id OR !$product_id) {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Invalid id for image');
			} else {
				$this->Session->setFlash(__('Invalid id for image'));
				$this->redirectToProductEdit($product_id);
			}
		}
		  
		if ($this->ProductImage->chooseAsCoverImage($id, $product_id)) {
			if ($this->request->params['isAjax']) {
				// the images list related code
				// to make paging easier to test, we set as 1 per page.
				$this->paginate = array('conditions'=>array('ProductImage.product_id'=>$product_id),
				      'order' => 'ProductImage.cover desc',
				      'limit'=>'10');
			  
				$productImages = $this->paginate('ProductImage');
				$this->set(compact('productImages'));
				$this->render('/elements/product_images_ajax_list');
			  
			} else {
				$this->Session->setFlash(__('Image status changed'));
				$this->redirectToProductEdit($product_id); 
			}
					  
		} else {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Image was not deleted');
			} else {
				$this->Session->setFlash(__('Image was not deleted'));
				$this->redirectToProductEdit($product_id);
			}
		}
		      
	}


	function admin_ajax_product_image_upload($product_id = null, $edit = null) {
		if (!$product_id) {
			return false;
		}

		$this->layout = false;
		$makeCoverAjax = true;
		$this->ProductImage->saveFILESAsProductImages($product_id, $edit);

		// the images list related code
		// to make paging easier to test, we set as 1 per page.
		$this->paginate = array('conditions'=>array('ProductImage.product_id'=>$product_id),
		      'order' => 'ProductImage.cover desc',
		      'limit'=>'10');
    
		$productImages = $this->paginate('ProductImage');
		$this->set(compact('productImages', 'product_id', 'edit'));
	}


	function admin_delete_me($id = null, $product_id = null) {
		if ($this->request->params['isAjax']) {
			$this->layout = false;
		}
		if (!$id OR !$product_id) {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Invalid id for image');
			} else {
				$this->Session->setFlash(__('Invalid id for image'));
				$this->redirect(array('action'=>'index'));  
			}
		}
      
		if ($this->ProductImage->delete($id)) {
			if ($this->request->params['isAjax']) {
				// the images list related code
				// to make paging easier to test, we set as 1 per page.
				$this->paginate = array('conditions'=>array('ProductImage.product_id'=>$product_id),
				      'order' => 'ProductImage.cover desc',
				      'limit'=>'10');
		    
				$productImages = $this->paginate('ProductImage');
				$this->set(compact('productImages'));
				$this->render('/elements/product_images_ajax_list');
		    
			} else {
				$this->Session->setFlash(__('Image status changed'));
				$this->redirectToProductEdit($product_id); 
			}
		  
		} else {
			if ($this->request->params['isAjax']) {
				$contents['reason'] = __('Image was not deleted');
			} else {
				$this->Session->setFlash(__('Image was not deleted'));
				$this->redirectToProductEdit($product_id);
			}
		}
	}

}
?>