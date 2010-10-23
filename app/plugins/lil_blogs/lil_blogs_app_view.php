<?php
/* SVN FILE: $Id: theme.php 7847 2008-11-08 02:54:07Z renan.saddam $ */
/**
 * A custom view class that is used for themeing
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
 * @version       $Revision: 93 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-06-18 12:10:06 +0200 (čet, 18 jun 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * LilBlogsAppView view class
 *
 * @package       lil_blogs
 * @subpackage    lil_blogs
 */
class LilBlogsAppView extends View {
/**
 * System path to themed element: themed . DS . theme . DS . elements . DS
 *
 * @var string
 */
	var $themeElement = null;
/**
 * System path to themed layout: themed . DS . theme . DS . layouts . DS
 *
 * @var string
 */
	var $themeLayout = null;
/**
 * System path to themed: themed . DS . theme . DS
 *
 * @var string
 */
	var $themePath = null;
/**
 * Controller
 *
 * @var controller
 */
	var $pluginName = null;
/**
 * Enter description here...
 *
 * @param unknown_type $controller
 */
	function __construct (&$controller) {
		parent::__construct($controller);
		$this->theme =& $controller->theme;
		$this->pluginName =& $controller->params['plugin'];

		if (!empty($this->theme)) {
			if (is_dir(WWW_ROOT . 'plugins' . DS . $this->pluginName . DS . 'themed' . DS . $this->theme)) {
				$this->themeWeb = 'plugins/' . $this->pluginName . '/themed/' . $this->theme .'/';
			}
			/* deprecated: as of 6128 the following properties are no longer needed */
			$this->themeElement = 'themed'. DS . $this->theme . DS .'elements'. DS;
			$this->themeLayout =  'themed'. DS . $this->theme . DS .'layouts'. DS;
			$this->themePath = 'themed'. DS . $this->theme . DS;
		}
	}

/**
 * Return all possible paths to find view files in order
 *
 * @param string $plugin
 * @return array paths
 * @access private
 */
	function _paths($plugin = null, $cached = true) {
		$paths = parent::_paths($plugin, $cached);

		if (!empty($this->theme)) {
			$paths = array_merge(array(WWW_ROOT . 'plugins' . DS . $this->pluginName . DS . 'themed' . DS . $this->theme . DS), $paths);
		}

		if (empty($this->__paths)) {
			$this->__paths = $paths;
		}

		return $paths;
	}
}
?>
