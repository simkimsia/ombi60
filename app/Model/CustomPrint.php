<?php
App::uses('AppModel', 'Model');
/**
 * CustomPrint Model
 *
 * @property Product $Product
 */
class CustomPrint extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	// default sticker stats for ChildLabel Custom Print function
	public $optionsData = array(
		'saved_img' => array(
			'width' => 260,
			'height' => 75
		),
		'font' => array(
			'file' => 'AmericanTypewriter.ttc',
			'size' => 32,
			'color' => array(
				'yellow' => '#FEF94B',
			)
		),
		'text' => array(
			'xpos' => 0,
			'ypos'	=> 28,
			'angle' => 0,
			'line_height' => 36,
			'max_width_allowed' => 190
		),
	);
	
	
}
