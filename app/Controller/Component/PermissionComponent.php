<?php
/**
 * Cakephp acos_aros ACL behavior only works for
 * users in relation to the actions in the controllers
 *
 * They do not filter authorization for users in relation
 * to the data records.
 *
 * Hence this PermissionComponent.
 *
 * The assumption is that we are talking about a SaaS
 * webapp.
 *
 * In most cases, a SaaS webapp has a dominant model.
 * It could be an Account model or Shop model in ombi60's case.
 * Because we also assume that each Dominant model,
 * you can have multiple users associated with the Dominant.
 * The user models or user-account models (which should be
 * 1-1 to the user model)
 * must have a foreign_key to the Dominant model.
 *
 * Assuming the dominant model is called Account, every other
 * non-user model that belongs to the Account model are considered
 * as a Child model of Account or AccountChild model.
 *
 * The PermissionComponent will check for the primary key of
 * these AccountChild models in admin_edit, admin_delete,
 * admin_toggle, admin_view. The assumption is that the prefix is
 * for admin. We of course assume that the params['pass'][0] contains
 * the said primary key.
 *
 * For models that belongTo AccountChild models, we call them
 * AccountGrandChild models.
 *
 * These AccountGrandChild models should NOT have any account_id as
 * foreign key. They should ONLY have the Child model foreign key.
 * the assumption is that all related actions for add, delete, edit, view,
 * are like these:
 *
 * /admin/account_children/123/account_grand_children/edit/1
 * where 123 is the foreign key and 1 is the primary key of the AccountGrandChild.
 *
 * We also assume that there are no reasonable standalone actions required for
 * models that are beyond the AccountGrandChild models.
 * **/


class PermissionComponent extends Component {
 
 
/**
 * list of actions that are supposed to apply the themes to .
 * if empty array, apply to all actions.
 * */

	public $actionsWithPrimaryKey = array('admin_edit',
			     'admin_delete',
			     'admin_view',
			     'admin_toggle',
			     );
	
	public $actionsWithShopId = array('admin_add');
	
	
	/**
	 *array('GrandChildModelName'=>array('admin_edit_',
			'admin_delete_',
			'admin_view_',
			'admin_toggle_'));
	**/
	public $prefixActionsWithPrimaryForeignKey = array();
		
		
	/**
	 *array('GrandChildModelName'=>array('admin_add_',
			'admin_index_',
			));
	**/
	public $prefixActionsWithPrimaryKey = array();
	
	public $redirect = array('action'=>'index',
			      'admin' => true);
	
	public $errorMessage = 'You do not have permissions for this ';
	
	public $modelName = '';

/**
 * Initialize function
 *
 *
 * @param controller object $controller
 * @param array $settings
 */     
	public function initialize($controller) {
		$settings = $this->settings;
		$this->actionsWithPrimaryKey = (empty($settings['actionsWithPrimaryKey'])) ? $this->actionsWithPrimaryKey : $settings['actionsWithPrimaryKey'];
		$this->actionsWithShopId = (empty($settings['actionsWithShopId'])) ? $this->actionsWithShopId : $settings['actionsWithShopId'];
		
		$this->prefixActionsWithPrimaryForeignKey = (empty($settings['prefixActionsWithPrimaryForeignKey'])) ? $this->prefixActionsWithPrimaryForeignKey : $settings['prefixActionsWithPrimaryForeignKey'];
		$this->prefixActionsWithPrimaryKey = (empty($settings['prefixActionsWithPrimaryKey'])) ? $this->prefixActionsWithPrimaryKey : $settings['prefixActionsWithPrimaryKey'];
		
		$this->modelName = Inflector::classify($controller->name);
		
		if (empty($settings['redirect'])) {
			$this->redirect['controller'] = Inflector::underscore($controller->name);
			
		} else {
			$this->redirect = $settings['redirect'];
		}
		
		if (empty($settings['errorMessage'])) {
			$this->errorMessage .= $this->modelName;
		} else {
			$this->errorMessage = $settings['errorMessage'];
		}
		
	}
	
/**
 * check admin_edit, admin_delete, admin_view, admin_toggle for the $id
 * see if current user has permissions for this $id
 *
 * @param controller object $controller 
 */     
	public function startup($controller) {
		
		$shopIdUserHas = User::get('Merchant.shop_id');

/// @TODO reve this hack
//$shopIdUserHas =2;
		// check the admin_edit, admin_view,
		// admin_delete, admin_toggle for correct primary key
		// assuming that the url is something like
		// admin/:controller-name/edit/:id
		// we use $controller->params['pass'][0] to access the $id


		$this->checkForValidPrimaryKeyInAction($controller, $shopIdUserHas);
		
		$this->checkForValidShopIdInData($controller, $shopIdUserHas);
		$this->checkForValidPrimaryForeignKeyInAction($controller, $shopIdUserHas);
	
	}
	
	private function checkForValidShopIdInData($controller, $shopIdUserHas) {
		if (in_array($controller->action, $this->actionsWithShopId)) {
			$validData = !empty($controller->request->data);
			$modelName = $this->modelName;
			if ($validData) {
				$shopId = (isset($controller->request->data[$modelName]['shop_id']) ? $controller->request->data[$modelName]['shop_id'] : 0);
				
				if ($shopId !== $shopIdUserHas) {
					$controller->request->data[$modelName]['shop_id'] = $shopIdUserHas;
				}
			}	
		}
	}
	
	private function checkForValidPrimaryKeyInAction($controller, $shopIdUserHas) {
		
		// e.g. for admin/account_children/edit/1
		$actionForChildModel = in_array($controller->action, $this->actionsWithPrimaryKey);
		
		// e.g. for admin/account_children/1/account_grand_children/add
		$grandChildModelActions = $this->in_array_of_arrays($controller->action, $this->prefixActionsWithPrimaryKey);
		$actionForGrandChildModel = !empty($grandChildModelActions);
		
		
		$validAction = ($actionForChildModel OR $actionForGrandChildModel);
		
		if ($validAction) {
			$validParam = isset($controller->params['pass'][0]);
			$modelName = $this->modelName;
			
			if ($validParam) {
				$id = $controller->params['pass'][0];
				
				// because admin actions are filtered
				// via the acos_aros ACL so we do
				// not need to check for User group type
				$modelInstance = ClassRegistry::init($modelName);
				$modelInstance->recursive = -1;
				$count = $modelInstance->find('count',
						array('conditions'=>
							array("$modelName.id"=>$id,
							      "$modelName.shop_id"=>$shopIdUserHas)));
				if ($count == 0) {
					
					$controller->Session->setFlash(__($this->errorMessage), 'default', array('class'=>'flash_failure'));
					$controller->redirect($this->redirect);
				}
			}	
		}
	}
	
	private function checkForValidPrimaryForeignKeyInAction($controller, $shopIdUserHas) {
		
		
		// e.g. for admin/account_children/1/account_grand_children/edit/37
		$grandChildModelActions = $this->in_array_of_arrays($controller->action, $this->prefixActionsWithPrimaryForeignKey);
		$actionForGrandChildModel = !empty($grandChildModelActions);
		
		if ($actionForGrandChildModel) {
			$validParam = isset($controller->params['pass'][0]) && isset($controller->params['pass'][1]);
			$modelName = $this->modelName;
			
			$modelNames = array_keys($grandChildModelActions);
			
			$gcModelName = $modelNames[0];
			
			$gcModelInstance = ClassRegistry::init($gcModelName);
			
			$foreignKey = '';
			foreach($gcModelInstance->belongsTo as $assocName => $association) {
				if ($assocName == $modelName) {
					$foreignKey = $association['foreignKey'];
				}
			}
			
			if ($validParam && !empty($foreignKey)) {
				$parent_id = $controller->params['pass'][0];
				$id 	   = $controller->params['pass'][1];
				
				// because admin actions are filtered
				// via the acos_aros ACL so we do
				// not need to check for User group type
				
				$gcModelInstance->recursive = -1;
				$gcModelInstance->Behaviors->load('Linkable.Linkable');
				$count = $gcModelInstance->find('count',
						array('conditions'=>
							array("$gcModelName.id"=>$id,
							      "$gcModelName.$foreignKey"=>$parent_id),
							'link'=>array($modelName=>
								      array('conditions'=>array("$modelName.shop_id"=>$shopIdUserHas)
									    )
								)
						)
					);
				if ($count == 0) {
					
					$controller->Session->setFlash(__($this->errorMessage), 'default', array('class'=>'flash_failure'));
					$controller->redirect($this->redirect);
				}
			}	
		}
	}
	
	/**
	 * same as php in_array, but 1 level further down.
	 * if exists, returns the array stripped of other inner arrays. else returns false
	 * $haystack is an array of arrays.
	 **/
	private function in_array_of_arrays($needle, $haystack) {
		if (is_array($haystack)) {
			foreach($haystack as $key=>$innerHaystack) {
				if( in_array($needle, $innerHaystack))
					return array($key=>$innerHaystack);
			}
		}
		return false;
	}
}
?>