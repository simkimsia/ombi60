<?php
/* SVN FILE: $Id: authors_controller.php 141 2009-08-30 17:13:28Z miha@nahtigal.com $ */
/**
 * Short description for authors_controller.php
 *
 * Long description for authors_controller.php
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
 * AuthorsController class
 *
 * @uses          LilBlogsAppController
 * @package       lil_blogs
 * @subpackage    lil_blogs.controllers
 */
class AuthorsController extends LilBlogsAppController {
/**
 * name property
 *
 * @var string 'Authors'
 * @access public
 */
	var $name = 'Authors';
/**
 * components property
 *
 * @var array
 * @access public
 */
	var $components = array('Cookie', 'Security');
/**
 * isAuthorized method
 *
 * @access public
 * @return bool
 */
	function isAuthorized() {
		if (isset($this->Auth) && !Configure::read('LilBlogsPlugin.allowAuthorsAnything')) {
			return $this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField'));
		}
		return true;
	}
/**
 * beforeFilter method
 *
 * @access public
 * @return void
 */
	function beforeFilter() {
		parent::beforeFilter();
		if (isset($this->Auth) && (!CAKE_UNIT_TEST)) {
			$this->Auth->autoRedirect = false;
		}
	}
/**
 * login method
 *
 * @access public
 * @return void
 */
	function login() {
		// code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		$useLayout = Configure::read('LilBlogsPlugin.useAdminLayout');
		if($useLayout) $this->layout = 'blogs_admin';
		
		if (isset($this->Auth)) {
			if (empty($this->data)) {
				$cookie = $this->Cookie->read($this->Auth->sessionKey);
				if (!is_null($cookie)) {
					if ($this->Auth->login($cookie)) {
						//  Clear auth message, just in case we use it.
						$this->Session->del('Message.auth');
						$this->redirect($this->Auth->loginRedirect);
					}
				}
			}
			$this->Author->recursive = -1;
			if ($this->Auth->user()) {
				if (!empty($this->data[$this->Auth->userModel]['remember_me'])) {
					$cookie = array();
					$cookie[$this->Auth->fields['username']] = $this->data[$this->Auth->userModel][$this->Auth->fields['username']];
					$cookie[$this->Auth->fields['password']] = $this->data[$this->Auth->userModel][$this->Auth->fields['password']];
					$this->Cookie->write($this->Auth->sessionKey, $cookie, true, '+2 weeks');
					unset($this->data[$this->Auth->userModel]['remember_me']);
				}
				$this->redirect($this->Auth->loginRedirect);
			}
		}
	}
/**
 * logout method
 *
 * @access public
 * @return void
 */
	function logout() {
		if (isset($this->Auth)) {
			$this->Auth->logout();
			$this->Cookie->del($this->Auth->sessionKey);
			$this->Session->setFlash(__d('lil_blogs', 'You\'ve been logged out.', true), 'default', array(), 'auth');
			$this->redirect($this->Auth->logoutRedirect);
		}
	}
/**
 * admin_index method
 *
 * @access public
 * @return void
 */
	function admin_index() {
		$this->Author->recursive = -1;
		$this->set('authors', $this->Author->find('all'));
	}
/**
 * admin_add method
 *
 * @access public
 * @return void
 */
	function admin_add() {
		if ($this->hasData) {
			if ($this->Author->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'A new author has been added.', true));
				$this->redirect(array('action'=>'admin_index'));
			}
		}
	}
/**
 * admin_edit method
 *
 * @param array $id
 * @access public
 * @return void
 */
	function admin_edit($id=null) {
		if ($this->hasData) {
			if ($this->Author->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'Author has been saved.', true));
				$this->redirect(array('action'=>'admin_index'));
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Please verify that the information is correct.', true), 'error');
			}
		} else if (!is_numeric($id) || !($this->data = $this->Author->read(null, $id))) {
			$this->cakeError('error404');
		}
	}
/**
 * admin_delete method
 *
 * @param array $id
 * @access public
 * @return void
 */
	function admin_delete($id=null) {
		if (is_numeric($id) && $data = $this->Author->findById($id)) {
			$this->Author->delete($id);
			$this->Session->setFlash(__d('lil_blogs', 'Author has been deleted.', true));
			$this->redirect(array('action'=>'admin_index'));
		} else {
			$this->cakeError('error404');
		}
	}
}
?>
