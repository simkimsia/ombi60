<?php

	//$controllerName
	//$id
	//$singularName

	// $link
	
	$trashIcon = $this->Html->image(
		"admin/icons/trash.gif", array("alt" => "Delete")); 
	
	if (!isset($link)) {
		$link = $this->Html->link($trashIcon, array('controller'=>$controllerName,'action' => 'delete', $id), array('escape'=>false), sprintf(__('Are you sure you want to delete this '.$singularName.'?')));
		
	}
	
	echo $link;
?>