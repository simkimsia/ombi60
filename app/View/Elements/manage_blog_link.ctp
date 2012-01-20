<?php

	//$title
	//$id
	
	$manageText = 'Manage ' . $title . ' blog';
	echo $this->Html->link(__($manageText), array(
		'controller' => 'blogs',
		'action'	 => 'view',
		'admin' 	 => true,
		$id), array(
			'class' => "view-all-articles"
		));

?>