<?php
class M4ee9ce7af3b4430e99fb53d61507707a extends CakeMigration {

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
				'logs' => array(
					'shop_id' => array('type' => 'integer', 'length' => 10, 'null' => false, 'default' => 0),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'logs' => array(
					'shop_id'
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
