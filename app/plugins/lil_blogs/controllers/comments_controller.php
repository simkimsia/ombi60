<?php
/* SVN FILE: $Id: comments_controller.php 143 2009-08-30 17:39:47Z miha@nahtigal.com $ */
/**
 * Short description for comments_controller.php
 *
 * Long description for comments_controller.php
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
 * @version       $Revision: 143 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-08-30 19:39:47 +0200 (ned, 30 avg 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * CommentsController class
 *
 * @uses          LilBlogsAppController
 * @package       lil_blogs
 * @subpackage    lil_blogs.controllers
 */
class CommentsController extends LilBlogsAppController {
/**
 * name property
 *
 * @var string 'Comments'
 * @access public
 */
	var $name = 'Comments';
/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array('Paginator', 'Time');
/**
 * components property
 *
 * @var array
 * @access public
 */
	var $components = array('LilBlogs.BlogSpam', 'Email', 'RequestHandler', 'Security');
/**
 * uses property
 *
 * @var array
 * @access public
 */
	var $uses = array('LilBlogs.Comment', 'LilBlogs.Post', 'LilBlogs.AuthorsBlog');
/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'limit' => 10,
		'order' => array(
			'Comment.id' => 'desc'
		)
	);
/**
 * beforeFilter method
 *
 * @access public
 * @return void
 */
	function beforeFilter() {
		parent::beforeFilter();
		if ($this->params['action'] == 'admin_quick') {
			$this->Security->validatePost = false;
		} 
	}
/**
 * isAuthorized method
 *
 * @access public
 * @return bool
 */
	function isAuthorized() {
		if (isset($this->Auth) && !Configure::read('LilBlogsPlugin.allowAuthorsAnything')) {
			if (($this->params['action']=='admin_edit') || ($this->params['action']=='admin_delete')) {
				$this->Comment->recursive = 0;
				if (!empty($this->params['pass'][0]) && ($blog_id=$this->Comment->field('Post.blog_id', array('Comment.id'=>$this->params['pass'][0])))) {
					return 
						Configure::read('LilBlogsPlugin.noBlogs') || 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id'=>$this->Auth->user('id'), 'blog_id'=>$blog_id));
				} else return false;
			} else if (($this->params['action']=='admin_index')) {
				if (!empty($this->params['pass'][0]) && ($blog_id=$this->Post->field('blog_id', array('id'=>$this->params['pass'][0])))) {
					return 
						Configure::read('LilBlogsPlugin.noBlogs') || 
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id' => $this->Auth->user('id'), 'blog_id' => $blog_id));
				} else if (!empty($this->params['named']['blog_id'])) {
					$blog_id = $this->params['named']['blog_id'];
				 	return
						Configure::read('LilBlogsPlugin.noBlogs') ||
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id' => $this->Auth->user('id'), 'blog_id' => $blog_id));
				} else return false;
			} else if (($this->params['action']=='admin_quick')) {
				$this->Comment->recursive = 0;
				if (!empty($this->data['Comment']['comments'])) {
					foreach ((array)$this->data['Comment']['comments'] as $comment_id) {
						if (!empty($comment_id) && (!$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) && !$this->AuthorsBlog->hasAny(array('author_id'=>$this->Auth->user('id'), 'blog_id'=>$this->Comment->field('Post.blog_id', array('Comment.id'=>$comment_id)))))) {
							return false;
						}
					}
				} else return true;
			} else if (($this->params['action']=='admin_categorize')) {
				if (!empty($this->params['pass'][0]) && ($blog_id=$this->Post->field('blog_id', array('id'=>$this->params['pass'][0])))) {
					return 
						Configure::read('LilBlogsPlugin.noBlogs') ||
						$this->Auth->user(Configure::read('LilBlogsPlugin.authorAdminField')) ||
						$this->AuthorsBlog->hasAny(array('author_id'=>$this->Auth->user('id'), 'blog_id'=>$blog_id));
				} else return false;
			}
		}
		return true;
	}
/**
 * index method
 *
 * @access public
 * @return void
 */
	function index() {
		$blog_name = '';
		if (!empty($this->params['blogname'])) {
			$blog_name = $this->params['blogname'];
		} else if (!empty($this->params['named']['blogname'])) {
			$blog_name = $this->params['named']['blogname'];
		} else if (!empty($this->params['pass'][0])) {
			$blog_name = $this->params['pass'][0];
		}
		
		if (!$blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			$blog = $this->Comment->Post->Blog->find('first', array('conditions' => array('Blog.short_name' => $blog_name)));
		}
		
		$post_id = null;
		if (!empty($blog['Blog']['id'])) {
			if (!empty($this->params['postid']) && is_numeric($this->params['postid'])) {
				$post_id = $this->params['postid'];
			} else if (!empty($this->params['named']['postid']) && is_numeric($this->params['named']['postid'])) {
				$post_id = $this->params['named']['postid'];
			} else if (!empty($this->params['post'])) {
				$post_id = $this->Comment->Post->field('id', array(
					'Post.blog_id' => $blog_id,
					'Post.slug'    => $this->params['post'], 
				));
			} else if (!empty($this->params['named']['post'])) {
				$post_id = $this->Comment->Post->field('id', array(
					'Post.blog_id' => $blog_id,
					'Post.slug'    => $this->params['named']['post'], 
				));
		 	} else if (!empty($this->params['pass'][1]) && is_numeric($this->params['pass'][1])) {
		 		$post_id = $this->params['pass'][1];
		 	} else if (!empty($this->params['pass'][1]) && !empty($this->params['pass'][1])) {
				$post_id = $this->Comment->Post->field('id', array(
					'Post.blog_id' => $blog_id,
					'Post.slug'    => $this->params['pass'][1], 
				));
			}
		}
		
		$params = array(
			'conditions'=> array(
				'Comment.status' => 2,
				'Post.status'    => 2
			),
			'limit'   => 50,
		);
		
		if (Configure::read('LilBlogsPlugin.noBlogs')) {
			$params['contain'] = array('Post');
		} else {
			$params['contain'] = array('Post' => 'Blog');
		}
		
		if (!empty($blog['Blog']['id'])) {
			$params['conditions']['Post.blog_id'] = $blog['Blog']['id'];
			
			if ($post_id && ($post_title = $this->Comment->Post->field('title', array('Post.id' => $post_id)))) {
				$rss_title = sprintf(__d('lil_blogs', 'Comments on %1$s for %2$s', true),
					$blog['Blog']['name'],
					$post_title
				);
			} else {
				$rss_title = __d('lil_blogs', 'Comments for', true).' '.$blog['Blog']['name'];
			}
			$rss_descript = $blog['Blog']['description'];
		} else {
			$blog_name = '';
			$rss_title = __d('lil_blogs', 'LilBlogs comments', true);
			$rss_descript = __d('lil_blogs', 'Coments from every single blog on', true).' '.Router::url('/', true);
		}
		
		if ($this->RequestHandler->prefers('rss') == 'rss') {
			Configure::write('debug', 0);
			$this->set('channel', array('title' => 	$rss_title, 'description' => $rss_descript));
			$params['limit'] = Configure::read('LilBlogsPlugin.rssItems');
		}
		
		$recentcomments = $this->Comment->find('all', $params);
		$this->set(compact('blog', 'recentcomments'));
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
			if ($this->Comment->save($this->data)) {
				if ($this->data['Comment']['status']==BLOGSPAM_HAM || $this->data['Comment']['status']==BLOGSPAM_SPAM) {
					$this->BlogSpam->untrain($this->Comment->id);
					$this->BlogSpam->train($this->Comment->id, $this->data['Comment']['status'], $this->data['Comment']);
				}
				
				$this->Session->setFlash(__d('lil_blogs', 'Comment has been saved.', true));
				$this->redirect(array('action' => 'admin_index', $this->data['Comment']['post_id']));
			}
		} else if (!is_numeric($id) || !($this->data = $this->Comment->read(null, $id))) {
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
	function admin_delete($id) {
		if ($post_id = $this->Comment->field('post_id', array('Comment.id' => $id))) {
			$this->Comment->delete($id);
			$this->Session->setFlash(__d('lil_blogs', 'Comment has been deleted', true));
			$this->redirect(array('action' => 'admin_index', $post_id));
		} else {
			$this->error404();
		}
	}
/**
 * admin_index method
 *
 * @param int $postid
 * @access public
 * @return void
 */
	function admin_index($postid=null) {
		$this->Comment->recursive = 0;
		$conditions = array();
		if(is_numeric($postid) && $postid > 0) {
			$conditions = array('Comment.post_id' => $postid);
			$post = $this->Comment->Post->read(null, $postid);
			$blog_id = $post['Post']['blog_id'];
			$this->set(compact('post'));
		} else if (!empty($this->params['named']['blog_id']) && is_numeric($this->params['named']['blog_id'])) {
			$blog_id = $this->params['named']['blog_id'];
			$conditions = array('Post.blog_id' => $blog_id);
		} else {
			$this->error404();
			return;
		}
		
		if (!empty($this->params['named']['status']) &&
		in_array($this->params['named']['status'], array(0, 1, 2)))
		{
		    $conditions['Comment.status'] = $this->params['named']['status'];
		}
		
		$data = $this->paginate('Comment', $conditions);
		array_walk($data, array($this, '_clean'));
		$this->set('comments', $data);
		
		if (!$blog = Configure::read('LilBlogsPlugin.noBlogs')) {
			$blog = $this->Comment->Post->Blog->find('first', array('conditions' => array('Blog.id' => $blog_id)));
		}
		
		unset($conditions['Comment.status']);
		$this->set('count_all', $this->Comment->find('count', array('conditions' => $conditions)));
		$this->set('count_ham', $this->Comment->find('count', array('conditions' => array_merge(
			$conditions, array('Comment.status' => BLOGSPAM_HAM)))));
		$this->set('count_spam', $this->Comment->find('count', array('conditions' => array_merge(
			$conditions, array('Comment.status' => BLOGSPAM_SPAM)))));
		$this->set('count_unknown', $this->Comment->find('count', array('conditions' => array_merge(
			$conditions, array('Comment.status' => BLOGSPAM_UNKNOWN)))));
		
		$this->set(compact('blog'));
	}
/**
 * admin_quick method
 *
 * @access public
 * @return void
 */
	function admin_quick() {
		if (!empty($this->data['Comment']['comments']) && !empty($this->data['Comment']['action']) && in_array($this->data['Comment']['action'], array('delete', 'spam', 'ham'))) {
			foreach ((array)$this->data['Comment']['comments'] as $comment_id) {
				if (!empty($comment_id) && $comment = $this->Comment->read(null, $comment_id)) {
					if ($this->data['Comment']['action']=='ham') {
						$comment['Comment']['status'] = BLOGSPAM_HAM;
					} else if ($this->data['Comment']['action']=='spam') {
						$comment['Comment']['status'] = BLOGSPAM_SPAM;
					}
					if ($this->data['Comment']['action']=='delete') {
						$this->Comment->del($comment['Comment']['id']);
					} else {
						if ($this->Comment->save($comment)) {
							$this->BlogSpam->untrain($comment['Comment']['id']);
							$this->BlogSpam->train($comment['Comment']['id'], $comment['Comment']['status'], $comment['Comment']);
						}
					}
				}
			}
			$this->Session->setFlash(__d('lil_blogs', 'Action completed.', true));
		} else {
			$this->Session->setFlash(__d('lil_blogs', 'No comments or action selected', true), 'error');
		}
		$this->redirect($this->referer());
	}
/**
 * admin_categorize method
 *
 * @access public
 * @return void
 */
	function admin_categorize($comment_id, $comment_status) {
		if (($comment_status==BLOGSPAM_HAM || $comment_status==BLOGSPAM_SPAM) &&
			$data = $this->Comment->read(null, $comment_id))
		{
			$this->BlogSpam->untrain($this->Comment->id);
			$data['Comment']['status'] = $comment_status;
			$this->Comment->saveField('status', $comment_status);
			$this->BlogSpam->train($this->Comment->id, $data['Comment']['status'], $data['Comment']);
			
			if ($comment_status == BLOGSPAM_HAM) {
				$this->Session->setFlash(__d('lil_blogs', 'Comment has been successfuly marked as HAM.', true));
			} else {
				$this->Session->setFlash(__d('lil_blogs', 'Comment has been successfuly marked as SPAM.', true));
			}
			
			$this->redirect(array(
				'admin' => true,
				'action' => 'index',
				$data['Comment']['post_id']
			));
		} else {
			$this->error404;
		}
	}
/**
 * _clean method
 *
 * @param mixed $data 
 * @access private
 * @return void
 */
	function _clean(&$data)	{
		$data['Comment']['body'] = $this->BlogSpam->clean($data['Comment']['body']);
	}
}
?>