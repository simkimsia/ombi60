<?php
class M4f3f5cc9f8c443fba615070c1507707a extends CakeMigration {

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
				'order_line_items' => array(
					'fulfillment_id' => array('type' => 'integer', 'length' => 11, 'null' => true, 'default' => NULL, 'collate' => null, 'comment' => '', 'after' => 'variant_title'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'order_line_items' => array('fulfillment_id',),
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
