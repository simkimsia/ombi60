<?php
class SavedThemesController extends AppController {

	var $name = 'SavedThemes';
	
	var $helpers = array('Javascript', 'Ajax');
	
	function beforeFilter() {
		
		/*
		//public & private keys for reCAPTCHA
		$this->Recaptcha->publickey = ""; 
		$this->Recaptcha->privatekey = "";
		*/
		
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();

		/**
		 * because of Auth default settings do not work for Merchant, hence alot of fields need to be overridden.
		 **/
		
		if ($this->action == 'admin_add' OR $this->action == 'admin_edit') {
			$this->Security->disabledFields[] = 'SavedTheme.cssName';
		}

		// allow non users to access register and login actions only.
		//$this->Auth->allow('admin_settings');
		
		if ($this->action == 'admin_add') {
			$this->Security->validatePost = false;
		}
	
	}


	function admin_index() {
		$this->SavedTheme->recursive = -1;
		
		$limit = 4;
		$shopId = User::get('Merchant.shop_id');
		
		$this->paginate = array(
			      'conditions' => array('SavedTheme.shop_id' => $shopId),
			      'limit' => $limit,
			      'order' => 'SavedTheme.featured desc'
			      );
	
		$this->set('savedThemes', $this->paginate());
		
		if ($this->params['isAjax']) {
			$this->layout = 'ajax';
			$this->render('themes_ajax_list');
		} else {
			// assuming this is normal GET request. we need to retrieve TOTAL themes
			$themesTotal =  $this->SavedTheme->find('count',
								array('conditions' => array('SavedTheme.shop_id' => $shopId)));
			$this->set(compact('limit', 'themesTotal'));
		}
		
		
		//$this->render('/themes/admin_index');
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid saved theme', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('savedTheme', $this->SavedTheme->read(null, $id));
	}
	
	/**
	 * under no circumstances must this work around be used
	 * unless it is for ajax admin_add
	 * */
	private function addDummyCss($data) {
		if ($data['SavedTheme']['cssName'] == 'submittedfile') {
			$data['SavedTheme']['cssName'] = 'css';
			$data['SavedTheme']['css'] = '/*dummy css*/';
		}
		
		return $data;
	}

	function admin_add() {
		
		// for handling ajax request.
		// usually because of the need to upload images using uploadify hence
		// we need ajax to first create the Saved Theme in order to have a proper folder
		// for uploadify to upload the pics to
		if ($this->params['isAjax']) {
			
			$this->layout = 'json';
			$successJSON = false;
			$contents = array();
			
			/**
			 * workaround to allow ajax to bypass stringent validations
			 * since ajaxhelper does NOT work with multipart file upload
			 **/
			if ($this->RequestHandler->isAjax()) {
				$this->data = $this->addDummyCss($this->data);
			}
			
			$this->SavedTheme->create();
			if ($this->SavedTheme->save($this->data)) {
				$this->Session->setFlash(__('The saved theme has been saved', true), 'default', array('class'=>'flash_success'));
				
				$successJSON = true;
				$contents = array('folder_name' => Shop::get('Shop.id') . '_' . $this->data['SavedTheme']['name'],
						       'id' => $this->SavedTheme->id);
				
				
			} else {
				$this->SavedTheme->deleteThemeFolderAfterFailSave($this->data['SavedTheme']['name']);
				$this->Session->setFlash(__('The saved theme could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
				
				$contents['reason'] = $this->SavedTheme->validationErrors;
			}
			
			$this->set(compact('contents', 'successJSON'));
			$this->render('json/response');
			
		// this handles all the normal form submission
		// When there is NO images, just a normal POST will create the Saved Theme
		// When there ARE images, this will be activated at the very last step to upload the
		// css file OR simply to redirect back to the index page
		} else if ($this->RequestHandler->isPost()) {
			$uploadifyUsed = ($this->data['SavedTheme']['alt_id'] > 0);
			
			$turnedOn = $this->data['SavedTheme']['cssName'];
			$submittedFile = $this->data['SavedTheme']['submittedfile'];
			
			$cssFileUsed = isset($submittedFile) &&
					isset($submittedFile['error']) &&
					($submittedFile['error'] == 0) && ($turnedOn = 'submittedfile');
					
			$cssCodeUsed = !$cssFileUsed;
					
			if ($uploadifyUsed AND $cssFileUsed) {
				$this->data['SavedTheme']['id'] = $this->data['SavedTheme']['alt_id'];
				
				if ($this->SavedTheme->save($this->data)) {
					$this->Session->setFlash(__('The saved theme has been saved', true), 'default', array('class'=>'flash_success'));
				} else {
					$errMsg = 'Error with your css file.';
					foreach ($this->SavedTheme->validationErrors as $field=>$errorMsg) {
						$errMsg = $errorMsg;
					}
					$link = Router::url(array('controller'=>'saved_themes', 'action'=>'edit', 'admin'=>true, $this->SavedTheme->id));
					$msg = $errMsg . ' Edit your css <a href="'.$link.'">here</a>';
					$this->Session->setFlash(__($msg, true), 'default', array('class'=>'flash_failure'));
				}
				
				$this->redirect(array('action' => 'index'));
				
			} else if ($uploadifyUsed AND $cssCodeUsed) {
				$this->Session->setFlash(__('The saved theme has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->SavedTheme->create();	
			}
			
			if ($this->SavedTheme->save($this->data)) {
				$this->Session->setFlash(__('The saved theme has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
				
			} else {
				
				$this->SavedTheme->deleteThemeFolderAfterFailSave($this->data['SavedTheme']['name']);
				$this->Session->setFlash(__('The saved theme could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
				
			}
			
		}
		
		$shops = $this->SavedTheme->Shop->find('list');
		$themes = $this->SavedTheme->Theme->find('list');
		
		$uploadifySettings = array('browseButtonId' => 'fileInput',
					   'script' => Router::url('/admin/saved_themes/upload', true),
					   'onAllComplete' => true);
		
		$this->set(compact('shops', 'themes', 'uploadifySettings'));
		
	}
	
	/**
	 * should be called by ONLY uploadify plugin
	 **/
	function admin_upload() {
		
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			
			$targetFile = $this->SavedTheme->constructImagePath($_REQUEST['folder'], $_FILES['Filedata']['name']);
			
			$file = new File($targetFile, true, 0755);
			
			$folder = new Folder();
			$folder->chmod($this->SavedTheme->constructImagePath($_REQUEST['folder']), 0755);
			
			
			$result = $this->SavedTheme->copyFileFromTemp($tempFile, $targetFile);
			
			echo "1";
		
		}
		
		$this->autoRender = false;
	}

	function admin_edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid saved theme', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		
		//to change name and description
		if (!empty($this->data)) {
			
			$this->data['SavedTheme']['skipCssCheck'] = true;
			if ($this->SavedTheme->save($this->data)) {
				$this->Session->setFlash(__('The saved theme has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->SavedTheme->revertFolderNameAfterUnsuccessfulUpdate();
				$this->Session->setFlash(__('The saved theme could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		} else if ($this->RequestHandler->isGet()) {
			$this->data = $this->SavedTheme->read(null, $id);
		}
		
		$folder_name = $this->data['SavedTheme']['folder_name'];
		
		$images = $this->SavedTheme->fetchImages($this->data['SavedTheme']['folder_name']);
		
		$uploadifySettings = array('browseButtonId' => 'fileInput',
					   'script' => Router::url('/admin/saved_themes/upload', true),
					   'auto' => true,
					   'folder' => '/'.$folder_name,
					   'onComplete' => true,
					   'onAllComplete' => true);
		
		$this->set(compact('images', 'folder_name', 'id',
				   'uploadifySettings'));
	}

	function admin_delete($id = null) {
		$contents = array();
		if ($this->params['isAjax']) {
			$this->layout = 'json';
			$successJSON = false;
		}
		
		if (!$id) {
			if ($this->params['isAjax']) {
				$contents['reason'] = __('Invalid id for saved theme', true);
			} else {
				$this->Session->setFlash(__('Invalid id for saved theme', true), 'default', array('class'=>'flash_failure'));
				$this->redirect(array('action'=>'index'));	
			}
		}
		
		
		if ($this->SavedTheme->delete($id)) {
			if ($this->params['isAjax']) {
				$successJSON = true;
				$contents['id'] = $id;
			} else {
				$this->Session->setFlash(__('Saved theme deleted', true), 'default', array('class'=>'flash_failure'));
				$this->redirect(array('action'=>'index'));	
			}
		} else {
			if ($this->params['isAjax']) {
				$contents['reason'] = __('Saved theme was not deleted', true);
			} else {
				$this->Session->setFlash(__('Saved theme was not deleted', true), 'default', array('class'=>'flash_failure'));
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$this->set(compact('contents', 'successJSON'));
		$this->render('json/response');
		
	}
	
	function admin_edit_image($id = null, $folder_name, $image) {
		if ($this->RequestHandler->isGet()) {
			
			
			$this->layout = 'overlay-form';
			$imageUrl =   '../theme/' . $folder_name . '/img/' . $image;
			
			$this->set(compact('folder_name', 'image', 'imageUrl', 'id'));
			
		} else if ($this->RequestHandler->isPost()) {
			
			$path = VIEWS . 'themed' . DS . $folder_name . DS . 'webroot' . DS . 'img' . DS;
			$newImage = $this->data['Image']['name'];
			if (strcasecmp($newImage, $image)!= 0) {
				// copy file
				$file = new File($path . $image);
				$dest = $path . $newImage;
				$ok = $file->copy($dest);
				// delete original file when successfully renamed it
				if ($ok) {
					$file->delete();
				}
			}
			$this->redirect(array('action'=>'edit', 'admin'=>true,$id));
			
		}
		
	}
	
	function admin_feature($id = null) {
			
		if (!$id) {
			
			$this->Session->setFlash(__('Invalid id for saved theme', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action'=>'index'));	
			
		}
		
		
		if ($this->SavedTheme->feature($id)) {
			$this->Session->setFlash(__('Theme For Shopfront changed', true), 'default', array('class'=>'flash_success'));
			$this->redirect(array('action'=>'index'));	
			
		} else {
			
			$this->Session->setFlash(__('Theme For Shopfront NOT changed', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
			
		}
		
	}
	
	function admin_delete_image($id = null, $folder_name, $image) {
			
		if ($this->RequestHandler->isGet()) {
			
			$path = VIEWS . 'themed' . DS . $folder_name . DS . 'webroot' . DS . 'img' . DS;
			
			// find file
			$file = new File($path . $image);
			$file->delete();
			
		}
		$this->redirect(array('action'=>'edit', 'admin'=>true,$id));
	}
	
	function admin_edit_css($id = null, $folder_name) {
		$path = VIEWS . 'themed' . DS . $folder_name . DS . 'webroot' . DS . 'css' . DS . 'style.css';
		$file = new File($path);
		
		if ($this->RequestHandler->isGet()) {
			
			$this->layout = 'overlay-form';
			
			$contents = $file->read();
			
			
			$this->set(compact('folder_name', 'id', 'contents'));
			
		} else if ($this->RequestHandler->isPost()) {
			
			$newContent = $this->data['Css']['contents'];
			
			$file->write($newContent);
				
			
			$this->redirect(array('action'=>'edit', 'admin'=>true,$id));
			
		}
		
	}
}
?>