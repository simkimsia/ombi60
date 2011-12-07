<?php
class M4eb1f7c895044865b5210fc61507707a extends CakeMigration {

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
			'alter_field' => array(
				'users' => array(
					'full_name' => array('null' => true),
					'name_to_call' => array('null' => true)
				)
			)
		),
		'down' => array(
			'alter_field' => array(
				'users' => array(
					'full_name' => array('null' => false),
					'name_to_call' => array('null' => false)
				)
			)
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
