<?php
/* SVN FILE: $Id: authors_blog.php 127 2009-07-03 18:06:10Z miha@nahtigal.com $ */
/**
 * Short description for authors_blog.php
 *
 * Long description for authors_blog.php
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
 * @subpackage    lil_blogs.models
 * @since         v 1.0
 * @version       $Revision: 127 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-03 20:06:10 +0200 (pet, 03 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * AuthorsBlog class
 *
 * @uses          LilBlogsAppModel
 * @package       lil_blogs
 * @subpackage    lil_blogs.models
 */
class AuthorsBlog extends LilBlogsAppModel {
/**
 * name property
 *
 * @var string 'AuthorsBlog'
 * @access public
 */
	var $name = 'AuthorsBlog';
/**
 * __construct method
 *
 * @param mixed $id
 * @param mixed $table
 * @param mixed $ds
 * @access private
 * @return void
 */
	function __construct($id = false, $table = null, $ds = null)	{
		$this->useTable = Configure::read('LilBlogsPlugin.authorsBlogTable');
		parent::__construct($id, $table, $ds);
	}
}
?>
