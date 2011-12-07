<?php
class M4eb0735d86c44d5c8ec921cb1507707a extends CakeMigration {

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
				'shop_settings' => array(
					'users_accepted' => array('type' => 'string', 'length' => 10,  'null' => false, 'default' => 'guest'),
				),
			)
		),
		'down' => array(
			'drop_field' => array(
				'shop_settings' => array(
					'users_accepted'
				),
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
		return true;
	}
}
