<?php
class PermissionComponent extends Object {
 
 
/**
 * list of actions that are supposed to apply the themes to .
 * if empty array, apply to all actions.
 * */

	var $actionsWithPrimaryKey = array('admin_edit',
			     'admin_delete',
			     'admin_view',
			     'admin_toggle');
	
	var $actionsWithShopId = array('admin_add');
	
	var $redirect = array('action'=>'index',
			      'admin' => true);
	
	var $errorMessage = 'You do not have permissions for this ';
	
	var $modelName = '';
	
/**
 * Initialize function
 *
 *
 * @param controller object $controller
 * @param array $settings
 */     
	function initialize(&$controller, $settings=array()) {
		
		$this->actionsWithPrimaryKey = (empty($settings['actionsWithPrimaryKey'])) ? $this->actionsWithPrimaryKey : $settings['actionsWithPrimaryKey'];
		$this->actionsWithShopId = (empty($settings['actionsWithShopId'])) ? $this->actionsWithShopId : $settings['actionsWithShopId'];
		
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
	function startup(&$controller) {
		
		$shopIdUserHas = User::get('Merchant.shop_id');
		
		// check the admin_edit, admin_view,
		// admin_delete, admin_toggle for correct primary key
		// assuming that the url is something like
		// admin/:controller-name/edit/:id
		// we use $controller->params['pass'][0] to access the $id
		
		$this->checkForValidPrimaryKeyInAction($controller, $shopIdUserHas);
		
		$this->checkForValidShopIdInData($controller, $shopIdUserHas);
		
	
	}
	
	private function checkForValidShopIdInData(&$controller, $shopIdUserHas) {
		if (in_array($controller->action, $this->actionsWithShopId)) {
			$validData = !empty($controller->data);
			$modelName = $this->modelName;
			
			if ($validData) {
				$shopId = $controller->data[$modelName]['shop_id'];
				
				if ($shopId !== $shopIdUserHas) {
					$controller->data[$modelName]['shop_id'] = $shopIdUserHas;
				}
			}	
		}
	}
	
	private function checkForValidPrimaryKeyInAction(&$controller, $shopIdUserHas) {
		if (in_array($controller->action, $this->actionsWithPrimaryKey)) {
			$validParam = isset($controller->params['pass'][0]);
			$modelName = $this->modelName;
			
			if ($validParam) {
				$id = $controller->params['pass'][0];
				
				// because admin actions are filtered
				// via the acos_aros ACL so we do
				// not need to check for User group type
				$modelInstance = ClassRegistry::init($modelName);
				
				$count = $modelInstance->find('count',
						array('conditions'=>
							array("$modelName.id"=>$id,
							      "$modelName.shop_id"=>$shopIdUserHas)));
				if ($count == 0) {
					
					$controller->Session->setFlash(__($this->errorMessage, true), 'default', array('class'=>'flash_failure'));
					$controller->redirect($this->redirect);
				}
			}	
		}
	}
}
?>