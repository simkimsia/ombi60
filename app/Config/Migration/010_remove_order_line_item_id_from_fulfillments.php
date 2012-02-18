<?php
class M4f3f70ed0bd44e26a21509881507707a extends CakeMigration {

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
				'fulfillments' => array(
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					)
				)
			),
			'drop_field' => array(
				'fulfillments' => array('order_line_item_id',),
			),
			'create_field' => array(
				'order_line_items' => array(
					'fulfillment_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => NULL, 'comment' => '', 'after' => 'variant_title'),
				)
			)
		),
		'down' => array(
			
			'drop_field' => array(
				'order_line_items' => array('fulfillment_id',)
			),
			
			'create_field' => array(
				'fulfillments' => array(
					'order_line_item_id' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 11, 'collate' => NULL, 'comment' => '', 'after' => 'order_id'),
				),
			),
			'alter_field' => array(
				'fulfillments' => array(
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'order_to_item' => array('column' => array('order_id', 'order_line_item_id'), 'unique' => 1
						)
					)
				)
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
