<?php
/**
 * Copyable Behavior class file.
 *
 * Adds ability to copy a model record, including all hasMany and hasAndBelongsToMany
 * associations. Relies on Containable behavior, which this behavior will attach
 * on the fly as needed.
 * 
 * HABTM relationships are just duplicated in the join table, while hasMany and hasOne
 * records are recursively copied as well.
 *
 * Usage is straightforward:
 * From model: $this->copy($id); // id = the id of the record to be copied
 * From container: $this->MyModel->copy($id);
 *
 * @filesource
 * @author			Jamie Nay
 * @copyright       Jamie Nay
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link            http://github.com/jamienay/copyable_behavior
 */
class ThemeFolderBehavior extends ModelBehavior {
	
	var $folderNameField = '';
	
	var $themePath = '';
	
	/**
	 * Configuration method.
	 *
	 * @param object $Model Model object
	 * @param array $config Config array
	 * @access public
	 * @return boolean
	 */
	public function setup(&$Model, $settings=array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'chmod' => 0775,
				'themePath' => APP . 'View' . DS . 'Themed' . DS,
				'folderNameField' => 'name',
				'defaultFolderName' => 'default'
			);
		}
		
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias],
							     (array)$settings);
		
		$this->themePath = $this->settings[$Model->alias]['themePath'];
		$this->folderNameField = $this->settings[$Model->alias]['folderNameField'];
	
	}
	
	function existFolder(&$Model, $check){
		return !$this->fileExists($check[$this->folderNameField], $this->themePath);
	}
	
	/**
	 * Copy method.
	 *
	 * @param object $Model model object
	 * @param mixed $id String or integer model ID
	 * @access public
	 * @return boolean
	 */
	public function beforeSave(&$model) {
	
		// we do not wish to create a folder if its update
		if ($model->id > 0) {
			return true;
		}
	
		$success = $this->createFolder($model, null);
		
		if ($success) {
			$success = $this->copyBaseTheme($model);
		}
		
		return $success;
	}
	
	function copyTheme(&$model, $theme_folder_name) {
		
		$dir = new Folder();
		$newFolderName = $model->data[$model->alias][$this->folderNameField];
		$chmod = 0775;
		$sourceThemeFolder = $this->themePath . $theme_folder_name;
		
		$options = array('to'=> $this->themePath . $newFolderName,
				 'from'=>$sourceThemeFolder,
				 'chmod'=>$chmod);
		
		
		
		return $dir->copy($options);
		
	}
	
	private function copyBaseTheme(&$model) {
		
		$dir = new Folder();
		$newFolderName = $model->data[$model->alias][$this->folderNameField];
		$chmod = $this->settings[$model->alias]['chmod'];
		$defaultThemeFolder = $this->themePath . $this->settings[$model->alias]['defaultFolderName'];
		
		$options = array('to'=> $this->themePath . $newFolderName,
				 'from'=>$defaultThemeFolder,
				 'chmod'=>$chmod);
		return $dir->copy($options);
		
	}
	
	function createFolder(&$model, $chmod = null, $themeName = '') {
		if ($chmod == null) {
			$chmod = $this->settings[$model->alias]['chmod'];
		}
		
		$path = $this->settings[$model->alias]['themePath'];
		$success = false;
		$dir = new Folder();
		
		if ($themeName != '') {
			$themeName = $model->data[$model->alias][$this->folderNameField];
		}
		
		$success = $dir->create($path . $themeName,$chmod);
		
		return $success;
	}
	
	function deleteFolder(&$model, $themeName = '') {
		
		$path = $this->settings[$model->alias]['themePath'];
		$success = false;
		$dir = new Folder();
		
		if ($themeName != '') {
			$themeName = $model->data[$model->alias][$this->folderNameField];
		}
		
		$success = $dir->delete($path . $themeName);
		
		return $success;
	}
	
	function fileExists($filename, $parent_folder, $sort = true, $exceptions = false, $full_path = false) {
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
	
	function renameFolder(&$model, $oldFolderName, $newFolderName, $chmod = null) {
		
		if ($chmod == null) {
			$chmod = $this->settings[$model->alias]['chmod'];
		}
		
		
		$path = $this->settings[$model->alias]['themePath'];
		
		$dir = new Folder($path . $oldFolderName);
		$options = array('to' => $path . $newFolderName,
			 'from' => $path . $oldFolderName,
			 'mode' => $chmod);
		
		
		$success = $dir->move($options);	
		
		return $success;
		
	}
	
	
	
	
}
