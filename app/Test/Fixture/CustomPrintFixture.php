<?php
/**
 * CustomPrintFixture
 *
 */
class CustomPrintFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'options' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'product_id' => '42',
			'options' => 'options data'
		),
		array(
			'id' => '2',
			'product_id' => '43',
			'options' => '{"zh1":{"1+0":{"xpos":19,"ypos":55,"xpos2":0,"ypos2":0,"fontsize":60},"2+0":{"xpos":0,"ypos":53,"xpos2":0,"ypos2":0,"fontsize":53},"3+0":{"xpos":0,"ypos":50,"xpos2":0,"ypos2":0,"fontsize":40}}}'
		),
		array(
			'id' => '3',
			'product_id' => '44',
			'options' => '{"saved_img":{"width":260,"height":75},"font":{"type":"AmericanTypeWriter","size":32,"color":"yellow"},"text":{"xpos":0,"ypos":28,"angle":0,"line_height":36,"max_width_allowed":190,"value":"Lee Ming Xuan"}}'
		),
		array(
			'id' => '4',
			'product_id' => '45',
			'options' => '{"zh1":{"2+0":{"xpos":19,"ypos":55,"xpos2":0,"ypos2":0,"fontsize":60},"3+0":{"xpos":0,"ypos":53,"xpos2":0,"ypos2":0,"fontsize":53},"4+0":{"xpos":0,"ypos":50,"xpos2":0,"ypos2":0,"fontsize":40}},"en1":{"100+0":{"xpos":19,"ypos":55,"xpos2":0,"ypos2":0,"fontsize":60}}}'
		),
	);

}
