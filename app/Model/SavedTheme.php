<?php
class SavedTheme extends AppModel {
	public $name = 'SavedTheme';
	public $displayField = 'name';
	
	public $maxSizeOfCss = 2097152;
	
	public $folderPath = '';
	
	public $failedUploadedImages = array();
	
	public $successUploadedImages = array();
	
	
	public $actsAs = array('ThemeFolder.ThemeFolder' =>
				array('folderNameField' => 'folder_name',
				      'validateOn' => true)
			    );
	
	
	public $validate = array(
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
					/*		
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
					*/
			      )
			      
			);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
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
	
	public function compulsoryCss($check=array()) {
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
		return APP . 'View' . DS . 'Themed' . DS . $themeName . DS . 'webroot' . DS . 'css' . DS . 'style.css';
	}
	
	public function constructImagePath($themeName, $imageName = '') {
		return APP . 'View' . DS . 'Themed' . DS . $themeName . DS . 'webroot' . DS . 'img' . DS . $imageName;
	}
	

	
	public function existFolderToRename($check){
		if (isset($this->data['SavedTheme']['original_folder_name']) AND
		    $this->data['SavedTheme']['original_folder_name'] !=  $this->data['SavedTheme']['folder_name']) {
			return $this->existFolder($check);
		}
		return true;
		
	}
	
	
	
	public function saveThemeAtSignUp($options = array()) {
		$theme = ClassRegistry::init('Theme');
		
		$themeData = $theme->read(null, $options['theme_id']);
		
		// set the 
		$data['SavedTheme']['copy'] = $themeData['Theme'];
		
		// copy attributes from themeData
		$data['SavedTheme']['name'] = $themeData['Theme']['name'];
		$data['SavedTheme']['description'] = $themeData['Theme']['description'];

		// copy attributes from options
		$data['SavedTheme']['author'] = $options['author'];
		$data['SavedTheme']['shop_id'] = $options['shop_id'];
		$data['SavedTheme']['theme_id'] = $options['theme_id'];
		
		// set as featured 
		$data['SavedTheme']['featured'] = true;
		
		// to prevent the beforesave function from working temporarily will remove this soon
		$data['SavedTheme']['skipCssCheck'] = true;
		$data['SavedTheme']['signup'] = true;
		
		// create the actual SavedTheme record and the folder itself
		$result = $this->createByCopyTheme($data);
		
		if (!$result) {
			$this->log('Fail to save Theme in ' . __FILE__ . ' at line ' . __LINE__);
		}

		// refactor the foldername for all SavedTheme folders
		$destinationFolderName = 'Shop' . $options['shop_id'] . 'SavedTheme' . $this->id;
		$folderOk =  $this->folderOrFileExists($destinationFolderName, SAVED_THEMES_DIR);
		
		if (!$folderOk) {
			$this->log('Folder is NOT created in ' . __FILE__ . ' at line ' . __LINE__);
		}
		
		if ($result && $folderOk) {
			$this->Shop->id = $options['shop_id'];
			$this->Shop->saveField('saved_theme_id', $this->id);
		} else {
			return false;
		}
		
		return $result;
	}
	
	/**
	*
	* afterSave callback
	*
	* this is to save a brand new foldername called Shop{shop_id}SavedTheme{id} into database record
	**/
	public function afterSave($created) {
		
		// we need to actually create the empty folder and then move the files
		if ($created) {
			$folderName = 'Shop' . $this->data['SavedTheme']['shop_id'] . 'SavedTheme' . $this->id;
			$success = $this->createFolder(0755, SAVED_THEMES_DIR . $folderName);
						
			if ($success) {
				
				$success = $this->saveField('folder_name', $folderName);
			} else {
				$this->delete($this->id);
				// throw some exception
			}
			return $success;
		}
		
	}

	
	public function revertFolderNameAfterUnsuccessfulUpdate() {
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
	
	public function fetchImages($folder_name) {
		$path = APP . 'View' . DS . 'Themed' . DS . $folder_name . DS . 'webroot' . DS . 'img';
		
		$dir = new Folder($path);
		
		$images = $dir->find('.*', true);
		
		return $images;
	}
	
	
	public function deleteThemeFolderAfterFailSave($themeFolderName = null) {
		
		if ($themeFolderName == null) {
			return false;
		}
		
		
		// first we ensure that this folder does NOT exist in database.
		// this is to prevent unnecessary deletion due to validation
		// this will be meant just for validation errors situation. beforeDelete method will skip this check
		
		$theme = $this->findByFolderName($themeFolderName);
		if (is_array($theme) AND !empty($theme)) {
			return false;
		}			
	
		
		$this->data = array('SavedTheme'=>array('folder_name'=>$themeFolderName));
		$success = $this->deleteFolder($themeFolderName);
		
		
		return $success;
	}
	
	/**
	* Checks if ocurred errors in the upload.
	*
	* @param $model Object
	* @param $data Array
	* @return boolean
	*/
	public function uploadCheckUploadError($data = array()) {
		
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
	public function uploadCheckMaxSize($data = array()) {
		
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
	public function uploadCheckInvalidMime($data = array()) {
		
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
	public function uploadCheckInvalidExt($data = array()) {
		
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
	
	public function copyFileFromTemp($tmpName, $saveAs, $checkForUploadedFile = true) {
		
		$results = true;
		if (!is_uploaded_file($tmpName) && $checkForUploadedFile) {
			return false;
		}
		$file = new File($tmpName, $saveAs);
		$temp = new File($saveAs, true, 0775);
		
		if (!$temp->write($file->read())) {
			$results = __d('meio_upload', 'Problems in the copy of the file.');
		
		}
		$file->close();
		$temp->close();
		
		return $results;
	}
	
	public function read($fields = null, $id = null) {
		$data = parent::read($fields, $id);
		
		if ($id == null) {
			return $data;
		}
		
		
		//$cssFile = new File($this->constructCssPath($data['SavedTheme']['folder_name']));
		
		//$data['SavedTheme']['css'] = $cssFile->read();
		
		$data['SavedTheme']['original_name'] = $data['SavedTheme']['name'];
		
		return $data;
	}
	
	public function beforeDelete($cascade) {
		// this is to remove the theme folder BEFORE we delete database entry
		// we need to first retrieve folder name
		$this->data = $this->read(null, $this->id);
		$success = $this->deleteFolder();
		if ($success) {
			$success = $this->featureNewThemeAfterDelete($this->id);
		}
		return $success;
	}
	
	
	public function featureNewThemeAfterDelete($id = null) {
		$featuredThemeId = Shop::get('saved_theme_id');
		$shopId = Shop::get('Shop.id');
		
		if ($featuredThemeId == $id) {
			$newId = $this->field('id', array('conditions' => array('SavedTheme.shop_id' => $shopId)));
			$this->feature($newId);
		}
		return true;
	}
	
	public function switchTheme($data) {
		
		$theme = ClassRegistry::init('Theme');
		
		$themeData = $theme->read(null, $data['SavedTheme']['theme_id']);
		
		// set the sourceFolderName, later we need it for copying over.
		$this->sourceFolderName = $themeData['Theme']['folder_name'];
		
		// to prevent the beforesave function from working
		$data['SavedTheme']['skipCssCheck'] = true;
		$data['SavedTheme']['switch'] = true;
		
		$this->data = $data;
		
		
		$this->deleteFolder($data['SavedTheme']['folder_name']);
		$this->createFolder(0775, $data['SavedTheme']['folder_name']);
		
		$result = $this->copyTheme($this->sourceFolderName);
		if ($result) {
			
			$this->save($data);
		} 
		return $result;
	}
	
	public function feature($id = null) {
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
	
	/**
	*
	* check if path is an empty folder. if not folder, then return false
	*
	* @param $path string Path to the folder
	* @return boolean return true if it is a folder and it has zero bytes
	**/
	public function isEmptyFolder($path) {
		if(is_dir($path)) {
			$dir = new Folder($path);
			return ($dir->dirsize() === 0);
		}
		return false;
	}
	
	public function folderOrFileExists ($filename, $parent_folder, $sort = true, $exceptions = false, $full_path = false) {		
		$dir = new Folder();
		$dir->cd($parent_folder);
		
		$files = $dir->read($sort, $exceptions, $full_path);
		
		$flag = false;
		foreach($files as $key => $array) {
			$flag = in_array($filename, $array);
			if ($flag) {
				break;
			}
		}
		
		return $flag;
	}
	
	/**
	*
	* copy from a preset Theme
	*
	* @param $data Array Expect a ['SavedTheme']['copy'] to have the file data. We also expect the $data['SavedTheme'] to have name, author, description, shop_id, theme_id
	* @return boolean Return true if successful
	**/	
	public function createByCopyTheme($data) {
		// step1: does the file exist?
		if (!isset($data['SavedTheme']['copy'])) {
			$this->log('error in ' . __FILE__ . ' at line ' . __LINE__);
			return false;
		}
		
		// step2: create new SavedTheme 
		$this->create();
		
		// step3: build the savedTheme data
		// step3a: shopId
		$shopId			= $data['SavedTheme']['shop_id'];
		$savedThemeData = $data['SavedTheme'];
		
		// step4: save the related data for SavedTheme and create the folder
		$result = $this->save(array(
			'SavedTheme' => $savedThemeData
		)); 

		// step5: if successfully created database record for SavedTheme, copy files from source Theme
		if ($result) {
			
			// step6: get the source Theme
			$theme 			= $data['SavedTheme']['copy'];
			$sourceFolder 	= $theme['folder_name'];			
			
			$folderName = 'Shop' . $shopId . 'SavedTheme' . $this->id;

			$result = $this->copyFromTheme($sourceFolder, $folderName);		
			
			if (!$result) {
				$this->log('fail to properly copy from theme in ' . __FILE__ . ' at line ' . __LINE__);
				$this->delete($this->id);
			}
			
			return $result;
		}
		
		return false;
		
	}
	
	/**
	*
	* copy all the files from an existing Theme folder into a SavedTheme folder
	*
	* @param $themeFolderName string Path to zip file
	* @param $folderName string Name of SavedTheme folder
	* @return boolean Return true if successful
	**/
	public function copyFromTheme($themeFolderName, $folderName) {
		// if folder already exists && is NOT empty, we must stop. We don't want to overwrite
		if (!$this->isEmptyFolder(SAVED_THEMES_DIR . $folderName)) {
			return false;
		}
		
		$targetPath = SAVED_THEMES_DIR . $folderName;

		// create the SavedTheme Folder if it does not already exist
		if (!is_dir($targetPath)) mkdir($targetPath, 0755, true);
		
		$dir 				= new Folder();
		$chmod 				= 0755;
		$sourceThemeFolder 	= SAVED_THEMES_DIR . $themeFolderName; // temporarily using SAVED_THEMES_DIR

		$options = array(
			'to'	=> $targetPath,
			'from'	=> $sourceThemeFolder,
			'chmod'	=> $chmod
		);

		if (!$dir->copy($options)) {
			$this->log('error in ' . __FILE__ . ' at line ' . __LINE__);
			return false;
		}
		return true;
	}
	
	
	/**
	*
	* upload a new zip file for theme 
	*
	* @param $data Array Expect a ['SavedTheme']['upload'] to have the file 
	* @return boolean Return true if successful
	**/	
	public function createByUploadFile($data) {
		// step1: does the file exist?
		if (!isset($data['SavedTheme']['upload'])) {
			return false;
		}
		
		// step2: create new SavedTheme 
		$this->create();
		
		// step3: build the savedTheme data
		
		// step3a: get the name for the SavedTheme
		/* $file contains the zipped file as if it is from $_FILES */
		$file 		= $data['SavedTheme']['upload'];
		$filename	= $file['name'];
		$nameParts 	= explode('.', $filename);
		
		$basename 		= $nameParts[0];
		
		// step3b: get the user_id
		$author			= User::get('User.full_name');
		// step3c: get the description
		$description	= '';
		// step3d: get the shop id
		$shopId			= Shop::get('Shop.id');
		
		$savedThemeData = array(
			'name'		=> $basename,
			'shop_id'	=> $shopId,
			'description' => $description,
			'author'	=> $author,
			'upload'	=> $file
		);
				
		// step4: save the related data for SavedTheme and create the folder
		$result = $this->save(array(
			'SavedTheme' => $savedThemeData
		)); 
		
		// step5: if successfully created database record for SavedTheme, unzip file to the folder itself
		if ($result) {
			
			// step6: get the actual uploaded zip file
			$file 		= $data['SavedTheme']['upload'];
			$storedFile = $file['tmp_name'];
			
			$folderName = 'Shop' . $shopId . 'SavedTheme' . $this->id;
			
			$result = $this->copyFromZipFile($storedFile, $folderName);
			
			if (!$result) {
				$this->delete($this->id);
			}
		}
		
		return false;
		
	}
	
	
	/**
	*
	* copy all the contents of a zip file into  SavedTheme folder 
	*
	* @param $zipfilePath string Path to zip file
	* @param $folderName string Name of SavedTheme folder
	* @return boolean Return true if successful
	**/
	protected function copyFromZipFile($zipfilePath, $folderName) {
		// if folder already exists and is NOT empty, we must stop. We don't want to overwrite
		if (!$this->isEmptyFolder(SAVED_THEMES_DIR . $folderName)) {
			return false;
		}
		
		$targetPath = SAVED_THEMES_DIR . $folderName;

		// create the SavedTheme Folder if it does not already exist
		if (!is_dir($targetPath)) mkdir($targetPath, 0755, true);
		
		// create new zip archive
		$zip = new ZipArchive;
		// open the zipped file
		if ($zip->open($zipfilePath) === TRUE) {
			// loop through each entry in the zip file including folder
			for($i=0; $i<$zip->numFiles; $i++) {
			    $name = $zip->getNameIndex($i);
				// now we check if this entry is valid like Snippets/related.tpl
				$basename	= $this->validateEntry($name); // Snippets/related.tpl for eg
				$validEntry = ($basename !== false);
				
				if ($validEntry) {

					// Determine output filename (removing the $source prefix)
					$file = $targetPath . DS . $basename;

					// Create the directories if necessary
					$dir = dirname($file);
					if (!is_dir($dir)) mkdir($dir, 0755, true);

				    // Read from Zip and write to disk
				    $fpr = $zip->getStream($name);
				    $fpw = fopen($file, 'w');
				    while ($data = fread($fpr, 1024)) {
				        fwrite($fpw, $data);
				    }
				    fclose($fpr);
				    fclose($fpw);

				}
			}
						
		    $zip->close();
		    return true;
		} else {
		    return false;
		}
		
	}
	
	/**
	*
	* may export this to a separate behavior class
	* this is to match an entry say /xxx/Snippets/related.tpl and return true
	*
	* @param $entry String Entry name eg /xxx/Snippets/related.tpl
	* @return boolean/string Return the matched portion of the entry if matched. Return boolean false if not matched at all
	**/
	public function validateEntry($entry) {
		$matches = array();
		
		// check against Config
		// must end with Config/settings.html OR Config/settings_data.json
		$matchNumber = preg_match('/Config\/(settings\.html|settings_data\.json)$/', $entry, $matches);
		if ($matchNumber === 1) {
			return $matches[0];
		}
		
		// check against Layouts, Snippets, Templates
		// must end with Layouts/*.tpl, Snippets/*.tpl, Templates/*.tpl 
		$matchNumber = preg_match('/(Layouts|Snippets|Templates)\/[a-zA-Z0-9\-_]+\.tpl$/', $entry, $matches);
		if ($matchNumber === 1) {
			return $matches[0];
		}

		// check against webroot
		// must end with webroot/*.css.tpl, *.css, *.js, *.png, *.gif, *.jpg OR *.jpeg
		$matchNumber = preg_match('/webroot\/[a-zA-Z0-9\-_]+\.(tpl|css|js|png|gif|jpg|jpeg)$/', $entry, $matches);
		if ($matchNumber === 1) {
			return $matches[0];
		}
				
		return false;
		
	}
	
	
}
?>