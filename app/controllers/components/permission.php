<?php
class PermissionComponent extends Object {
 
 
/**
 * list of actions that are supposed to apply the themes to .
 * if empty array, apply to all actions.
 * */

	var $actions = array('admin_edit',
			     'admin_delete',
			     'admin_view',
			     'admin_toggle');
	
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
		
		$this->actions = (empty($settings['actions'])) ? $this->actions : $settings['actions'];
		
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
		
		// check the admin_edit, admin_view,
		// admin_delete, admin_toggle for correct primary key
		// assuming that the url is something like
		// admin/:controller-name/edit/:id
		// we use $controller->params['pass'][0] to access the $id
		
		if (in_array($controller->action, $this->actions)) {
			$validParam = isset($controller->params['pass'][0]);
			$modelName = $this->modelName;
			
			if ($validParam) {
				$id = $controller->params['pass'][0];
				
				// because admin actions are filtered
				// via the acos_aros ACL so we do
				// not need to check for User group type
				$modelInstance = ClassRegistry::init($modelName);
				
				$shopIdUserHas = User::get('Merchant.shop_id');
				
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