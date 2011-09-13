<?php

App::import('Model', 'Model');
App::import('Controller', 'Controller');

class TestModel extends CakeTestModel
{
	public $useDbConfig	= 'test_suite';

	public $actsAs	= array(
		'Containable',
		'Linkable.Linkable'
	);
}

class User extends TestModel
{
	public $hasOne	= array(
		'Profile'
	);

	public $hasMany	= array(
		'Comment'
	);
}

class Profile extends TestModel
{
	public $belongsTo	= array(
		'User'
	);
}

class Post extends TestModel
{
	public $belongsTo	= array(
		'User'
	);

	public $hasAndBelongsToMany	= array(
		'Tag'
	);
}

class PostTag extends TestModel
{
}

class Tag extends TestModel
{
	public $hasAndBelongsToMany	= array(
		'Post'
	);

	public $belongsTo	= array(
		'Parent'	=> array(
			'className'	=> 'Tag',
			'foreignKey'	=> 'parent_id'
		)
	);
}

class LegacyProduct extends TestModel
{
	public $primaryKey	= 'product_id';

	public $belongsTo	= array(
		'Maker'	=> array(
			'className'	=> 'LegacyCompany',
			'foreignKey'	=> 'the_company_that_builds_it_id'
		),
		'Transporter'	=> array(
			'className'	=> 'LegacyCompany',
			'foreignKey'	=> 'the_company_that_delivers_it_id'
		)
	);
}

class LegacyCompany extends TestModel
{
	public $primaryKey	= 'company_id';

	public $hasMany	= array(
		'ProductsMade'	=> array(
			'className'		=> 'LegacyProduct',
			'foreignKey'	=> 'the_company_that_builds_it_id'
		)
	);
}

class LinkableTestCase extends CakeTestCase
{
	public $fixtures	= array(
		'plugin.linkable.user',
		'plugin.linkable.profile',
		'plugin.linkable.generic',
		'plugin.linkable.comment',
		'plugin.linkable.post',
		'plugin.linkable.posts_tag',
		'plugin.linkable.tag',
		'plugin.linkable.user',
		'plugin.linkable.legacy_product',
		'plugin.linkable.legacy_company'
	);

	public $Post;

	public function startTest()
	{
		$this->User	=& ClassRegistry::init('User');
	}

	public function testBelongsTo()
	{
		$arrayExpected	= array(
			'User'	=> array('id' => 1, 'username' => 'CakePHP'),
			'Profile'	=> array ('id' => 1, 'user_id' => 1, 'biography' => 'CakePHP is a rapid development framework for PHP that provides an extensible architecture for developing, maintaining, and deploying applications.')
		);

		$arrayResult	= $this->User->find('first', array(
			'contain'	=> array(
				'Profile'
			)
		));
		$this->assertTrue(isset($arrayResult['Profile']), 'belongsTo association via Containable: %s');
		$this->assertEqual($arrayResult, $arrayExpected, 'belongsTo association via Containable: %s');

		// Same association, but this time with Linkable
		$arrayResult	= $this->User->find('first', array(
			'fields'	=> array(
				'id',
				'username'
			),
			'contain'	=> false,
			'link'		=> array(
				'Profile'	=> array(
					'fields'	=> array(
						'id',
						'user_id',
						'biography'
					)
				)
			)
		));

		$this->assertTrue(isset($arrayResult['Profile']), 'belongsTo association via Linkable: %s');
		$this->assertTrue(!empty($arrayResult['Profile']), 'belongsTo association via Linkable: %s');
		$this->assertEqual($arrayResult, $arrayExpected, 'belongsTo association via Linkable: %s');

		// Linkable association, no field lists
		$arrayResult	= $this->User->find('first', array(
			'contain'	=> false,
			'link'		=> array(
				'Profile'
			)
		));

		$this->assertTrue(isset($arrayResult['Profile']), 'belongsTo association via Linkable (automatic fields): %s');
		$this->assertEqual($arrayResult, $arrayExpected, 'belongsTo association via Linkable (automatic fields): %s');

		// On-the-fly association via Linkable
		$arrayExpected	= array(
			'User'	=> array('id' => 1, 'username' => 'CakePHP'),
			'Generic'	=> array('id' => 1, 'text' => '')
		);

		$arrayResult	= $this->User->find('first', array(
			'contain'	=> false,
			'link'		=> array(
				'Generic'	=> array(
					'class'		=> 'Generic',
					'conditions'	=> 'User.id = Generic.id',
					'fields'	=> array(
						'id',
						'text'
					)
				)
			)
		));

		$this->assertTrue(isset($arrayResult['Generic']), 'On-the-fly belongsTo association via Linkable: %s');
		$this->assertEqual($arrayResult, $arrayExpected, 'On-the-fly belongsTo association via Linkable: %s');

		// On-the-fly association via Linkable, with order on the associations' row
		$arrayExpected	= array(
			'User'	=> array('id' => 4, 'username' => 'CodeIgniter'),
			'Generic'	=> array('id' => 4, 'text' => '')
		);

		$arrayResult	= $this->User->find('first', array(
			'contain'	=> false,
			'link'		=> array(
				'Generic'	=> array(
					'class'		=> 'Generic',
					'conditions'	=> 'User.id = Generic.id',
					'fields'	=> array(
						'id',
						'text'
					)
				)
			),
			'order'		=> 'Generic.id DESC'
		));

		$this->assertEqual($arrayResult, $arrayExpected, 'On-the-fly belongsTo association via Linkable, with order: %s');
	}

	public function testHasMany()
	{
		// hasMany association via Containable. Should still work when Linkable is loaded
		$arrayExpected	= array(
			'User'	=> array('id' => 1, 'username' => 'CakePHP'),
			'Comment'	=> array(
				0	=> array(
					'id'		=> 1,
					'user_id'	=> 1,
					'body'		=> 'Text'
				),
				1	=> array(
					'id'		=> 2,
					'user_id'	=> 1,
					'body'		=> 'Text'
				),
			)
		);

		$arrayResult	= $this->User->find('first', array(
			'contain'	=> array(
				'Comment'
			),
			'order'	=> 'User.id ASC'
		));
		$this->assertTrue(isset($arrayResult['Comment']), 'hasMany association via Containable: %s');
		$this->assertEqual($arrayResult, $arrayExpected, 'hasMany association via Containable: %s');

		// Same association, but this time with Linkable
		$arrayExpected	= array(
			'User'	=> array('id' => 1, 'username' => 'CakePHP'),
			'Comment'	=> array(
				'id'		=> 1,
				'user_id'	=> 1,
				'body'		=> 'Text'
			)
		);

		$arrayResult	= $this->User->find('first', array(
			'fields'	=> array(
				'id',
				'username'
			),
			'contain'	=> false,
			'link'		=> array(
				'Comment'	=> array(
					'fields'	=> array(
						'id',
						'user_id',
						'body'
					)
				)
			),
			'order'		=> 'User.id ASC',
			'group'		=> 'User.id'
		));

		$this->assertEqual($arrayResult, $arrayExpected, 'hasMany association via Linkable: %s');
	}

	public function testComplexAssociations()
	{
		$this->Post	=& ClassRegistry::init('Post');

		$arrayExpected	= array(
			'Post'	=> array('id' => 1, 'title'	=> 'Post 1', 'user_id' => 1),
			'Tag'	=> array('name'	=> 'General'),
			'Profile'	=> array('biography' => 'CakePHP is a rapid development framework for PHP that provides an extensible architecture for developing, maintaining, and deploying applications.'),
			'MainTag'	=> array('name'	=> 'General'),
			'Generic'	=> array('id' => 1,'text' => ''),
			'User'	=> array('id' => 1, 'username' => 'CakePHP')
		);

		$arrayResult	= $this->Post->find('first', array(
			'conditions'	=> array(
				'MainTag.id'	=> 1
			),
			'link'	=> array(
				'User'	=> array(
					'conditions'	=> 'Post.user_id = User.id',
					'Profile'	=> array(
						'fields'	=> array(
							'biography'
						),
						'Generic'	=> array(
							'class'			=> 'Generic',
							'conditions'	=> 'User.id = Generic.id'
						)
					)
				),
				'Tag'	=> array(
					'table'		=> 'tags',
					'fields'	=> array(
						'name'
					)
				),
				'MainTag'	=> array(
					'class'	=> 'Tag',
					'conditions'	=> 'PostsTag.post_id = Post.id',
					'fields'	=> array(
						'MainTag.name'	// @fixme Wants to use class name (Tag) instead of alias (MainTag)
					)
				)
			)
		));

		$this->assertEqual($arrayExpected, $arrayResult, 'Complex find: %s');

		// Linkable and Containable combined
		$arrayExpected	= array(
			'Post'	=> array('id' => 1, 'title'	=> 'Post 1', 'user_id' => 1),
			'Tag'	=> array(
				array('id' => 1, 'name' => 'General', 'parent_id' => null, 'PostsTag' => array('id' => 1, 'post_id' => 1, 'tag_id' => 1, 'main' => 0)),
				array('id' => 2, 'name' => 'Test I', 'parent_id' => 1, 'PostsTag' => array('id' => 2, 'post_id' => 1, 'tag_id' => 2, 'main' => 1))
			),
			'User'	=> array('id' => 1, 'username' => 'CakePHP')
		);

		$arrayResult	= $this->Post->find('first', array(
			'contain'	=> array(
				'Tag'
			),
			'link'		=> array(
				'User'	=> array(
					'conditions' => 'User.id = Post.user_id'
				)
			)
		));

		$this->assertEqual($arrayResult, $arrayExpected, 'Linkable and Containable combined: %s');
	}

	public function testPagination()
	{
		$objController	= new Controller();
		$objController->uses	= array('User');
		$objController->constructClasses();
		$objController->params['url']['url']	= '/';

		$objController->paginate	= array(
			'fields'	=> array(
				'username'
			),
			'contain'	=> false,
			'link'		=> array(
				'Profile'	=> array(
					'fields'	=> array(
						'biography'
					)
				)
			),
			'limit'		=> 2
		);

		$arrayResult	= $objController->paginate('User');

		$this->assertEqual($objController->params['paging']['User']['count'], 4, 'Paging: total records count: %s');

		// Pagination with order on a row from table joined with Linkable
		$objController->paginate	= array(
			'fields'	=> array(
				'id'
			),
			'contain'	=> false,
			'link'		=> array(
				'Profile'	=> array(
					'fields'	=> array(
						'user_id'
					)
				)
			),
			'limit'		=> 2,
			'order'		=> 'Profile.user_id DESC'
		);

		$arrayResult	= $objController->paginate('User');

		$arrayExpected	= array(
			0	=> array(
				'User'	=> array(
					'id' => 4
				),
				'Profile'	=> array ('user_id'	=> 4)
			),
			1	=> array(
				'User'	=> array(
					'id' => 3
				),
				'Profile'	=> array ('user_id'	=> 3)
			)
		);

		$this->assertEqual($arrayResult, $arrayExpected, 'Paging with order on join table row: %s');

		// Pagination without specifying any fields
		$objController->paginate	= array(
			'contain'	=> false,
			'link'		=> array(
				'Profile'
			),
			'limit'		=> 2,
			'order'		=> 'Profile.user_id DESC'
		);

		$arrayResult	= $objController->paginate('User');
		$this->assertEqual($objController->params['paging']['User']['count'], 4, 'Paging without any field lists: total records count: %s');
	}

	/**
	 *	Series of tests that assert if Linkable can adapt to assocations that
	 *	have aliases different from their standard model names
	 */
	public function testNonstandardAssociationNames()
	{
		$this->Tag	=& ClassRegistry::init('Tag');

		$arrayExpected	= array(
			'Tag'	=> array(
				'name'	=> 'Test I'
			),
			'Parent'	=> array(
				'name'	=> 'General'
			)
		);

		$arrayResult	= $this->Tag->find('first', array(
			'fields'	=> array(
				'name'
			),
			'conditions'	=> array(
				'Tag.id'	=> 2
			),
			'link'	=> array(
				'Parent'	=> array(
					'fields'	=> array(
						'name'
					)
				)
			)
		));

		$this->assertEqual($arrayExpected, $arrayResult, 'Association with non-standard name: %s');


		$this->LegacyProduct	=& ClassRegistry::init('LegacyProduct');

		$arrayExpected	= array(
			'LegacyProduct'	=> array(
				'name'	=> 'Velocipede'
			),
			'Maker'	=> array(
				'company_name'	=> 'Vintage Stuff Manufactory'
			),
			'Transporter'	=> array(
				'company_name'	=> 'Joe & Co Crate Shipping Company'
			)
		);

		$arrayResult	= $this->LegacyProduct->find('first', array(
			'fields'	=> array(
				'name'
			),
			'conditions'	=> array(
				'LegacyProduct.product_id'	=> 1
			),
			'link'	=> array(
				'Maker'	=> array(
					'fields'	=> array(
						'company_name'
					)
				),
				'Transporter'	=> array(
					'fields'	=> array(
						'company_name'
					)
				)
			)
		));

		$this->assertEqual($arrayExpected, $arrayResult, 'belongsTo associations with custom foreignKey: %s');

		$arrayExpected	= array(
			'ProductsMade'	=> array(
				'name'	=> 'Velocipede'
			),
			'Maker'	=> array(
				'company_name'	=> 'Vintage Stuff Manufactory'
			)
		);

		$arrayResult	= $this->LegacyProduct->Maker->find('first', array(
			'fields'	=> array(
				'company_name'
			),
			'conditions'	=> array(
				'Maker.company_id'	=> 1
			),
			'link'	=> array(
				'ProductsMade'	=> array(
					'fields'	=> array(
						'name'
					)
				)
			)
		));

		$this->assertEqual($arrayExpected, $arrayResult, 'hasMany association with custom foreignKey: %s');
	}
}
