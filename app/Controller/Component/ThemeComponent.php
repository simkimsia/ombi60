<?php
class ThemeComponent extends Component {
 
 
/**
 * list of actions that are supposed to apply the themes to .
 * if empty array, apply to all actions.
 * */

	var $actions = array();

/**
 * Constructor.
 *
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
        $this->actions = (empty($settings['actions'])) ? $this->actions : (array) $settings['actions'];

	}

	
 
 
/**
 * Standard code for retrieving the right theme to display for the right shop
 *
 * Code must be in startup function aka after beforeFilter but before action handler
 * Reason unknown, suspect have to do with the fact that Shop::get does not work before
 * beforeFilter method in controllers
 *
 * @param controller object $controller 
 */     
	function startup(Controller $controller) {
		
		if (in_array($controller->action, $this->actions) || empty($this->actions)) {
		
			// retrieve the theme name to view pages with
			$shopId = Shop::get('Shop.id');
		
			
			// first check the Cache
			$currentShop = Cache::read('Shop'.$shopId);
		
			// check if Cache is empty by checking the theme used
			if (empty($currentShop) ||
			    empty($currentShop['FeaturedSavedTheme']['name'])) {
		
				// since cache does not have this, we shall go to database to retrieve
				
				$controller->loadModel('Shop');
				
				$controller->Shop->recursive = -1;
				$controller->Shop->Behaviors->attach('Containable');
				
				$shop = $controller->Shop->find('first', array('conditions'=>array('Shop.id'=>$shopId),
									 'contain'=>array( 'FeaturedSavedTheme')));
				
		
				// now we write to Cache
				Cache::write('Shop'.$shopId, $shop);
				// once again we read from Cache.
				$currentShop = Cache::read('Shop'.$shopId);
			}
			
			$controller->theme = !empty($currentShop['FeaturedSavedTheme']['folder_name']) ? $currentShop['FeaturedSavedTheme']['folder_name'] : 'blue-white';
			    
		}
	
	
	}
}
?>