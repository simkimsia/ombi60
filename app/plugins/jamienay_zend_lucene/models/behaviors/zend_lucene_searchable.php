<?php
/**
 * MeioUpload Behavior
 *
 * This behavior is based on Vincius Mendes'  MeioUpload Behavior
 *  (http://www.meiocodigo.com/projects/meioupload/)
 * Which is in turn based upon Tane Piper's improved uplaod behavior
 *  (http://digitalspaghetti.tooum.net/switchboard/blog/2497:Upload_Behavior_for_CakePHP_12)
 *
 * @author Jose Diaz-Gonzalez (support@savant.be)
 * @author Juan Basso (jrbasso@gmail.com)
 * @package app
 * @subpackage app.models.behaviors
 * @filesource http://github.com/jrbasso/MeioUpload/tree/master
 * @version 2.1
 * @lastmodified 2010-01-03
 */

class ZendLuceneSearchableBehavior extends ModelBehavior {


	

/**
 * The model name of the search index
 */
	var $searchIndexModel = 'SearchIndex';
        
        
/**
 * array of fields to index
 */
	var $fieldsToIndex = array();



/**
 * Setup the behavior. It stores a reference to the model, merges the default options with the options for each field, and setup the validation rules.
 *
 */
	function setup(&$model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'searchIndexModel' => 'SearchIndex',
				'fieldsToIndex' => array(),
				
			);
		}
		
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias],
							     (array)$settings);
		
		$this->fieldsToIndex = $this->settings[$Model->alias]['fieldsToIndex'];
		$this->searchIndexModel = $this->settings[$Model->alias]['searchIndexModel'];
	}



/**
 * After save
 *
 * @access public
 * @param $model Object
 * @return void
 */
	function afterSave(&$model) {
		App::import('Model', array('SearchIndex'));
                $searchIndex = new SearchIndex();
                
                $saveData = array('SearchIndex' => array(
                        'document' => array(
                                array(
                                        'key' => 'name',
                                        'value' => $model->data[$model->alias][$this->settings[$model->alias]['name']],
                                        'type' => 'Text'
                                ),
                                array(
                                        'key' => 'description',
                                        'value' => $model->data[$model->alias][$this->settings[$model->alias]['description']],
                                        'type' => 'Text'
                                ),
                               
                        )
                ));
                
                $searchIndex->save($saveData);
	}


}
?>