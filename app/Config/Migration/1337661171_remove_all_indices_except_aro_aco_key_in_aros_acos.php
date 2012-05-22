<?php
class RemoveAllIndicesExceptAROACOKEYInArosAcos extends CakeMigration {

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
			'drop_field' => array(
				'aros_acos' => array('indexes' => array('aro_id', 'to_aco', 'to_aro')),
			),
		),
		'down' => array(
			'create_field' => array(
				'aros_acos' => array(
					'indexes' => array(
						'aro_id' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1),
						'to_aco' => array('column' => 'aco_id', 'unique' => 0),
						'to_aro' => array('column' => 'aro_id', 'unique' => 0),
					),
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
