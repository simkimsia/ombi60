<?php
App::uses('AppHelper', 'View/Helper');
class SettingsformHelper extends AppHelper {

	public $helpers = array('Form','Html');

	public function init($data) {
		if (!empty($data) && is_array($data)) {
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function select($data) {
		$options = array();
		if (is_array($data['option']) && !empty($data['option'])) {
			foreach ($data['option'] as $htmlOptions) {
				$options[$htmlOptions['@value']] = $htmlOptions[0];
			}
		}

		$attrArr = array();
		foreach ($data as $key => $value) {

			if ($key != 'option' && substr($key,0,1) == '@') {
				$keyName = substr($key,1);
				if ($keyName != 'name') {
					if ($keyName == 'id') {
						$value = 'theme_settings_'.$value;
					}
					$attrArr[$keyName] = $value;
				} else {
					$tagName = $value;
				}
			}

			$attrArr['label'] = false;

		}

		if (isset($this->json_data->current->$tagName)) {
			$attrArr['value'] = $this->json_data->current->$tagName;
		}
		return $this->Form->input('theme.settings.'.$tagName,array_merge(array('options' => $options),$attrArr));
	}

	public function textarea($data) {
		 
		foreach ($data as $key => $value) {

			if ($key != 'option' && substr($key,0,1) == '@') {
				$keyName = substr($key,1);
				if ($keyName != 'name') {
					if ($keyName == 'id') {
						$value = 'theme_settings_'.$value;
					}
					$attrArr[$keyName] = $value;
				} elseif($keyName == 'type' && $value=="file") {
					$tagType = $value;
				} else {
					$tagName = $value;
				}
			}

			$attrArr['label'] = false;
		}
		if (isset($data[0]) && !empty($data[0])) {
			$attrArr['value'] = $data[0];
		}

		$tagName = str_replace('.','dot',$tagName);
		 
		if (isset($this->json_data->current->$tagName)) {
			$attrArr['value'] = $this->json_data->current->$tagName;
		}

		if (isset($attrArr['type']) && $attrArr['type'] == 'file') {

			return $this->Form->file('theme.settings.files.'.$tagName,$attrArr);
		} else {
			return $this->Form->input('theme.settings.'.$tagName,$attrArr);
		}
	}

	public function input($data) {
		 
		foreach ($data as $key => $value) {

			if ($key != 'option' && substr($key,0,1) == '@') {
				$keyName = substr($key,1);
				 
				if ($keyName != 'name') {
					if ($keyName == 'id') {
						$value = 'theme_settings_'.$value;
					}
					$attrArr[$keyName] = $value;
				} elseif($keyName == 'type' && $value=="file") {
					$tagType = $value;
				} else {
					$tagName = $value;
				}

				if (trim($keyName) == 'name') {
					$tagName = trim($value);
				}
			}

			$attrArr['label'] = false;
		}
		 
		if (isset($attrArr['type']) && $attrArr['type'] == 'checkbox') {
			$attrArr['value'] = 1;
			if (isset($this->json_data->current->{$tagName}) && !empty($this->json_data->current->{$tagName})) {
				$attrArr['checked'] = 1;
			}
		}
		 
		$tagName = str_replace('.','dot',$tagName);
		$tagName1 = str_replace('dot','.',$tagName);
		if (isset($this->json_data->current->$tagName1)) {
			$attrArr['value'] = $this->json_data->current->{$tagName1};
		}

		if (isset($attrArr['type']) && $attrArr['type'] == 'file') {
			if (isset($this->json_data->current->{$tagName1})) {
				return $this->Form->file('theme.settings.files.'.$tagName,$attrArr).'<span>'.
				$this->Html->link($attrArr['value'],$this->asset_folder_url.$attrArr['value'],array('target' => '_blank')).'</span>'.$this->Form->input('theme.settings.files._'.$tagName,array('type' => 'hidden','value' => $attrArr['value']));
			} else {
				return $this->Form->file('theme.settings.files.'.$tagName,$attrArr);
			}
		} elseif (isset($attrArr['type']) && $attrArr['type'] == 'radio') {
			return $this->Form->input('theme.settings.'.$tagName,$attrArr,$defaultArr);
		} else {
			return $this->Form->input('theme.settings.'.$tagName,$attrArr);
		}
		 
	}

	public function radio($tagName ,$radioData) {
		$attributes = array();

		if (isset($radioData['attr']) && !empty($radioData['attr'])) {
			foreach ($radioData['attr'] as $attrKey => $attrVal) {
				if (substr($attrKey,0,1) == '@') {
					$key = substr($attrKey,1);
					if ($key == 'id') {
						$attrVal = 'theme_settings_'.$attrVal;
					}
					$attributes[$key] = $attrVal;
				}
			}
		}

		$attributes['legend'] = false;
		 
		$checked = $radioData['checked'];
		if (isset($this->json_data->current->$tagName)) {
			$checked = $this->json_data->current->$tagName;
		}

		return $this->Form->input('theme.settings.'.$tagName,array_merge($attributes,array('options' => $radioData['options'],'type' => 'radio','value' => $checked)),array('default' => $checked));
	}

	public function buildTag($key,$element,$counter,$html='') {
		$_allowedFormElements = array('input','select','textarea');
		$_unallowedElements = array('form');

		$counter++;

		if (in_array($key,$_allowedFormElements,true)) {
			if (isset($element[0]) && is_array($element[0])) {
				$radioData = array();
				foreach ($element as $eachElement) {
					if (isset($eachElement['@type']) && $eachElement['@type'] == 'radio') {
						$radioData[$eachElement['@name']]['options'][$eachElement['@value']] = $eachElement['@value'];
						if (isset($eachElement['@checked']) && $eachElement['@checked'] == 'checked') {
							$radioData[$eachElement['@name']]['checked'] = $eachElement['@value'];
						}
						$tagName =  $eachElement['@name'];
						foreach ($eachElement as $key => $value)  {
							if (!in_array($key,array('@type','@name','@value','@checked'))) {
								 
								$radioData[$tagName]['attr'][$key] = $value;
							}
						}
					} else {
						$html .= $this->$key($element);
					}
				}

				if (!empty($radioData) && is_array($radioData)) {
					foreach ($radioData as $tagName => $eachRadio) {
						$html .= $this->radio($tagName,$eachRadio);
					}
				}
			} else {
				$html .= $this->$key($element);
			}
		} elseif (!is_numeric($key) && !is_array($element) ) {

			$html .= '<'.$key.'>'.$element.'</'.$key.'>';

		}elseif(!is_numeric($key) && is_array($element) ) {

			if (isset($element[0]) && !is_array($element[0])) {

				$tag = '<'.$key.' ';
				$attr = '';
				$newhtml = array();
				$i = 0;
				foreach ($element as $innerTag => $innerHtml) {
					if (substr($innerTag,0,1) == '@') {
						$attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
					} else {
						if (is_array($innerHtml)) {
							$newhtml[] = $this->buildTag($innerTag,$innerHtml,$counter);
						} else {
							if (is_numeric($innerTag) && trim($innerHtml) != '') {
								$newhtml[] = $innerHtml;
							}
						}
					}
				}
				 
				$openingTag = $tag . $attr.'>';
				$closingTag = '</'.$key.'>';
				if (!empty($newhtml) && is_array($newhtml)) {
					foreach ($newhtml as $newHtmlText) {
						$html .= $openingTag . $newHtmlText . $closingTag;
					}
				} else {
					$html .= $openingTag .  $closingTag;
				}


			} elseif(isset($element[0]) && is_array($element[0]) ) {
				foreach ($element as $innerTag => $innerHtml) {
					$html .= '<'.$key.'>';
					$html .= $this->buildTag($innerTag,$innerHtml,$counter);
					$html .= '</'.$key.'>';
				}
				 
			} elseif (!isset($element[0]) && is_array($element)) {
				$html .= '<'.$key.' ';
				$attr = '';
				$newhtml = '';
				foreach ($element as $innerTag => $innerHtml) {
					if (substr($innerTag,0,1) == '@') {
						$attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
					} else {
						$newhtml .= $this->buildTag($innerTag,$innerHtml,$counter);
					}
				}
				$html .= $attr. '>'.$newhtml;
				$html .= '</'.$key.'>';
			} else {
				//echo "<br>I AM HERE WITH KEY ELEMENT $key <br>";print_r($element);
			}
			 
		} elseif (is_numeric($key) && is_array($element)) {
			foreach ($element as $innerTag => $innerHtml) {
				$html .= $this->buildTag($innerTag,$innerHtml,$counter);
			}
		} else {
			$html = $element;
		}

		if ($counter > 50) {
			//echo "<br>in infinite loop "; exit;
			return $html;
		}
		return $html;
	}

}