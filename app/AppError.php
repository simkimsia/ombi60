<?php
class AppError extends ErrorHandler {
        
        function noSuchDomain($params) {
                // set the header to 404 header
                $this->controller->header("HTTP/1.0 404 Not Found");
                
                // define the signup page based on FULL_BASE_URL
                $signup = 'http://mainsite.localhost/pricing-signup';
                if (strpos(FULL_BASE_URL, '.com') > 0) {
                        $signup = 'http://www.openmybusinessin60seconds.com/pricing-signup';
                }
                
                $name = 'No Such Shop Exists';
                
		
                $this->controller->set(array('url'=>$params['url'],
                                             'signup'=>$signup,
                                             'name' => $name,
                                             'message' => h($params['url']),
                                             'title' => $name));
                
                
                $this->controller->layout = "error";
		
                $this->_outputMessage('no_such_domain');
        }
	
	function error404($params) {
		extract($params, EXTR_OVERWRITE);

		if (!isset($url)) {
			$url = $this->controller->here;
		}
		$url = Router::normalize($url);
		$this->controller->header("HTTP/1.0 404 Not Found");
		
		$viewVars = !empty($params['viewVars']) ? $params['viewVars'] : array();
		
		
		// for public views under Twig
		// we need shop, blogs, collections,
		// linklists, pages, cart,
		$allowed404ViewVars = array('blogs', 'collections',
					    'cart', 'linklists',
					    'shop', 'pages');
		
		foreach($allowed404ViewVars as $var) {
			$availableVars = array_keys($viewVars);
			if(in_array($var, $availableVars)) {
				$this->controller->set($var, $viewVars[$var]);
			}
		}
		
		
		$this->controller->set(array(
			'code' => '404',
			'name' => __('Not Found'),
			'message' => h($url),
			'base' => $this->controller->base,
			'page_title' => 'Page Not Found',
			'template' => '404',
		));
		
		$this->controller->view = 'TwigView.Twig';
		$this->controller->layout = 'theme';
		
		$theme = $this->getTheme();
		
		$pathToError = DS . 'themed' . DS . $theme . DS . 'templates' . DS . '404';
		
		
		$this->_outputMessage($pathToError);
		
	}
	
	private function getTheme() {
		
		App::import('Model', 'Shop');
		
		// retrieve the theme name to view pages with
		$shopId = Shop::get('Shop.id');
	
		
		// first check the Cache
		$currentShop = Cache::read('Shop'.$shopId);
	
		// check if Cache is empty by checking the theme used
		if (empty($currentShop) ||
		    empty($currentShop['FeaturedSavedTheme']['name'])) {
	
			// since cache does not have this, we shall go to database to retrieve
			
			$this->controller->loadModel('Shop');
			
			$this->controller->Shop->recursive = -1;
			$this->controller->Shop->Behaviors->attach('Containable');
			
			$shop = $this->controller->Shop->find('first', array('conditions'=>array('Shop.id'=>$shopId),
								 'contain'=>array( 'FeaturedSavedTheme')));
			
	
			// now we write to Cache
			Cache::write('Shop'.$shopId, $shop);
			// once again we read from Cache.
			$currentShop = Cache::read('Shop'.$shopId);
		}
		
		$this->controller->theme = !empty($currentShop['FeaturedSavedTheme']['folder_name']) ? $currentShop['FeaturedSavedTheme']['folder_name'] : 'blue-white';
		
		return $this->controller->theme;
	}
    
}

?>