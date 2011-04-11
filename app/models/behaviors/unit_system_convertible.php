<?php
/**
 * Copyable Behavior class file.
 *
 * Adds ability to copy a model record, including all hasMany and hasAndBelongsToMany
 * associations. Relies on Containable behavior, which this behavior will attach
 * on the fly as needed.
 * 
 * HABTM relationships are just duplicated in the join table, while hasMany and hasOne
 * records are recursively copied as well.
 *
 * Usage is straightforward:
 * From model: $this->copy($id); // id = the id of the record to be copied
 * From container: $this->MyModel->copy($id);
 *
 * @filesource
 * @author			Jamie Nay
 * @copyright       Jamie Nay
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link            http://github.com/jamienay/copyable_behavior
 */
class UnitSystemConvertibleBehavior extends ModelBehavior {
	/**
	 * Behavior settings
	 * 
	 * @access public
	 * @var array
	 */
	public $settings = array();
	
	
	/**
	 * Default values for settings.
	 *
	 * - recursive: whether to copy hasMany and hasOne records
	 * - habtm: whether to copy hasAndBelongsToMany associations
	 * - stripFields: fields to strip during copy process
	 *
	 * @access private
	 * @var array
	 */
        
    private $defaults = array(
    	'unit' => 'metric',
    );

    /**
     * Configuration method.
     *
     * @param object $Model Model object
     * @param array $config Config array
     * @access public
     * @return boolean
     */
    public function setup($Model, $config = array()) {
    	$this->settings[$Model->alias] = array_merge($this->defaults, $config);
    	return true;
	}
	
	/**
	 * Assuming there will be a weight/length/height key-value pair inside
	 * dataArray, and assuming there will NOT be a displayed_weight/displayed_length/displayed_height
	 * key-value pair
	 *
	 * Assuming weight is stored in grams
	 * Assuming height and length is in millimetres
	 *
	 * Assuming the unit if not already set in settings will either be metric or imperial
	 * if $unit is null, we use the default setting
	 *
	 * @param object $Model model object
	 * @param mixed $id String or integer model ID
	 * @access public
	 * @return boolean
	 */
	public function convertForDisplay($Model, $dataArray=array(), $unit = null) {
		
		if ($unit == null) {
			$unit = $this->settings['unit'];
		}
		
		if ($unit === 'imperial') {
			$weightMultiplier = 0.00220462262;
			$lengthMultiplier = 0.0393700787;
		} else {
			$weightMultiplier = 0.001;
			$lengthMultiplier = 0.1;
		}
		
		
		
		$weight_exists = array_key_exists('weight', $dataArray[$Model->alias]);
		$height_exists = array_key_exists('height', $dataArray[$Model->alias]);
		$length_exists = array_key_exists('length', $dataArray[$Model->alias]);
		
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($weight_exists) {
			$result_weight = $dataArray[$Model->alias]['weight'] * $weightMultiplier;
                        $dataArray[$Model->alias]['displayed_weight'] = $number->precision($result_weight, 1);
			
                } 
		
		if ($height_exists) {
			$result_height = $dataArray[$Model->alias]['height'] * $lengthMultiplier;
                        $dataArray[$Model->alias]['displayed_height'] = $number->precision($result_height, 1);
			
                }
		
		if ($length_exists) {
			$result_length = $dataArray[$Model->alias]['length'] * $lengthMultiplier;
                        $dataArray[$Model->alias]['displayed_length'] = $number->precision($result_length, 1);
                }
		
		return $dataArray;
	}
	
	/**
	 * Assuming there will be a weight/length/height key-value pair inside
	 * 
	 * dataArray is the actual stored data and
	 *
	 * assuming the displayed_weight/displayed_length/displayed_height
	 * key-value pair
	 *
	 * is to be displayed but not stored
	 * 
	 * Assuming weight is stored in grams
	 * Assuming height and length is in millimetres
	 *
	 * Assuming the unit if not already set in settings will either be metric or imperial
	 * if $unit is null, we use the default setting
	 *
	 * @param object $Model model object
	 * @param mixed $id String or integer model ID
	 * @access public
	 * @return boolean
	 */
	public function convertForSave($Model, $dataArray=array(), $unit = null) {
		
		if ($unit == null) {
			$unit = $this->settings['unit'];
		}
		
		if ($unit === 'imperial') {
			$weightMultiplier = 0.00220462262;
			$lengthMultiplier = 0.0393700787;
		} else {
			$weightMultiplier = 0.001;
			$lengthMultiplier = 0.1;
		}
		
		
		
		$weight_exists = array_key_exists('displayed_weight', $dataArray[$Model->alias]);
		$height_exists = array_key_exists('displayed_height', $dataArray[$Model->alias]);
		$length_exists = array_key_exists('displayed_length', $dataArray[$Model->alias]);
		
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($weight_exists) {
			$result_weight = $dataArray[$Model->alias]['displayed_weight'] / $weightMultiplier;
                        $dataArray[$Model->alias]['weight'] = $number->precision($result_weight, 0);
			
                } 
		
		if ($height_exists) {
			$result_height = $dataArray[$Model->alias]['displayed_height'] / $lengthMultiplier;
                        $dataArray[$Model->alias]['height'] = $number->precision($result_height, 0);
			
                }
		
		if ($length_exists) {
			$result_length = $dataArray[$Model->alias]['displayed_length'] / $lengthMultiplier;
                        $dataArray[$Model->alias]['length'] = $number->precision($result_length, 0);
                }
		
		return $dataArray;
	}
	
	
}
