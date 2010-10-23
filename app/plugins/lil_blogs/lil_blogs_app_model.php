<?php
/* SVN FILE: $Id: lil_blogs_app_model.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for lil_blogs_app_model.php
 *
 * Long description for lil_blogs_app_model.php
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
 * LilBlogsAppModel class
 *
 * @uses          AppModel
 * @package       lil_blogs
 * @subpackage    lil_blogs
 */
class LilBlogsAppModel extends AppModel {
/**
 * __construct method
 *
 * @param mixed $id
 * @param mixed $table
 * @param mixed $ds
 * @access private
 * @return void
 */
	function __construct($id = false, $table = null, $ds = null) {
		if (defined('CAKE_UNIT_TEST') && CAKE_UNIT_TEST) {
			$this->useDbConfig = 'test';
		} else {
			if ($table_prefix = Configure::read('LilBlogsPlugin.tablePrefix')) {
				$this->tablePrefix = $table_prefix;
			}
		}
		parent::__construct($id, $table, $ds);
	}
}
?>
