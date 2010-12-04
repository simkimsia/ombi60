<?php
/* SVN FILE: $Id: lil_blogs_app_controller.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for lil_blogs_app_controller.php
 *
 * Long description for lil_blogs_app_controller.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Miha Nahtigal
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Miha Nahtigal
 * @link          http://www.nahtigal.com/
 * @package       lil_blogs
 * @subpackage    lil_blogs
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * LilBlogsAppController class
 *
 * @uses          AppController
 * @package       lil_blogs
 * @subpackage    lil_blogs
 */
class LilBlogsAppController extends AppController {
/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array('Sanitize', 'Auth', 'Text', 'Form', 'Html', 'Time', 'Session');
/**
 * view property
 *
 * @var string
 * @access public
 */
	var $view = 'LilBlogsApp';
/**
 * theme property
 *
 * @var string
 * @access public
 */
	var $theme = 'default';
/**
 * hasData property
 *
 * @var bool
 * @access public
 */
	var $hasData = false;
/**
 * beforeFilter method
 *
 * @access public
 * @return void
 */
	function beforeFilter() {
		require_once(dirname(__FILE__).DS.'lil_blogs_app_view.php');

		// just set hasData
		if(isset($this->data)) $this->hasData = true;
		parent::beforeFilter();
		
		if (isset($this->Auth)) {
			if ((defined('CAKE_UNIT_TEST') && CAKE_UNIT_TEST) || !@$this->params['admin']) {
				$this->Auth->allow();
			} else {
				$this->Auth->allow('');
			}
		}
		
		// set display field for authors
		if (isset($this->Author)) {
			Configure::write('LilBlogsPlugin.authorDisplayField', $this->Author->displayField);
		}
	}
/**
 * beforeRender method
 *
 * @access public
 * @return void
 */
	function beforeRender() {
		parent::beforeRender();

		$useLayout = Configure::read('LilBlogsPlugin.useAdminLayout');
		if($useLayout && isset($this->params['prefix']) && $this->params['prefix'] == 'admin') $this->layout = 'blogs_admin';
	}
/**
 * isAuthorized method
 *
 * @access public
 * @return void
 */
	function isAuthorized() {
		return true;
	} 
/**
 * redirect method
 *
 * @param string $url
 * @param mixed $status
 * @param bool $exit
 * @access public
 * @return void
 */
	function redirect($url = null, $status = null, $exit = true) {
		if (defined('CAKE_UNIT_TEST') && CAKE_UNIT_TEST) {
			$old = error_reporting(E_USER_NOTICE);
			trigger_error('redirect:'.Router::url($url, true), E_USER_NOTICE);
			error_reporting($old);
		} else {
			parent::redirect($url, $status, $exit);
		}
	}
/**
 * parseUrl function
 *
 * @param string $url
 * @access public
 * @return string
 */
	function parseUrl($url) {
		$url = Router::parse($url);
		$url = am($url, $url['named'], $url['pass']);
		unset($url['named']); unset($url['pass']); unset($url['url']);
		return $url;
	}
/**
 * error404 function
 *
 * @access public
 * @return void
 */
	function error404() {
		$this->cakeError('error404', array());
	}
/**
 * cakeError function
 *
 * @param string $method
 * @param array $messages
 * @access public
 * @return void
 */
	function cakeError($method, $messages = array()) {
		if (defined('CAKE_UNIT_TEST') && CAKE_UNIT_TEST) {
			$old = error_reporting(E_USER_NOTICE);
			trigger_error($method, E_USER_NOTICE);
			error_reporting($old);
			$this->autoRender = false;
			$this->render(false, 'error');
		} else {
			parent::cakeError($method, $messages);
		}
	}
}
?>
