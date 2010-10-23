<?php
/* SVN FILE: $Id: posts_controller.php 147 2009-09-09 10:28:24Z miha@nahtigal.com $ */
/**
 * Short description for posts_controller.php
 *
 * Long description for posts_controller.php
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
 * @version       $Revision: 147 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-09-09 12:28:24 +0200 (sre, 09 sep 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * PostsController class
 *
 * @uses          LilBlogsAppController
 * @package       lil_blogs
 * @subpackage    lil_blogs.controllers
 */
class PostsController extends LilBlogsAppController {
/**
 * name property
 *
 * @var string 'Posts'
 * @access public
 */
	var $name = 'Posts';
/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array('Time', 'Paginator', 'Text');
/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array('limit' => 25);
/**
 * components property
 *
 * @var array
 * @access public
 */
	var $components = array('RequestHandler', 'LilBlogs.BlogSpam', 'Security', 'Email');
/**
 * uses property
 *
 * @var array
 * @access public
 */
	var $uses = array('LilBlogs.Post', 'LilBlogs.AuthorsBlog');
/**
 * isAuthorized method
 *
 * @access public
 * @return bool
 */
	function isAuthorized() {
		if (isset($this->Auth) && !Configure::read('LilBlogsPlugin.allowAuthorsAnything')) {
			if (($this->params['action']=='admin_edit') || ($this->params['action']=='admin_delete')) {
				if (!empty($this->params['pass'][0]) && ($blog_id=$this->Post->field('blog_id', array('id'=>$this->params['pass'][0])))) {
					return 
						Configure::read('LilBlogsPlugin.noBlogs') || 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array(
							'author_id' => $this->Auth->user('id'), 
							'blog_id'   => $blog_id
						));
				} else return false;
			} else if (($this->params['action']=='admin_index') || ($this->params['action']=='admin_add')) {
				if (!empty($this->params['pass'][0]) || !empty($this->data['Post']['blog_id'])) {
					return 
						Configure::read('LilBlogsPlugin.noBlogs') || 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array(
							'author_id' => $this->Auth->user('id'), 
							'blog_id'   => (empty($this->data['Post']['blog_id']))?$this->params['pass'][0]:$this->data['Post']['blog_id']
						));
				} else return false;
			}
		}
		return true;
	}
/**
 * beforeRender method
 *
 * @access public
 * @return void
 */
	function beforeRender() {
		if (empty($this->params['blogname'])) {
			if (!empty($this->params['named']['blogname'])) {
				$this->params['blogname'] = $this->params['named']['blogname'];
			} else if (!empty($this->params['pass'][0])) {
				$this->params['blogname'] = $this->params['pass'][0];
			}
		}
		
		// determine theme
		if ($blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			if (!$theme = $blog['Blog']['theme'] || $theme = Configure::read('LilBlogsPlugin.defaultTheme')) {
				$this->theme = $theme;
			}
		} else if (!empty($this->params['named']['theme_preview'])) {
		    $this->theme = $this->params['named']['theme_preview'];
		} else {
			if (($theme = $this->Post->Blog->field('theme', array(
				'Blog.short_name' => $this->params['blogname']
			))) || ($theme = Configure::read('LilBlogsPlugin.defaultTheme'))) {
				$this->theme = $theme;
			}
		}

		parent::beforeRender();
	}
/**
 * index method
 *
 * @access public
 * @return bool
 */
	function index() {
		// extract blog data from params
		if ($blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			$this->params['blogname'] = $blog['Blog']['short_name'];
		} else {
			if (empty($this->params['blogname'])) {
				if (!empty($this->params['named']['blogname'])) {
					$this->params['blogname'] = $this->params['named']['blogname'];
				} else if (!empty($this->params['pass'][0])) {
					$this->params['blogname'] = $this->params['pass'][0];
				}
			}
			if (!empty($this->params['blogname'])) {
				$blog = $this->Post->Blog->find('first', array('conditions' => array(
					'Blog.short_name' => $this->params['blogname']
				)));
				if (empty($blog)) {
					$this->error404();
					return;
				}
			}
		}
		
		$search = false;
		$params = array(
			'conditions'=> array(
				'Post.status'  => 2
			),
			'limit' => Configure::read('LilBlogsPlugin.mainPageItems'),
			'order' => 'Post.created DESC',
			'contain' => array('Author')
		);
		
		if (!Configure::read('LilBlogsPlugin.noCategories')) {
			$params['contain'][] = $this->Post->hasAndBelongsToMany['Category']['withClassName'];
			$params['contain'][] = 'Category';
		}
		
		// search
		if (!empty($this->data['Post']['criterio'])) {
			if ($this->Post->lilSearchEnabled()) {
				$params['conditions']['Post.id'] = 
					$this->Post->lilSearch($this->data['Post']['criterio']);
				unset($params['order']);
				unset($params['limit']);
			} else {
				$params['conditions']['OR'] = array(
					'Post.title LIKE' => '%' . $this->data['Post']['criterio'] . '%',
					'Post.body LIKE' => '%' . $this->data['Post']['criterio'] . '%',
				);
			}
			$search['criterio'] = $this->data['Post']['criterio'];
		}
		
		// filter by category
		if (!Configure::read('LilBlogsPlugin.noCategories') &&
			!empty($this->params['named']['category']))
		{
			$this->Post->bindModel(
				array('hasOne' => array(
					$this->Post->hasAndBelongsToMany['Category']['withClassName'] => array(
						'className' => $this->Post->hasAndBelongsToMany['Category']['with'],
					)
				)), false
			);
			// TODO: wrong fieldname category_id here
			$params['conditions'][$this->Post->hasAndBelongsToMany['Category']['withClassName'].'.'.$this->Post->hasAndBelongsToMany['Category']['associationForeignKey']] = $this->params['named']['category'];
			$search['category'] = $this->params['named']['category'];
		}
		
		if (!empty($this->params['blogname'])) 
		{
			$params['conditions']['Post.blog_id'] = $blog['Blog']['id'];
			$blog_name = $blog['Blog']['name'];
			$blog_description = $blog['Blog']['description'];
		} else if (empty($this->params['blogname']) || $this->params['blogname']=='all') {
			$blog_name = __d('lil_blogs', 'LilBlogs posts', true);
			$blog_description = __d('lil_blogs', 'Posts from every single blog on', true).' '.Router::url('/', true);
		} else {
			$this->error404();
		}
		
		// is it rss?
		if ($this->RequestHandler->prefers('rss') == 'rss') {
			Configure::write('debug', 0);
			$this->set('channel', array('title' => $blog_name, 'description' => $blog_description));
			$params['limit'] = Configure::read('LilBlogsPlugin.rssItems');
		}
		
		$this->paginate = $params;
		$recent_posts = $this->paginate('Post');
		
		$this->set(compact('blog', 'search'));
		$this->set('recentposts', $recent_posts);
	}
/**
 * view method
 *
 * @access public
 * @return bool
 */
	function view() {
		if (!empty($this->params['postid']) && is_numeric($this->params['postid'])) {
			$conditions = array('Post.id'=>$this->params['postid'], 'Post.status'=>2);
		} else if (!empty($this->params['named']['postid']) && is_numeric($this->params['named']['postid'])) {
			$conditions = array('Post.id'=>$this->params['named']['postid'], 'Post.status'=>2);
		} else if (!empty($this->params['post']) && !empty($this->params['blogname'])) {
			$conditions = array('Post.slug'=>$this->params['post'], 'Post.status'=>2, 'Blog.short_name'=>$this->params['blogname']);
		} else if (!empty($this->params['named']['post']) && !empty($this->params['named']['blogname'])) {
			$conditions = array('Post.slug'=>$this->params['named']['post'], 'Post.status'=>2, 'Blog.short_name'=>$this->params['named']['blogname']);
	 	} else if (!empty($this->params['pass'][0]) && is_numeric($this->params['pass'][0])) {
	 		$conditions = array('Post.id'=>$this->params['pass'][0], 'Post.status'=>2);
	 	} else if (!empty($this->params['pass'][0]) && !empty($this->params['pass'][1])) {
			$conditions = array('Post.slug'=>$this->params['pass'][1], 'Post.status'=>2, 'Blog.short_name'=>$this->params['pass'][0]);
		} else {
			$conditions = array('Post.id'=>-1);
		}
		
		$params = array(
			'conditions' => $conditions,
			'contain'    => array('Author', 'Comment.status = 2')
		);
		
		if (!Configure::read('LilBlogsPlugin.noCategories')) {
			$params['contain'][] = 'Category';
		}
		
		if ($blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			if (isset($params['conditions']['Blog.short_name'])) {
				unset($params['conditions']['Blog.short_name']);
			}
		} else {
			$params['contain'][] = 'Blog';
		}
		
		// read post
		if (!$post = $this->Post->find('first', $params)) {
		    $this->error404();
		    return;
		}
		// clean up the HTML of each comment
		array_walk($post['Comment'], array($this, '_clean'));
		
		// read blog if not previously set
		if (empty($blog)) {
			$blog_params = array(
				'conditions' => array(
					'Blog.id' => $post['Post']['blog_id']
				),
				'contain' => array()
			);
			if (!Configure::read('LilBlogsPlugin.noCategories')) {
				$blog_params['contain'][] = 'Category';
			}
			$blog = $this->Post->Blog->find('first', $blog_params);
		}
		
		$this->set(compact('post', 'blog'));
		
		// save comment
		if (!empty($this->data)) {
			if ($data = $this->Post->Comment->add($this->data)) {
			    $data['Comment']['id'] = $this->Post->Comment->id;
				if ($data['Comment']['status'] == BLOGSPAM_HAM) {
					$this->Session->setFlash(__d('lil_blogs', 'Your comment has been successfully saved.', true));
				} else {
					$this->Session->setFlash(__d('lil_blogs', 'Your comment has gone into moderation.', true));
				}
				if (in_array($data['Comment']['status'], array(BLOGSPAM_HAM, BLOGSPAM_UNKNOWN)) &&
					$email_to = Configure::read('LilBlogsPlugin.commentedEmail'))
				{
					$this->Email->to = $email_to;
					$this->Email->from = 'lil_blogs@'.env('HTTP_HOST');
					$this->Email->subject = sprintf(__d('lil_blogs', '[%1$s] New comment on "%2$s"', true), $blog['Blog']['name'], $post['Post']['title']);
					$this->Email->template = 'comment_notification';
					$this->Email->sendAs = 'text';
					$this->set('comment', $data);
					$this->Email->delivery = Configure::read('LilBlogsPlugin.emailDelivery');
					$this->Email->smtpOptions = Configure::read('LilBlogsPlugin.emailSmtpOptions');
					$this->Email->send();
				}
				// redirect to self
				$this->redirect(Router::url(null, true));
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Uh oh, we weren\'t able to save your comment.', true), 'error');
			}
		}
		
		if ($this->RequestHandler->prefers('rss') == 'rss') {
			Configure::write('debug', 0);
			$this->set('channel', array(
				'title'       => $blog['Blog']['name'], 
				'description' => $blog['Blog']['description']));
		}
	}
/**
 * admin_index method
 *
 * @param int $blogid
 * @access public
 * @return void
 */
	function admin_index($blogid=null) {
		if (is_numeric($blogid) && (
			($blog = Configure::read('LilBlogsPlugin.noBlogs')) || 
			($blog = $this->Post->Blog->findById($blogid))
		)) { 
			$this->paginate = array(
				'conditions' => array(
					'Post.blog_id' => $blogid
				),
				'limit'   => 10,
				'order'   => 'Post.created DESC',
				'contain' => array('Author')
			);
			if (!Configure::read('LilBlogsPlugin.noBlogs')) {
				$this->paginate['contain'][] = 'Blog';
			}
			
			$data = $this->paginate('Post');
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
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'A new post has been created.', true));
				$this->redirect(array('action'=>'admin_index', $this->data['Post']['blog_id']));
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Please verify that the information is correct.', true), 'error');
			}
		} else if (is_numeric($blogid)) {
			$this->data['Post']['blog_id'] = $blogid;
		}
		
		if (!empty($this->data['Post']['blog_id'])) {
			if (!$blog = Configure::read('LilBlogsPlugin.noBlogs')) {
				$blog = $this->Post->Blog->findById($this->data['Post']['blog_id']);
			}
			$this->set(compact('blog'));
			$this->set('blogid', $this->data['Post']['blog_id']);
			
			if (!Configure::read('LilBlogsPlugin.noCategories')) {
				$conditions = array();
				if (!Configure::read('LilBlogsPlugin.noBlogs')) {
					$conditions['Category.blog_id'] = $blog['Blog']['id'];
				}
				
				$this->set('categories', $this->Post->Category->find('list', array(
					'conditions' => $conditions
				)));
			}
			
			$this->set('authors', $this->Post->Author->find('list'));
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
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__d('lil_blogs', 'Post has been saved.', true));
				
				$referer = trim(base64_decode(@$this->data['Post']['referer']));
				if (empty($referer)) {
					$this->redirect(array('action'=>'admin_index', $this->data['Post']['blog_id']));
				} else {
				    $this->redirect(array_merge(
						array('admin' => false),
						$this->parseUrl($referer),
						array('highlight_post'=>$this->Post->id)
					));
				}
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Please verify that the information is correct.', true), 'error');
			}
		} else if (is_numeric($id) && $this->data = $this->Post->read(null, $id)) {
			$this->data['Post']['referer'] = base64_encode($this->referer(''));
		} else {
			$this->error404();
		}
		
		if (!$blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			$blog = $this->Post->Blog->find('first', array('conditions' => array(
				'Blog.id' => $this->data['Post']['blog_id']
			)));
		}
		$this->set(compact('blog'));
		
		if (!Configure::read('LilBlogsPlugin.noCategories')) {
			$conditions = array();
			if (!Configure::read('LilBlogsPlugin.noBlogs')) {
				$conditions['Category.blog_id'] = $blog['Blog']['id'];
			}
			
			$this->set('categories', $this->Post->Category->find('list', array(
				'conditions' => $conditions
			)));
		}
		$this->set('authors', $this->Post->Author->find('list'));
	}
/**
 * admin_delete method
 *
 * @param int $id
 * @access public
 * @return void
 */
	function admin_delete($id=null) {
		if (is_numeric($id) && $data = $this->Post->findById($id)) {
			$this->Post->delete($id);
			$this->Session->setFlash(__d('lil_blogs', 'Post has been deleted.', true));
			$this->redirect($this->referer());
		} else {
			$this->error404();
		}
	}
/**
 * _clean method
 *
 * @param mixed $data
 * @access private
 * @return void
 */
	function _clean(&$data) {
		$data['body'] = $this->BlogSpam->clean($data['body']);
	}
}
?>
