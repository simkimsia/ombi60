<?php
/* GiftCard Fixture generated on: 2010-09-04 14:09:50 : 1283604890 */
class GiftCardFixture extends CakeTestFixture {
	var $name = 'GiftCard';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'recipient' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'amount' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '7,2'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'from' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'to' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'message' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'delivery' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'gift_card_type_id' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 3),
		'gc_design_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'recipient' => 'Lorem ipsum dolor sit amet',
			'amount' => 1,
			'code' => 'Lorem ipsum dolor sit amet',
			'from' => 'Lorem ipsum dolor sit amet',
			'to' => 'Lorem ipsum dolor sit amet',
			'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2010-09-04 14:54:50',
			'modified' => '2010-09-04 14:54:50',
			'shop_id' => 1,
			'delivery' => '2010-09-04 14:54:50',
			'gift_card_type_id' => 1,
			'gc_design_id' => 1
		),
	);
}
?>