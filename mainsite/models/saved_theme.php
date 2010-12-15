<?php
class SavedTheme extends AppModel {
	var $name = 'SavedTheme';
	var $displayField = 'name';
	
	var $maxSizeOfCss = 2097152;
	
	var $folderPath = '';
	
	var $sourceFolderName = '';
	
	var $failedUploadedImages = array();
	
	var $successUploadedImages = array();
	
	var $actsAs = array('ThemeFolder.ThemeFolder' =>
				array('folderNameField' => 'folder_name',
				      'validateOn' => true)
			    );
	
	var $validate = array(
			      'folder_name' => array(
					'checkForExistingFolder' => array(
						'rule' => 'existFolder',
						'message' => 'Theme name is already in use',
						'on' => 'create'
							),
					'checkForExistingFolderToRename' => array(
						'rule' => 'existFolderToRename',
						'message' => 'Theme name is already in use',
						'on' => 'update'
							),
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Theme name cannot be empty',
						
							),
		
						),
			      'submittedfile' => array(
					'compulsoryCss' => array(
						'rule' => array('compulsoryCss'),
						'message' => 'Please upload a css file or enter css code',			
					),
					'validMime' => array(
						'rule' => array('uploadCheckInvalidMime'),
						'message' => 'Please ensure your css file is of the mime type text/css',			
					),
					'noErrors' => array(
						'rule' => array('uploadCheckUploadError'),
						'message' => 'There is an error in uploading. Please try again or contact administrator.',			
					),
					'sizeLimit' => array(
						'rule' => array('uploadCheckMaxSize'),
						'message' => 'Please ensure your css file is less than 2Mb',			
					),
					'validExtension' => array(
						'rule' => array('uploadCheckInvalidExt'),
						'message' => 'Please ensure your file extension is .css',			
					),
				
			      ));
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function compulsoryCss($check=array()) {
		// we ALLOW either the css file itself or the css code in textarea
		// that depends on which one was turned on.
		// if a field is turned on, and it is non empty return true
		// everything else return false
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		$turnedOn = $this->data[$this->name]['cssName'];
		
		$css 	       = $this->data[$this->name][ 'css' ];
		$submittedFile = $this->data[$this->name][ 'submittedfile' ];
		
		$success = false;
		
		if (isset($submittedFile) AND
		    isset($submittedFile['error']) AND
		    ($submittedFile['error'] == 0) AND $turnedOn = 'submittedfile') {
			
			$success = true;
		} else if (!empty($css) AND $turnedOn = 'css') {
			
			$success = true;
		}
		
		return $success;
	}
	
	private function constructCssPath($themeName) {
		return VIEWS . 'themed' . DS . $themeName . DS . 'webroot' . DS . 'css' . DS . 'style.css';
	}
	
	function constructImagePath($themeName, $imageName = '') {
		return VIEWS . 'themed' . DS . $themeName . DS . 'webroot' . DS . 'img' . DS . $imageName;
	}
	
	function existFolderToRename($check){
		if (isset($this->data['SavedTheme']['original_folder_name']) AND
		    $this->data['SavedTheme']['original_folder_name'] !=  $this->data['SavedTheme']['folder_name']) {
			return $this->existFolder($check);
		}
		return true;
		
	}
	
	function beforeValidate() {
		// now we need to set the values for fields like author, folder_name, shop_id
		if (!isset($this->data['SavedTheme']['author'])) {
			$this->data['SavedTheme']['author'] = User::get('User.full_name');	
		}
		
		if (!isset($this->data['SavedTheme']['folder_name'])) {
			$this->data['SavedTheme']['folder_name'] = (!empty($this->data['SavedTheme']['name'])) ? User::get('User.id') . '_' . $this->data['SavedTheme']['name'] : '';	
		}
		
		if(!isset($this->data['SavedTheme']['shop_id'])) {
			$this->data['SavedTheme']['shop_id'] = Shop::get('Shop.id');
		}
		
		if (isset($this->data['SavedTheme']['original_name'])) {
			$this->data['SavedTheme']['original_folder_name'] = User::get('User.id') . '_' . $this->data['SavedTheme']['original_name'];
		}
	}
	
	
	/**
	 * $options array requires theme_id, shop_id, author, user_id,
	 * */
	function saveThemeAtSignUp($options = array()) {
		$theme = ClassRegistry::init('Theme');
		
		$themeData = $theme->read(null, $options['theme_id']);
		
		$data['SavedTheme']['name'] = $themeData['Theme']['name'];
		$data['SavedTheme']['description'] = $themeData['Theme']['description'];
		$data['SavedTheme']['author'] = $options['author'];
		//$data['SavedTheme']['folder_name'] = $options['user_id'] . '_' . $themeData['Theme']['name'];
		
		// we are now going to save just 1 theme per shop like Shopify so all are called shop_id_cover e.g., 5_cover
		$data['SavedTheme']['folder_name'] = $options['shop_id'] . '_cover';
		$data['SavedTheme']['shop_id'] = $options['shop_id'];
		$data['SavedTheme']['theme_id'] = $options['theme_id'];
		$data['SavedTheme']['featured'] = true;
		
		// to prevent the beforesave function from working
		$data['SavedTheme']['skipCssCheck'] = true;
		$data['SavedTheme']['signup'] = true;
		
		
		// set the sourceFolderName, later we need it for copying over.
		$this->sourceFolderName = $themeData['Theme']['folder_name'];
		
		
		$result = $this->save($data);
		
		if ($result) {
			$this->Shop->id = $options['shop_id'];
			$this->Shop->saveField('saved_theme_id', $this->id);
		}
		
		
		return $result;
	}
	
	// this is called AFTER the SUCCESS of beforeSave in the ThemeFolder behavior
	function beforeSave() {
		
		$success = false;
		
		if (isset($this->data['SavedTheme']['signup'])) {
			if ($this->data['SavedTheme']['signup'] &&
			    $this->existFolder($this->sourceFolderName)) {
				
				
				$this->copyTheme($this->sourceFolderName);
				
			}
		}
		
		
		// mainly for update save
		// in case we need to rename the folder
		if (isset($this->data['SavedTheme']['original_folder_name']) AND
		    !empty($this->data['SavedTheme']['original_folder_name']) AND
		    $this->data['SavedTheme']['original_folder_name'] != $this->data['SavedTheme']['folder_name']) {
			
			$chmod = 0775;
			
			$success = $this->renameFolder($this->data['SavedTheme']['original_folder_name'],
							$this->data['SavedTheme']['folder_name'], $chmod);
		}
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		// we will now move the css file
		// since we have validated the css and
		// the new theme folder is presumably created by ThemeFolder or by the renameFolder method above
		
		// path of the style.css
		$cssFilePath = $this->constructCssPath($this->data['SavedTheme']['folder_name']);
		
		$file = new File($cssFilePath, true, 0775);
		
		
		// check which field we are retrieving the css code from: css textarea or css file upload
		$cssName = $this->data['SavedTheme']['cssName'];
		
		// using text from css textarea
		if ($cssName == 'css') {
			// create a file called style.css in the right folder
			// put the text into this style.css
			
			if (!empty($this->data['SavedTheme']['css'])) {
				$success = $file->write($this->data['SavedTheme']['css']);	
			}
			
			// get a boolean success
		} else if ($cssName == 'submittedfile') {
			// just save this submittedfile as style.css in the right folder
			$success = $this->copyFileFromTemp($this->data['SavedTheme']['submittedfile']['tmp_name'], $cssFilePath);
		}
		
		
		
		return $success;
	}
	
	function revertFolderNameAfterUnsuccessfulUpdate() {
		$oldThemeName = $this->data['SavedTheme']['original_name'];
		$newThemeName = $this->data['SavedTheme']['name'];
		if ($oldThemeName == null OR $newThemeName == null) {
			return false;
		}
		
		if ($oldThemeName == $newThemeName) {
			return true;
		}
		
		$success = $this->renameFolder($oldThemeName, $newThemeName, 0775);
		
		return $success;
	}
	
	function fetchImages($folder_name) {
		$path = VIEWS . 'themed' . DS . $folder_name . DS . 'webroot' . DS . 'img';
		
		$dir = new Folder($path);
		
		$images = $dir->find('.*', true);
		
		return $images;
	}
	
	
	function deleteThemeFolderAfterFailSave($themeFolderName = null) {
		
		if ($themeFolderName == null) {
			return false;
		}
		
		// because we use userid_foldername format as foldername
		$themeFolderName = User::get('User.id') . '_' . $themeFolderName;
		
		// first we ensure that this folder does NOT exist in database.
		// this is to prevent unnecessary deletion due to validation
		// this will be meant just for validation errors situation. beforeDelete method will skip this check
		
		$theme = $this->findByFolderName($themeFolderName);
		if (is_array($theme) AND !empty($theme)) {
			return false;
		}			
	
		
		$this->data = array('SavedTheme'=>array('folder_name'=>$themeFolderName));
		$success = $this->deleteFolder();
		
		
		return $success;
	}
	
	/**
	* Checks if ocurred errors in the upload.
	*
	* @param $model Object
	* @param $data Array
	* @return boolean
	*/
	function uploadCheckUploadError($data = array()) {
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		if ($this->data['SavedTheme']['cssName'] != 'submittedfile') {
			return true;
		}
		
		foreach ($data as $fieldName => $field) {
			if (!empty($field['name']) && $field['error'] > 0) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Checks if the file isn't bigger then the max file size option.
	 *
	 * @param $model Object
	 * @param $data Array
	 * @return boolean
	 * @author Vinicius Mendes
	 */
	function uploadCheckMaxSize($data = array()) {
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		if ($this->data['SavedTheme']['cssName'] != 'submittedfile') {
			return true;
		}
		foreach ($data as $fieldName => $field) {
			
			if (!empty($field['name']) && $field['size'] > $this->maxSizeOfCss) {
					
				return false;
			}
		}
		return true;
	}

	/**
	 * Checks if the file is of an allowed mime-type.
	 *
	 * @param $model Object
	 * @param $data Array
	 * @return boolean
	 * @author Vinicius Mendes
	 */
	function uploadCheckInvalidMime($data = array()) {
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		if ($this->data['SavedTheme']['cssName'] != 'submittedfile') {
			return true;
		}
		
		foreach ($data as $fieldName => $field) {
			if (!empty($field['name']) && $field['type'] != 'text/css') {
				return false;
			}
		}
		return true;
	}
	
	/**
	* Checks if the file has an allowed extension.
	*
	* @param $model Object
	* @param $data Array
	* @return boolean
	* @author Vinicius Mendes
	*/
	function uploadCheckInvalidExt($data = array()) {
		
		// this is for just admin_edit because we ONLY want to validate for name and description
		if (isset($this->data[$this->name]['skipCssCheck']) AND $this->data[$this->name]['skipCssCheck']) {
			return true;
		}
		
		if ($this->data['SavedTheme']['cssName'] != 'submittedfile') {
			return true;
		}
		
		foreach ($data as $fieldName => $field) {
		
			if (!empty($field['name'])) {
				
				$matches = 0;
				
				if (strtolower(substr($field['name'], -strlen('.css'))) == strtolower('.css')) {
					$matches++;
				}
				
				if ($matches == 0) {
					return false;
				}
				
			}
		}
		return true;
	}
	
	function copyFileFromTemp($tmpName, $saveAs, $checkForUploadedFile = true) {
		
		$results = true;
		if (!is_uploaded_file($tmpName) && $checkForUploadedFile) {
			return false;
		}
		$file = new File($tmpName, $saveAs);
		$temp = new File($saveAs, true, 0775);
		
		if (!$temp->write($file->read())) {
			$results = __d('meio_upload', 'Problems in the copy of the file.', true);
		
		}
		$file->close();
		$temp->close();
		
		return $results;
	}
	
	function read($fields = null, $id = null) {
		$data = parent::read($fields, $id);
		
		if ($id == null) {
			return $data;
		}
		
		$cssFile = new File($this->constructCssPath($data['SavedTheme']['folder_name']));
		
		$data['SavedTheme']['css'] = $cssFile->read();
		
		$data['SavedTheme']['original_name'] = $data['SavedTheme']['name'];
		
		return $data;
	}
	
	function beforeDelete($cascade) {
		// this is to remove the theme folder BEFORE we delete database entry
		// we need to first retrieve folder name
		$this->data = $this->read(null, $this->id);
		return $this->deleteFolder();
		
	}
	
	function featureNewThemeAfterDelete($id = null) {
		$featuredThemeId = Shop::get('saved_theme_id');
		$shopId = Shop::get('Shop.id');
		
		if ($featuredThemeId == $id) {
			$newId = $this->field('id', array('conditions' => array('SavedTheme.shop_id' => $shopId)));
			$this->feature($newId);
		}
		return true;
	}
	
	function feature($id = null) {
		$shopId = Shop::get('Shop.id');
		
		if (!$id) {
			if (!$this->id) {
				return false;
			}
			$id = $this->id;
		}
		$result = $this->updateAll(
			// fields to change
			 array('SavedTheme.featured' => true),
			 // conditions
			 array('SavedTheme.id' => $id,
			       'SavedTheme.shop_id' => $shopId)
			 );
		
		if ($result) {
			$result = $this->updateAll(
			// fields to change
			 array('SavedTheme.featured' => intval(false)),
			 // conditions
			 array('SavedTheme.id != ' => $id,
			       'SavedTheme.shop_id' => $shopId)
			 );
			
			// now update shop featured saved theme id
			$this->Shop->id = $shopId;
			$this->Shop->saveField('saved_theme_id', $id);
		}
		
		return $result;
	}
	
	
}
?>