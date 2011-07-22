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
	'weight_fields' => array(),
	'length_fields' => array(),
	'model_name' => null,
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
	public function convertForDisplay(&$Model, $dataArray=array(), $unit = null, $primary=true) {
		/** check for the model used for the conversion **/
		$alias = $Model->alias;
		
		if ($this->settings[$Model->alias]['model_name']!= null) {
			$alias = $this->settings[$Model->alias]['model_name'];
			$this->settings[$alias] = $this->settings[$Model->alias];
		}
		
		if ($unit == null) {
			$unit = $this->settings[$alias]['unit'];
		}
		
		if ($unit === 'imperial') {
			$weightMultiplier = 0.00220462262;
			$lengthMultiplier = 0.0393700787;
		} else {
			$weightMultiplier = 0.001;
			$lengthMultiplier = 0.1;
		}
		
		if ($dataArray == null) {
			return $dataArray;
		}
		
		// this is crucial since we have different find results
		// works in conjunction with code in lower part
		// Ctrl + F for afterFind special consideration
		$mainPrimaryDataArray = ($primary) ? $dataArray[$alias] : $dataArray;
		
		$weight_exists = array_key_exists('weight', $mainPrimaryDataArray);
		$height_exists = array_key_exists('height', $mainPrimaryDataArray);
		$length_exists = array_key_exists('length', $mainPrimaryDataArray);
		
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($weight_exists) {
			$result_weight = $mainPrimaryDataArray['weight'] * $weightMultiplier;
                        $mainPrimaryDataArray['displayed_weight'] = $number->precision($result_weight, 1);
			
                } 
		
		if ($height_exists) {
			$result_height = $mainPrimaryDataArray['height'] * $lengthMultiplier;
                        $mainPrimaryDataArray['displayed_height'] = $number->precision($result_height, 1);
			
                }
		
		if ($length_exists) {
			$result_length = $mainPrimaryDataArray['length'] * $lengthMultiplier;
                        $mainPrimaryDataArray['displayed_length'] = $number->precision($result_length, 1);
                }
		
		// for the other weight fields
		$mainPrimaryDataArray = $this->convertOtherWeightFieldsForDisplay($alias, $mainPrimaryDataArray, $weightMultiplier);
		
		// this is crucial since we have different find results
		// this works in conjunction with line 106.
		// Ctrl + F for afterFind special consideration
		if ($primary) {
			$dataArray[$alias]  = $mainPrimaryDataArray;
		} else {
			$dataArray = $mainPrimaryDataArray;
		}
		
		return $dataArray;
	}
	
	private function convertOtherWeightFieldsForDisplay($alias, $dataArray, $weightMultiplier) {
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($dataArray == null) {
			return $dataArray;
		}
		
		foreach($this->settings[$alias]['weight_fields'] as $weightField){
			// does the field exist?
			$field_exists = array_key_exists($weightField, $dataArray);
			if ($field_exists) {
				$result_weight = $dataArray[$weightField] * $weightMultiplier;
				$dataArray['displayed_' . $weightField] = $number->precision($result_weight, 1);
			}
		}
		
		return $dataArray;
	}
	
	private function convertOtherWeightFieldsForSave($alias, $dataArray, $weightMultiplier) {
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($dataArray == null) {
			return $dataArray;
		}
		
		foreach($this->settings[$alias]['weight_fields'] as $weightField){
			// does the displayed_ field exist?
			$displayedWeightField = 'displayed_' . $weightField;
			$field_exists = array_key_exists($displayedWeightField, $dataArray[$alias]);
			if ($field_exists) {
				$result_weight = $dataArray[$alias][$displayedWeightField] / $weightMultiplier;
				$dataArray[$alias][$weightField] = $number->precision($result_weight, 0);
			}
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
	public function convertForSave(&$Model, $dataArray=array(), $unit = null) {
		
		/** check for the model used for the conversion **/
		$alias = $Model->alias;
		if ($this->settings[$Model->alias]['model_name']!= null) {
			$alias = $this->settings[$Model->alias]['model_name'];
			$this->settings[$alias] = $this->settings[$Model->alias];
		}
		
		if ($unit == null) {
			$unit = $this->settings[$alias]['unit'];
		}
		
		if ($unit === 'imperial') {
			$weightMultiplier = 0.00220462262;
			$lengthMultiplier = 0.0393700787;
		} else {
			$weightMultiplier = 0.001;
			$lengthMultiplier = 0.1;
		}
		
		if ($dataArray == null) {
			return $dataArray;
		}
		
		$weight_exists = array_key_exists('displayed_weight', $dataArray[$alias]);
		$height_exists = array_key_exists('displayed_height', $dataArray[$alias]);
		$length_exists = array_key_exists('displayed_length', $dataArray[$alias]);
		
		App::import('Helper', 'Number');
                $number = new NumberHelper();
		
		if ($weight_exists) {
			$result_weight = $dataArray[$alias]['displayed_weight'] / $weightMultiplier;
                        $dataArray[$alias]['weight'] = $number->precision($result_weight, 0);
			
                } 
		
		if ($height_exists) {
			$result_height = $dataArray[$alias]['displayed_height'] / $lengthMultiplier;
                        $dataArray[$alias]['height'] = $number->precision($result_height, 0);
			
                }
		
		if ($length_exists) {
			$result_length = $dataArray[$alias]['displayed_length'] / $lengthMultiplier;
                        $dataArray[$alias]['length'] = $number->precision($result_length, 0);
                }
		
		// for the other weight fields
		$dataArray = $this->convertOtherWeightFieldsForSave($alias, $dataArray, $weightMultiplier);
		
		return $dataArray;
	}
	
	
}
