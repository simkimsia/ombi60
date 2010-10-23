<?php
/* SVN FILE: $Id: authors_controller.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for lil_blogs.php
 *
 * Long description for lil_blogs.php
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
 * @subpackage    lil_blogs.views.helpers
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * LilBlogsHelper class
 *
 * @uses          Helper
 * @package       lil_blogs
 * @subpackage    lil_blogs.views.helpers
 */
class LilBlogsHelper extends AppHelper {
/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html');
/**
 * findPosts method
 *
 * @param string $kind Search type
 * @param mixed $params Search parameters
 * @access public
 * @return void
 */
	function findPosts($kind, $params) {
		App::import('Model', 'LilBlogs.Post');
		$Post =& ClassRegistry::init('Post');
		return $Post->find($kind, $params);
	}
/**
 * permaLink method
 *
 * @param string $blog_name
 * @param mixed $post
 * @access public
 * @return void
 */
	function permalink($blog_name, $post) {
		return $this->Html->link($post['Post']['title'], array(
			'admin'      => false,
			'plugin'     => 'lil_blogs',
			'controller' => 'posts',
			'action'     => 'view',
			'blogname'   => $blog_name,
			'post'       => $post['Post']['slug']
		));
	}
}
?>