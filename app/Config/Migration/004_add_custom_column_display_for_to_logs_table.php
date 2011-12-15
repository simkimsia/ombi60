<?php
class M4ee9e7f070504201a7c156a91507707a extends CakeMigration {

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
				'display_for' => array('type' => 'integer', 'length' => 2, 'null' => false, 'default' => 0),
			),
		),
		
		),
		'down' => array(
			'drop_field' => array(
				'logs' => array(
					'display_for'
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
