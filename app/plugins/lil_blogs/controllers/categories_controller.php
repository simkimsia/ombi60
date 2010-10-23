<?php
/* SVN FILE: $Id: categories_controller.php 141 2009-08-30 17:13:28Z miha@nahtigal.com $ */
/**
 * Short description for categories_controller.php
 *
 * Long description for categories_controller.php
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
 * @subpackage    lil_blogs.controllers
 * @since         v 1.0
 * @version       $Revision: 141 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-08-30 19:13:28 +0200 (ned, 30 avg 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * CategoriesController class
 *
 * @uses          LilBlogsAppController
 * @package       lil_blogs
 * @subpackage    lil_blogs.controllers
 */
class CategoriesController extends LilBlogsAppController {
/**
 * name property
 *
 * @var string 'Categories'
 * @access public
 */
	var $name = 'Categories';
/**
 * uses property
 *
 * @var array
 * @access public
 */
	var $uses = array('LilBlogs.Category', 'LilBlogs.AuthorsBlog', 'Security');
/**
 * isAuthorized method
 *
 * @access public
 * @return bool
 */
	function isAuthorized() {
		if (isset($this->Auth) && !Configure::read('LilBlogsPlugin.allowAuthorsAnything')) {
			if (($this->params['action']=='admin_edit') || ($this->params['action']=='admin_delete')) {
				if (!empty($this->params['pass'][0]) && ($blog_id=$this->Category->field('blog_id', array('id'=>$this->params['pass'][0])))) {
					return 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id'=>$this->Auth->user('id'), 'blog_id'=>$blog_id));
				} else return false;
			} else if (($this->params['action']=='admin_index') || ($this->params['action']=='admin_add')) {
				if (!empty($this->params['pass'][0]) || !empty($this->data['Category']['blog_id'])) {
					return 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id'=>$this->Auth->user('id'), 'blog_id'=>(empty($this->data['Category']['blog_id']))?$this->params['pass'][0]:$this->data['Category']['blog_id']));
				} else return false;
			}
		}
		return true;
	}
/**
 * admin_index method
 *
 * @param int $blogid
 * @access public
 * @return void
 */
	function admin_index($blogid=null) {
		$this->Category->contain('Blog');
		if (is_numeric($blogid) && $blog = $this->Category->Blog->findById($blogid)) {
			$data = $this->Category->find('all', array('conditions'=>array('Category.blog_id'=>$blogid)));
			$this->set(compact('data', 'blog'));
		} else {
			$this->error404();
		}
	}
/**
 * admin_add method
 *
 * @param int $blogid
 * @access public
 * @return void
 */
	function admin_add($blogid=null) {
		if ($this->hasData) {
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'A new category has been created.', true));
				$this->redirect(array('action'=>'admin_index', $this->data['Category']['blog_id']));
			}
		} else if (is_numeric($blogid)) {
			$this->data['Category']['blog_id'] = $blogid;
		}
		
		$this->Category->Blog->recursive = -1;
		if (!empty($this->data['Category']['blog_id']) && $blog = $this->Category->Blog->findById((int)$this->data['Category']['blog_id'])) {
			$this->set(compact('blog'));
		} else {
			$this->error404();
		}
	}
/**
 * admin_edit method
 *
 * @param int $id
 * @access public
 * @return void
 */
	function admin_edit($id=null) {
		if ($this->hasData) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'Category has been saved.', true));
				$this->redirect(array('action'=>'admin_index', $this->data['Category']['blog_id']));
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Please verify that the information is correct.'), 'error');
			}
		} else if (!is_numeric($id) || !($this->data = $this->Category->read(null, $id))) {
			$this->error404();
		}
	}
/**
 * admin_delete method
 *
 * @param int $id
 * @access public
 * @return void
 */
	function admin_delete($id=null) {
		if (is_numeric($id) && $data = $this->Category->findById($id, array('blog_id'))) {
			$this->Category->delete($id);
			$this->Session->setFlash(__d('lil_blogs', 'Category has been deleted.', true));
			$this->redirect($this->referer());
		} else {
			$this->error404();
		}
	}
}
?>
