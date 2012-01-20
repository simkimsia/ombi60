<?php
		
	$aaData = array();
	foreach ($webpages as $key=>$webpage) {
		$row 		= array();
		
		$visible 		= $webpage['Webpage']['visible'];
		
		$statusClass = '';
		if (!$visible) {
			$statusClass 	= '<span class="status-hidden">Hidden</span>';
		}


		
		$row[] 		= $this->Html->link(__( $webpage['Webpage']['title']), array('action' => 'view', $webpage['Webpage']['id'])) . $statusClass;
		$row[]		=  $this->Time->niceShort($webpage['Webpage']['modified']); 
		$row[]		= $this->element('trash_delete_icon', array(
										'controllerName' => 'webpages',
										'id'				=> $webpage['Webpage']['id'],
										'singularName' => 'page'
						));
		
		$aaData[] 	= $row;
	}
	
	//sEcho is just some integer that is used to prevent XSS
	//iTotalRecords is total records inside teh database excluding conditions
	//iTotalDisplayRecords is total records after conditions, sorting, paging
	//aaData is array of records returned

	echo json_encode(array(
		'sEcho'					=> intval($sEcho),
		'iTotalRecords'			=> $iTotal,
		'iTotalDisplayRecords'	=> $iTotalDisplay,
		'aaData'				=> $aaData
	));


		
?>