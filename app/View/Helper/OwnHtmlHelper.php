<?php

App::uses('HtmlHelper', 'View/Helper');

class OwnHtmlHelper extends HtmlHelper {

    public function addQueryToCurrentUrl($params = array()) {
		
		$requestParams = $this->request->query;
		return $this->url(array( '?' => array_merge($requestParams, $params)));    
	}
}