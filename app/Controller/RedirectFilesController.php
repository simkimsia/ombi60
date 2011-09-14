<?php
class RedirectFilesController extends AppController {

	public $name = 'RedirectFiles';
	
	public $uses = array();

	public $helpers = array('Javascript', 'Ajax',
			     'TinyMce.TinyMce', 'Text');
	
	public $view = 'TwigView.Twig';

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('theme');
	}
	
	public function theme($theme_name) {
		$this->viewPath = 'webroot/assets';
		
		// we do not want debug info to show up inside the css file
		// hence we used the ajax layout which will set the debug mode to 0
		$this->layout = 'ajax';
		
		$shopid = Shop::get('Shop.id');
		$shopThemeFolder = $shopid . '_cover';
		$json_data_file = APP.DS.'views'.DS.'themed'.DS.$shopThemeFolder.DS.'config'.DS.'settings_data.json';
		
		$json_data = array();
		
		if (file_exists($json_data_file)) {
			
			$json_data = json_decode(file_get_contents($json_data_file), true);
		}
		
		if (isset($json_data['current'])) {
			// this sets the variable value
			$this->set('settings', $json_data['current']);	
		}
		
		$this->render($theme_name);
	}

}
?>