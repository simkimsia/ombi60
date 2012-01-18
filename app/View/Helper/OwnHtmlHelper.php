<?php

App::uses('HtmlHelper', 'View/Helper');

class OwnHtmlHelper extends HtmlHelper {

    public function addQueryToCurrentUrl($params = array()) {
		
		$requestParams = $this->request->query;
		return $this->url(array( '?' => array_merge($requestParams, $params)));    
	}
	
	public function removeQueryFromCurrentUrl($params = array()) {
		
		if (is_string($params)) {
			$params = array($params);
		} 
		
		
		$requestParams = $this->request->query;
		
		foreach($params as $param) {
			unset($requestParams[$param]);
		}
		
		return $this->url(array( '?' => $requestParams));    
	}
}