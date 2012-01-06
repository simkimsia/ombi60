<?php

App::uses('FormHelper', 'View/Helper');

class OwnFormHelper extends FormHelper {

    var $helpers = array('Html');

    public function error($field, $text = null, $options = array()) {
        if (is_array($text) && $text['attributes']['for']) {
            list($model, $modelField) = explode('.', $field);
            $text['attributes']['for'] = $model . Inflector::camelize($modelField);
        }
        return parent::error($field, $text, $options);
    }
}