<?php
/**
 * Provides counter cache behavior for HABTM records.
 *
 * Example: Posts habtm Tags and tags table contains post_count field
 *
 * class Post extends AppModel {
 *   var $name = 'Post';
 *   var $actsAs = array('HabtmCounterCache');
 *   var $hasAndBelongsToMany = array('Tag');
 * }
 *
 * Features include:
 * - Counter scope conditions
 * - Flexible configuration
 * (see comments for $config param to setup() method below for more information)
 *
 * @author Neil Crookes <neil@neilcrookes.com>
 * @link http://www.neilcrookes.com
 * @copyright (c) 2009 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 * @link http://github.com/neilcrookes
 */
class ManyToManyCountableBehavior extends ModelBehavior {

  /**
   * Array in the form:
   *
   * array(
   *  $model->alias => array(
   *    $model->id => array(
   *      $habtmAlias => array(1,2,3,...) // $habtmAlias is the
   *    )
   *  )
   * )
   *
   * Used to store the ids of the habtm related models whose counterCache fields
   * nee updating in either afterSave or afterDelete.
   *
   * @var array
   */
  protected $_settings = array();
  
  protected $_otherParentModelIDs = array();

  /**
   * Populates the settings property of the behavior in an array in the form:
   * array(
   *  $model->alias => array(
   *    $habtmAlias => array(
   *      'counterCache' => '<countCache field name>'
   *      'counterScope' => array('field' => 'value') // A regular CakePHP condition
   *    ),
   *  ),
   * )
   * 
   * @param AppModel $model
   * @param array $config Configuration is very flexible, for example:
   * - Just attach and it will do counter caching for all hatbm associated models
   * that have the counterCache field. E.g.
   *
   * var $actsAs = array('HabtmCounterCache');
   *
   * - Specify counterCache and/or counterScope keys in the configuration options
   * when you attach the behavior for these settings to be applied to all habtm
   * associations. E.g.
   *
   * var $actsAs = array(
   *  'HabtmCounterCache' => array(
   *    'counterScope' => array('active' => 1)
   *  ),
   * );
   *
   * - Introduce habtm association specific counterCache and counterScope settings
   * by using the habtm alias as the key E.g.
   *
   * var $actsAs = array(
   *  'HabtmCounterCache' => array(
   *    'Tag' => array(
   *      'counterCache' => 'weight'
   *    )
   *  ),
   * );
   *
   */
  public function setup(&$model, $config = null) {

        // Set up the default settings for this model. Default counterCache field is
        // post_count for Post model, no counterScope.
        $defaults = array(
                'counterCache' => Inflector::underscore($model->alias) . '_count',
                'counterScope' => null,
        );
        
        // check if it is universal settings
        $universalSettings = $this->_checkForUniversalSettings($config);
        
        if ($universalSettings) {
                // then we need to loop through all habtms. right now kiv.
        } else {
                // then we loop thru each individual relation
                foreach($config as $relationName => $relationAssocData) {
                        $this->settings[$model->alias][$relationName] = $relationAssocData;
                }
        }
        
        
        
        

  }
  
  /**
   * need to check if we are setting for all many 2 many relations
   **/
  protected function _checkForUniversalSettings($config) {
        
        // If a string, assume counterCache field name
        if (is_string($config)) {
                return true;
        // If array, use the counter Cache and Scope keys
        } elseif (is_array($config)) {
                if (isset($config['counterCache']) || isset($config['counterScope'])) {
                        return true;
                }
        }
        return false;
  }
  
  
	public function beforeDelete(&$model, $cascade = true) {
		
		foreach($this->settings[$model->alias] as $relationName=>$config) {
			$joinModel = $config['joinModel'];
			$foreignKey = $config['foreignKey'];
			$assocFKey = $config['associationForeignKey'];
			$basicCondition = array($joinModel . '.' . $foreignKey =>$model->id) ;
			$extraConditions = !empty($config['foreignScope']) ? $config['foreignScope'] : array();
			
			$conditions = array_merge($basicCondition, $extraConditions);
			
			$idField = 'DISTINCT ' . $joinModel . '.' . $assocFKey;
			
			$model->{$joinModel}->recursive = -1;
			$ids = $model->{$joinModel}->find('all', array('conditions'=>$conditions,
								       'fields'=>array($assocFKey)));
			
			$this->_otherParentModelIDs[$relationName] = Set::extract('{n}.'.$joinModel, $ids);
		}
		return true;
	}
	
	public function afterDelete(&$model) {
		
		foreach($this->_otherParentModelIDs as $relationName=>$ids) {
			$joinModel = $this->settings[$model->alias][$relationName]['joinModel'];
			foreach($ids as $key=>$id) {
				$result = $model->{$joinModel}->updateCounterCache($id);		
			}
			
		}
		$this->_otherParentModelIDs = array();
	}

  

  /**
   * Updates the counter cache for each associated habtm model's records
   * identified in the _habtmIds property
   *
   * @param AppModel $model
   */
	public function updateCounterCacheForM2M(&$model, $relationName, $arrayOfIds) {

		if (!isset($this->settings[$model->alias][$relationName])) return true;
		if (empty($arrayOfIds)) return true;

		$thisRelationSetting = $this->settings[$model->alias][$relationName];


		// Instantiate the join model, e.g. PostsTag
		$joinModelObj = ClassRegistry::init($thisRelationSetting['joinModel']);

		// Initialise conditions array
		  $conditions = array();

		  // By default, recursive = -1 as no need to get any other associated data
		  $recursive = -1;

		if (isset($thisRelationSetting['counterScope'])) {
		        // Bind the current model as a belongsTo to the joinModel, permanently,
		        // e.g. PostsTag->belongsTo = array('Post')
		        $joinModelObj->bindModel(array(
		          'belongsTo' => array(
		            $model->alias => array(
		              'foreignKey' => $thisRelationSetting['foreignKey']
		            )
		          )
		        ), false);
  
		        // Add counter scope to conditions, e.g. array(Post.active => 1)
		        $conditions[] = $thisRelationSetting['counterScope'];
  
		        // Set recursive to 0 to ensure the bound model data is available for
		        // applying scope conditions to
		        $recursive = 0;
        
        
		}

		foreach ($arrayOfIds as $habtmId) {
		        $conditions[$thisRelationSetting['joinModel'].'.'.$thisRelationSetting['associationForeignKey']] = $habtmId;
        
        
		        // Get the count E.g. number of PostsTag with tag_id = 1
		        $count = $joinModelObj->find('count', array(
		          'conditions' => $conditions,
		          'recursive' => $recursive
		        ));
        
        
        
		        // Update the associated habtm model record's conter cache, e.g.
		        // Tag.post_count = 1
		        $model->{$joinModelObj->alias}->{$thisRelationSetting['className']}->save(array(
		          $thisRelationSetting['className'] => array(
		            'id' => $habtmId,
		            $thisRelationSetting['counterCache'] => $count,
		          ),
		        ));
        
		}
	}

}

?>