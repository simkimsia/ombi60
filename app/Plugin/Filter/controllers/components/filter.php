<?php
/**
 * Filter component
 *
 * @original concept by Nik Chankov - http://nik.chankov.net
 * @modified and extended by Maciej Grajcarek - http://blog.uplevel.pl
 * @modified again by James Fairhurst - http://www.jamesfairhurst.co.uk
 * @modified yet again by Jose Diaz-Gonzalez - http://josediazgonzalez.com
 * @modified further by Jeffrey Marvin - http://blitztiger.com
 * @incorporating changes made by Matt Curry - http://github.com/mcurry/
 * @version 0.8
 * @author Jeffrey Marvin <support@blitztiger.com>
 * @license	http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package	app
 * @subpackage app.controller.components
 */
class FilterComponent extends Object {

/**
 * Default Component::$params
 *
 * actions:				Actions upon which this component will act upon
 * defaults:			Holds pagination defaults for controller actions.
 * fieldFormatting:		Fields which will replace the regular syntax in where i.e. field = 'value'
 * formOptionsDatetime:	Formatting for datetime fields (unused)
 * paginatorParams:		Paginator params sent in the URL
 * parsed:				Used to tell whether the data options have been parsed
 * redirect:			Used to tell whether to redirect so the url includes filter data
 * useTime:				Used to tell whether time should be used in the filtering
 * separator:			Separator to use between fields in a date input
 * rangeSeparator:		Separator to use between dates in a date range
 * url:					Url variable used in paginate helper (array('url'=>$url));
 * whitelist:			Array of fields and models for which this component may filter
 * useSession:		boolean
 * complicatedRelation:		Array with the key indicating the model name and the value containing the model class itself.
 * the model in question should NOT be the model associated with the controller calling this component.
 * 
 * @var array
 */
	var $settings = array(
		'actions' => array('index'),
		'defaults' => array(),
		'fieldFormatting' => array(
			'string'	=> "LIKE '%%%s%%'",
			'text'		=> "LIKE '%%%s%%'",
			'datetime'	=> "LIKE '%%%s%%'"
		),
		'formOptionsDatetime' => array(),
		'paginatorParams' => array(
			'page',
			'sort',
			'direction',
			'limit'
		),
		'parsed' => false,
		'redirect' => false,
		'useTime' => false,
		'separator' => '/',
		'rangeSeparator' => '-',
		'url' => array(),
		'whitelist' => array(),
		'useSession' => true,
		'complicatedRelation' => array(), 
	);

/**
 * Pagination array for component
 *
 * @var string
 */
	var $paginate = array('conditions' => array());


/**
 * an array of components to be used here
 *
 * @var string
 */
	var $components = array('Session');

/**
 * Initializes FilterComponent for use in the controller
 *
 * @param object $controller A reference to the instantiating controller object
 * @param array $settings Array of settings for the Component
 * @return void
 * @access public
 */
	function initialize(&$controller, $settings = array()) {
	
		$this->settings['actions'] = (empty($settings['actions'])) ? $this->settings['actions'] : (array) $settings['actions'];
	
		if (in_array($controller->action, $this->settings['actions'])) {
			$settings['whitelist'] = (empty($settings['whitelist'])) ? array() : (array) $settings['whitelist'];
			$this->settings = array_merge($this->settings, $settings);
			$this->paginate = array_merge($this->paginate, $controller->paginate);

			$this->processAction($controller);
		}
	
	}

	function processAction(&$controller) {
	
		if (isset($controller->data['reset']) || isset($controller->data['cancel'])) {
			$controllerName = Inflector::underscore($controller->name);
			$this->Session->delete('Filter.' . $controllerName . '.' . $controller->action);
			$controller->redirect(Router::url(array('controller'=>$controllerName, 'action'=>$controller->action),true));
			return;
		}

		$this->processFilters($controller);
		
		foreach ($this->settings['url'] as $key => $value) {
			
			$controller->params['named'][$key] = $value;
			
		}

		$this->settings['formOptionsDatetime'] = array(
			'dateFormat' => 'DMY',
			'empty' => '-',
			'maxYear' => date("Y"),
			'minYear' => date("Y")-2,
			'type' => 'date'
		);
		
	}

/**
 * Builds up a selected datetime for the form helper
 * 
 * @param string $fieldname
 * @return null|string
 */
	function processDatetime($fieldname, $datetime = null) {
		if (isset($this->params['named'][$fieldname])) {
			$exploded = explode('-', $this->params['named'][$fieldname]);
			if (!empty($exploded)) {
				$datetime = '';
				foreach ($exploded as $k => $e) {
					$datetime = (empty($e)) ? (($k == 0) ? '0000' : '00') : $e;
					if ($k != 2) {$datetime .= '-';}
				}
			}
		}
		return $datetime;
	}

/**
 * Function which will change controller->data array
 * 
 * @param object $controller the class of the controller which call this component
 * @access public
 */
	function processFilters(&$controller) {
		$controller = $this->_prepareFilter($controller);

		// Set default filter values
		$controller->data = array_merge($this->settings['defaults'], $controller->data);
		$redirectData = array();
		
		if (isset($controller->data)) {
			foreach ($controller->data as $model => $fields) {
			
				$modelFieldNames = array();

				if (isset($controller->{$model})) {
					
					$modelFieldNames = $controller->{$model}->getColumnTypes();
					
				} else if (isset($controller->{$controller->modelClass}->belongsTo[$model]) || isset($controller->{$controller->modelClass}->hasOne[$model])) {
					$modelFieldNames = $controller->{$controller->modelClass}->{$model}->getColumnTypes();
				} else if (!empty($this->settings['complicatedRelation'])) {
					$controllerModel = ClassRegistry::init($controller->modelClass);
					$modelFieldNames = $this->getColumnTypesOfDeepModel($controllerModel, $model, $this->settings['complicatedRelation']);
				}

				if (!empty($modelFieldNames)) {
					foreach ($fields as $filteredFieldName => $filteredFieldData) {
						$this->_filterField($model, $filteredFieldName, $filteredFieldData, $modelFieldNames);
					}
				} else {
					if (isset($controller->{$controller->modelClass}->hasMany[$model])) {
						$modelFieldNames = $controller->{$controller->modelClass}->{$model}->getColumnTypes();
						if (!empty($modelFieldNames)) {
							foreach ($fields as $filteredFieldName => $filteredFieldData) {
								$this->_filterField($model, $filteredFieldName, $filteredFieldData, $modelFieldNames);
							}
						}
					} else if (isset($controller->{$controller->modelClass}->hasAndBelongsToMany[$model])) {
						$modelFieldNames = $controller->{$controller->modelClass}->{$model}->getColumnTypes();
						if (!empty($modelFieldNames)) {
							foreach ($fields as $filteredFieldName => $filteredFieldData) {
								$this->_filterField($model, $filteredFieldName, $filteredFieldData, $modelFieldNames);
							}
						}
					}
				}
				
				// Save model data for redirect
				if ($this->settings['redirect'] === true) {
					if (is_array($controller->data[$model]) AND strtolower($model) != '_token') {
						foreach ($controller->data[$model] as $key => $val) {
							$redirectData["$model.$key"] = $val;
						}	
					}
				}
				// Unset empty model data
				if (count($fields) == 0) {
					unset($controller->data[$model]);
				}
			}
		}
		
		// we want to get a nice inflector underscored controllerName
		$controllerName = Inflector::underscore($controller->name);
		
		// If redirect has been set true, and the data had not been parsed before and put into the url, does it now
		if ($this->settings['parsed'] === false && $this->settings['redirect'] === true) {
			$this->settings['url'] = "/Filter.parsed:true/{$this->_buildNamedParams($redirectData)}";
		
			$url = $this->checkForIndexActions($controller->action, Router::url(array('controller'=>Inflector::underscore($controller->name), 'action'=>$controller->action),true));

			$controller->redirect($url.$this->settings['url']);
		}
		
		// if useSession has been set true, we need to write to Session the settings url
		if ($this->settings['useSession'] == true) {
		
			// first retrieve the last known filter settings
			$sessionSavedFilterSettings = $this->Session->read('Filter.' . $controllerName . '.' . $controller->action);
			
			$urlParams = "/Filter.parsed:true/{$this->_buildNamedParams($redirectData)}";
			
			// if its just a normal index page then  we want to redirect to the last known filter settings if it exists
			if (empty($this->settings['url']) AND !empty($sessionSavedFilterSettings) AND $sessionSavedFilterSettings != '/Filter.parsed:true/') {
				$url = $this->checkForIndexActions($controller->action, Router::url(array('controller'=>$controllerName, 'action'=>$controller->action),true));				
				$controller->redirect($url.$sessionSavedFilterSettings);
			
			// if it is NOT a normal index page, then we want to overwrite the filter settings inside the session
			} else if($sessionSavedFilterSettings != $urlParams ) {
				$this->Session->write('Filter.' . $controllerName . '.' . $controller->action, $urlParams);
			}
		}
		
	}
	
	/**
	 * Checks if current controller action belongs to a list of index actions
	 * because routing in cake is such that /index is always removed so we need to append it back.
	 * if so we append /index to the redirected url
	 *
	 * @return string
	 **/
	private function checkForIndexActions ($controllerAction, $urlToBeRedirectedTo) {
		
		if ($controllerAction == 'index') {
			return $urlToBeRedirectedTo . '/index';
		}
		
		$arrayOfPrefixes = Configure::read('Routing.prefixes');
		
		foreach($arrayOfPrefixes as $prefix) {
			$action = $prefix . '_index';
			if ($controllerAction == $action) {
				return $urlToBeRedirectedTo . '/index';
			}
		}
		
		return $urlToBeRedirectedTo;
	}

/**
 * Builds a named parameter list
 *
 * @return string
 * @author Chad Jablonski
 **/
	function _buildNamedParams($params) {
		$paramString = '';

		foreach ($params as $key => $value) {
			$paramString .= "{$key}:{$value}/";
		}

		return $paramString;
	}


/**
 * Filters an individual field
 *
 * @return array
 * @author Jose Diaz-Gonzalez
 **/
	function _filterField($model, $filteredFieldName, $filteredFieldData, $modelFieldNames = array()) {
		if (is_array($filteredFieldData)) {
			if (!isset($modelFieldNames[$filteredFieldName])) {
				if ($this->_arrayHasKeys($filteredFieldData, array('year', 'month', 'day'))) {
					$filteredFieldData = "{$filteredFieldData['month']}{$this->settings['separator']}{$filteredFieldData['day']}{$this->settings['separator']}{$filteredFieldData['year']}";
				}
			} else if ($modelFieldNames[$filteredFieldName] == 'datetime') {
				$filteredFieldData = $this->_prepareDatetime($filteredFieldData);
			}
		}
		
		if ($filteredFieldData != '') {
			if ((isset($this->settings['whitelist'][$model]) && is_array($this->settings['whitelist'][$model]) && !in_array('*', $this->settings['whitelist'][$model]) && !in_array($filteredFieldName, $this->settings['whitelist'][$model])) || (!isset($this->settings['whitelist'][$model]) && !empty($this->settings['whitelist']))) {
				return;
			}
			if (substr($filteredFieldName, 0, 5) == 'FROM_') {
				$filteredFieldName = substr($filteredFieldName, 5);
				$pieces = explode($this->settings['separator'], $filteredFieldData);
				$this->paginate['conditions']["{$model}.{$filteredFieldName} >="] = "{$pieces[2]}/{$pieces[0]}/{$pieces[1]}";
			} else if (substr($filteredFieldName, 0, 3) == 'TO_') {
				$filteredFieldName = substr($filteredFieldName, 3);
				$pieces = explode($this->settings['separator'], $filteredFieldData);
				$this->paginate['conditions']["{$model}.{$filteredFieldName} <="] = "{$pieces[2]}/{$pieces[0]}/{$pieces[1]}";
			} else if (substr($filteredFieldName, 0, 6) == 'RANGE_') {
				$filteredFieldName = substr($filteredFieldName, 6);
				$pieces = explode($this->settings['rangeSeparator'], $filteredFieldData);
				$startDate = date('Y/m/d', strtotime($pieces[0]));
				if (count($pieces) == 1) {
					$this->paginate['conditions']["{$model}.{$filteredFieldName}"] = $startDate;
				} else {
					$this->paginate['conditions']["{$model}.{$filteredFieldName} >="] = $startDate;
					$endDate = date('Y/m/d', strtotime($pieces[1]));
					$this->paginate['conditions']["{$model}.{$filteredFieldName} <="] = $endDate;
				}
			} else if (isset($modelFieldNames[$filteredFieldName]) && isset($this->settings['fieldFormatting'][$modelFieldNames[$filteredFieldName]])) {
				// insert value into fieldFormatting
				$tmp = sprintf($this->settings['fieldFormatting'][$modelFieldNames[$filteredFieldName]], $filteredFieldData);
				// don't put key.fieldname as array key if a LIKE clause
				if (substr($tmp, 0, 4) == 'LIKE') {
					$this->paginate['conditions']["{$model}.{$filteredFieldName} LIKE"] = "%{$filteredFieldData}%";
				} else {
					$this->paginate['conditions']["{$model}.{$filteredFieldName}"] = $tmp;
				}
			} else if (isset($modelFieldNames[$filteredFieldName])) {
				$this->paginate['conditions']["{$model}.{$filteredFieldName}"] = $filteredFieldData;
			}
			$this->settings['url']["{$model}.{$filteredFieldName}"] = $filteredFieldData;
			
		}
	}

/**
 * function which will take care of the storing the filter data and loading after this from the Session
 * JF: modified to not htmlencode, caused problems with dates e.g. -05-
 * 
 * @param object $controller the class of the controller which call this component
 */
	function _prepareFilter(&$controller) {
		
		$filter = array();
		
		if (isset($controller->data)) {
			
			foreach ($controller->data as $model => $fields) {
				if (is_array($fields)) {
					foreach ($fields as $key => $field) {
						if ($field == '') {
							unset($controller->data[$model][$key]);
						}
					}
				}
			}

			App::import('Sanitize');
			$sanitize = new Sanitize();
			$controller->data = $sanitize->clean($controller->data, array('encode' => false));

			$filter = $controller->data;
		}

		if (empty($filter)) {
			$filter = $this->_checkParams($controller);
		}

		$controller->data = $filter;

		return $controller;
	}

/**
 * function which will take care of filters from URL
 * JF: modified to not encode, caused problems with dates
 * 
 * @param object $controller the class of the controller which call this component
 */
	function _checkParams(&$controller) {
		if (empty($controller->params['named'])) {
			$filter = array();
		}

		App::import('Sanitize');
		$sanitize = new Sanitize();

		$controller->params['named'] = $sanitize->clean($controller->params['named'], array('encode' => false));
		if (isset($controller->params['named']['Filter.parsed'])) {
			if ($controller->params['named']['Filter.parsed']) {
				$this->settings['parsed'] = true;
				$filter = array();
			}
		}

		foreach ($controller->params['named'] as $field => $value) {
			if (!in_array($field, $this->settings['paginatorParams']) && $field != 'Filter.parsed') {
				$fields = explode('.', $field);
				if (sizeof($fields) == 1) {
					$filter[$controller->modelClass][$field] = $value;
				} else {
					$filter[$fields[0]][$fields[1]] = $value;
				}
			}
		}

		return (!empty($filter)) ? $filter : array();
	}

/**
 * Prepares a date array for a MySQL WHERE clause
 * 
 * @author Jeffrey Marvin
 * @param array $date
 * @return string
 */
	function _prepareDatetime($date) {
		if ($this->settings['useTime'] === true) {
			return  "{$date['year']}-{$date['month']}-{$date['day']}"
				. ' ' . (($date['meridian'] == 'pm' && $date['hour'] != 12) ? $date['hour'] + 12 : $date['hour'])
				. ':' . (($date['min'] < 10) ? "0{$date['min']}" : $date['min']);
		} else {
			return "{$date['year']}-{$date['month']}-{$date['day']}";
		}
	}

/**
 * Checks if all keys are held within an array
 *
 * @param array $array
 * @param array $keys
 * @param boolean $size
 * @return boolean array has keys, optional check on size of array
 * @author savant
 **/
	function _arrayHasKeys($array, $keys, $size = null) {
		if (count($array) != count($keys)) return false;

		$array = array_keys($array);
		foreach ($keys as &$key) {
			if (!in_array($key, $array)) {
				return false;
			}
		}
		return true;
	}
	
	
	/**
	* Checks if all keys are held within an array
	*
	* @param array $array
	* @param array $keys
	* @param boolean $size
	* @return boolean array has keys, optional check on size of array
	* @author savant
	**/
	function getColumnTypesOfDeepModel($model, $targetModel, $arrayOfModels) {
		
		foreach($arrayOfModels as $key=>$value) {
			// at this level, my targetModel is here
			if ((!is_array($value) AND $value == $targetModel) AND is_numeric($key)) {
				return $model->{$value}->getColumnTypes();
			} elseif ((!is_array($value) AND $value == $targetModel) AND !is_numeric($key)) {
				return $model->{$key}->{$value}->getColumnTypes();	
			} elseif ($key == $targetModel){
				return $model->{$key}->getColumnTypes();
			// my targetModel is NOT here, so we go deeper
			} elseif (is_array($value)) {
				return $this->getColumnTypesOfDeepModel($model->{$key}, $targetModel, $value);
			}
		}
		
		// my targetModel is not at this level, and we cannot go deeper so we return empty array
		return array();
	}
	
	
}
?>
