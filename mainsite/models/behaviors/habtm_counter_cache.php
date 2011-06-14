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
class HabtmCounterCacheBehavior extends ModelBehavior {

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
  protected $_habtmIds = array();

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
        
        // Get the settings for all habtm associations, if set.
        $allHabtmSettings = $this->_config2settings($config);
        
        // Iterate through the habtms of the model, assigning the settings to the
        // settings property of the behavior
        foreach ($model->hasAndBelongsToMany as $habtmAlias => $habtmAssocData) {
        
                $habtmSpecificSettings = array();
              
                // Check whether habtm specific settings have been set for this alias
                if (isset($config[$habtmAlias])) {
                        if ($config[$habtmAlias] == false) {
                                continue;
                        } else {
                                $habtmSpecificSettings = $this->_config2settings($config[$habtmAlias]);
                        }
                // Check whether habtm specific settings have been set for this habtm's
                // class name (note, you may have 2 assocs using the same class name)
                } elseif (isset($config[$habtmAssocData['className']])) {
                        if ($config[$habtmAssocData['className']] == false) {
                                continue;
                        } else {
                                $habtmSpecificSettings = $this->_config2settings($config[$habtmAssocData['className']]);
                        }
                }
              
                // The behavior needs to know the className, joinTable, foreignKey and
                // associationForeignKey of the assoc later, so may as well grab them now.
                $habtmSpecificSettings += array_intersect_key($habtmAssocData, array_flip(array('className', 'joinTable', 'foreignKey', 'associationForeignKey')));
              
                // It also needs to know the joinModel, so may as well determine that now
                $habtmSpecificSettings['joinModel'] = Inflector::camelize(Inflector::singularize($habtmSpecificSettings['joinTable']));
              
                // Store the merged settings in the behavior's settings property indexed
                // by the model->alias and the habtmAlias
                $this->settings[$model->alias][$habtmAlias] = array_merge($defaults, $allHabtmSettings, $habtmSpecificSettings);
        
        }

  }
  
  /**
   * need to check for at least 1 false habtm setting in the config
   
  protected function _checkForHabtmSetting($config) {
        
        // If a string, assume counterCache field name
        if (is_string($config)) {
                return true;
        // If array, use the counter Cache and Scope keys
        } elseif (is_array($config)) {
                if (isset($config['habtm'])) {
                        return $config['habtm'];
                } else {
                        // may be association specific
                        foreach($config as $key=>$value) {
                                if (is_array($value)) {
                                        if (array_key_exists('habtm', $value)) {
                                                if ($value['habtm'] === false)
                                                        return false;
                                        } 
                                }
                        }
                }
        }
        return true;
  }
  **/

  /**
   * Attempts to normalise the config and produce a standard structure for the
   * settings that apply to either all habtm associations or just one.
   *
   * If config is a string, it's assumed the value is the counterCache field
   * name. If it's an array, only the elements with keys mayching counterCache
   * and counterScope are actually used.
   *
   * @param mixed $config
   * @return array
   */
  protected function _config2settings($config) {

        $settings = array();
        
        // If a string, assume counterCache field name
        if (is_string($config)) {
                $settings['counterCache'] = $config;
        // If array, use the counter Cache and Scope keys
        } elseif (is_array($config)) {
                if (isset($config['counterCache'])) {
                        $settings['counterCache'] = $config['counterCache'];
                }
                if (isset($config['counterScope'])) {
                        $settings['counterScope'] = $config['counterScope'];
                }
                if (isset($config['habtm'])) {
                        $settings['habtm'] = $config['habtm'];
                }
        }
        return $settings;
  }

  /**
   * Called automatically before Model::save()
   *
   * If inserting, there were no previous habtm associated records that may no
   * longer be associated, so just return.
   *
   * If updating, there may have been previous habtm associated records that are
   * no longer associated, e.g. you removed a tag, so you need to identify all
   * previously associated records and store them for after save where they will
   * each have their counts recalculated.
   *
   * @param AppModel $model
   * @return boolean Always true
   */
  public function beforeSave(&$model) {

    // If no model->id, inserting, so return
    if (!$model->id) {
      return true;
    }

    $this->_setOldHabtmIds($model);

    return true;

  }

        /**
         * Adds current associated record ids (from the db) to the _habtmIds property
         * for each habtm association in the settings
         *
         * @param AppModel $model
         */
        protected function _setOldHabtmIds(&$model) {
                $this->log($this->settings);
                foreach ($this->settings[$model->alias] as $habtmAlias => $settings) {
                        // Instantiate a model for the join table, e.g. PostsTag
                        $JoinModelObj = ClassRegistry::init($settings['joinModel']);
                        // Get ids of the current associated habtm records e.g. list of tag_id's
                        $oldHabtmIds = $JoinModelObj->find('list', array(
                                'fields' => array($settings['associationForeignKey'], $settings['associationForeignKey']),
                                'conditions' => array($settings['foreignKey'] => $model->id)
                        ));
                        // Add tag_ids to _habtmsIds property
                        $this->_habtmIds[$model->alias][$model->id][$habtmAlias] = $oldHabtmIds;
                }
        }

  /**
   * Called automatically after Model::save()
   *
   * Adds new habtm ids to the list of ids of associated habtm models to update
   * the counters for, then triggers the update.
   *
   * @param AppModel $model
   * @param boolean $created
   * @return boolean Always true
   */
  public function afterSave(&$model, $created) {

    $this->_setNewHabtmIds($model);

    $this->_updateCounterCache($model);

    return true;

  }

  /**
   * Updates the _habtmIds property with the new habtm ids. E.g. Post is created
   * with some tags or Post is edited ang tags have changed.
   *
   * @param AppModel $model
   */
  protected function _setNewHabtmIds($model) {

        // Iterate through the habtm associations
        foreach ($this->settings[$model->alias] as $habtmAlias => $settings) {
        
                // If habtm alias key is not set in model->data, the associated habtm ids
                // are not changing, but the scope of the record may be, so we still need
                // need to leave the old ones in the _habtmIds property and re-calculate
                // any counts.
                if (!isset($model->data[$habtmAlias][$habtmAlias])) {
                        continue;
                }
              
                // If there are no old habtm ids, add the new ones to the _habtmIds
                // property
                if (!isset($this->_habtmIds[$model->alias][$model->id][$habtmAlias])) {
                        $this->_habtmIds[$model->alias][$model->id][$habtmAlias] = $model->data[$habtmAlias][$habtmAlias];
                        continue;
                }
              
                // If there are old habtm ids merge them with the new ones
                $this->_habtmIds[$model->alias][$model->id][$habtmAlias] = array_unique(array_merge(
                        $this->_habtmIds[$model->alias][$model->id][$habtmAlias],
                        $model->data[$habtmAlias][$habtmAlias]
                ));
        
        }
  }

  /**
   * Called automatically before Model::delete()
   *
   * If deleting a record that has associated habtm records, the habtm records
   * counter caches will need re-calculating, so identify them. E.g. get the
   * tag_ids of the Tags that the Post being deleted was tagged with.
   *
   * @param AppModel $model
   * @return boolean Always true
   */
  function beforeDelete(&$model) {

    $this->_setOldHabtmIds($model);

    return true;

  }

  /**
   * Trigger the update of the counts of the relevant associated habtm model
   * records, e.g. the Tags of the Post that was just deleted.
   *
   * @param AppModel $model
   */
  function afterDelete(&$model) {

    $this->_updateCounterCache($model);

  }

  /**
   * Updates the counter cache for each associated habtm model's records
   * identified in the _habtmIds property
   *
   * @param AppModel $model
   */
  function _updateCounterCache(&$model) {

    foreach ($this->settings[$model->alias] as $habtmAlias => $settings) {

      // If there are no ids for this habtm to update the counts for, move on
      if (!isset($this->_habtmIds[$model->alias][$model->id][$habtmAlias])) {
        continue;
      }

      // Instantiate the join model, e.g. PostsTag
      $JoinModelObj = ClassRegistry::init($settings['joinModel']);

      // Initialise conditions array
      $conditions = array();

      // By default, recursive = -1 as no need to get any other associated data
      $recursive = -1;

      // But if there is counterScope
      if ($settings['counterScope']) {

        // Bind the current model as a belongsTo to the joinModel, permanently,
        // e.g. PostsTag->belongsTo = array('Post')
        $JoinModelObj->bindModel(array(
          'belongsTo' => array(
            $model->alias => array(
              'foreignKey' => $settings['foreignKey']
            )
          )
        ), false);

        // Add counter scope to conditions, e.g. array(Post.active => 1)
        $conditions[] = $settings['counterScope'];

        // Set recursive to 0 to ensure the bound model data is available for
        // applying scope conditions to
        $recursive = 0;

      }

      // Loop through the associated habtm records to update the counters for,
      // e.g. Tag ids 1,2,3...
      foreach ($this->_habtmIds[$model->alias][$model->id][$habtmAlias] as $habtmId) {

        // Add the habtmId to the conditions array, e.g. PostsTag.tag_id => 1
        $conditions[$settings['joinModel'].'.'.$settings['associationForeignKey']] = $habtmId;

        // Get the count E.g. number of PostsTag with tag_id = 1
        $count = $JoinModelObj->find('count', array(
          'conditions' => $conditions,
          'recursive' => $recursive
        ));

        // Update the associated habtm model record's conter cache, e.g.
        // Tag.post_count = 1
        $model->{$habtmAlias}->save(array(
          $habtmAlias => array(
            'id' => $habtmId,
            $settings['counterCache'] => $count,
          ),
        ));
      }
    }

  }

}

?>