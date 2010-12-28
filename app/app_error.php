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
    
}	
?>