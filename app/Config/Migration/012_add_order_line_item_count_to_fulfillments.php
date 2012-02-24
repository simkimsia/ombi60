<?php
class M4f47318447c8463e894205fd1507707a extends CakeMigration {

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
				'fulfillments' => array(
					'order_line_item_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5, 'collate' => NULL, 'comment' => '', 'after' => 'tracking_number'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'fulfillments' => array('order_line_item_count',),
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
