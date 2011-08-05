<?php
class RedirectFilesController extends AppController {

	var $name = 'RedirectFiles';
	
	var $uses = array();

	var $helpers = array('Javascript', 'Ajax',
			     'TinyMce.TinyMce', 'Text');
	
	var $view = 'TwigView.Twig';

	function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		$this->Auth->allow('theme');
		
	}
	
	function theme($theme_name) {
		$this->viewPath = 'webroot/css';
		$this->layout = false;
		
		// this sets the variable value
		$this->set('myTwigColorVariable', 'red');
		
		$this->render($theme_name);
	}

}
?>