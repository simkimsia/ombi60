<?php
class M4f19fdbe4314437d83b311d21507707a extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'posts' => array(
					'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => '', 'after' => 'id'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(

				'posts' => array('shop_id',),

			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		
		if ($direction == 'up') {
			$this->updateShopIdInPosts();
		}

		return true;
	}
	
	private function updateShopIdInPosts() {
		/* update all the Post records to have the corresponding shop_id of the blog */
		$blogModel = ClassRegistry::init('Blog');
		$blogs = $blogModel->find('all', array(
			'fields' => array(
				'Blog.id', 'Blog.shop_id'
			)
		));
		
		foreach($blogs as $blog) {
			$blogId = $blog['Blog']['id'];
			$shopId = $blog['Blog']['shop_id'];
			$blogModel->Post->updateAll(array(
				'Post.shop_id' => $shopId
			), 
			array(
				'Post.blog_id' => $blogId
			));
		}
	}
}
