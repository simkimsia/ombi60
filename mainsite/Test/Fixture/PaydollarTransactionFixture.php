<?php
/* PaydollarTransaction Fixture generated on: 2010-12-21 10:12:06 : 1292926866 */
class PaydollarTransactionFixture extends CakeTestFixture {
	var $name = 'PaydollarTransaction';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'src' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'prc' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'ord' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'holder' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'successcode' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 2),
		'ref' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'payref' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'amt' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '12,2'),
		'mpsamt' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '12,2'),
		'mpscur' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 4),
		'mpsforeignamt' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '12,2'),
		'mpsforeigncur' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5),
		'mpsrate' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '12,4'),
		'remark' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'authid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'eci' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 3),
		'payerauth' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2),
		'sourceip' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'ipcountry' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5),
		'paymethod' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'cardissuingcountry' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5),
		'securehash' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'src' => 1,
			'prc' => 1,
			'ord' => 'Lorem ipsum dolor sit amet',
			'holder' => 'Lorem ipsum dolor sit amet',
			'successcode' => 1,
			'ref' => 'Lorem ipsum dolor sit amet',
			'payref' => 'Lorem ipsum dolor sit amet',
			'amt' => 1,
			'mpsamt' => 1,
			'mpscur' => 'Lo',
			'mpsforeignamt' => 1,
			'mpsforeigncur' => 'Lor',
			'mpsrate' => 1,
			'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'authid' => 'Lorem ipsum dolor sit amet',
			'eci' => 'L',
			'payerauth' => '',
			'sourceip' => 'Lorem ipsum dolor ',
			'ipcountry' => 'Lor',
			'paymethod' => 'Lorem ipsum dolor ',
			'cardissuingcountry' => 'Lor',
			'securehash' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>