<?php

	$breadcrumbs = array();
	$currentUrl = $_SERVER['REQUEST_URI'];
	
	switch($this->request->params['controller']) {
		case 'orders' :
			$breadcrumbs[] = array('/admin/orders' => 'Orders');
			$modelName = 'Order';
			break;
		case 'products' :
			$breadcrumbs[] = array('/admin/products' => 'Products');
			$modelName = 'Product';
			break;
		case 'webpages' :
			$breadcrumbs[] = array('/admin/pages' => 'Blogs & Pages');
			$modelName = 'Page';
			break;
		case 'blogs' :
			$breadcrumbs[] = array('/admin/pages' => 'Blogs & Pages');
			$modelName = 'Product';
			break;
		case 'links' :
			$breadcrumbs[] = array('/admin/links' => 'Navigation');
			$modelName = 'Link';
			break;
		case 'posts' :
			$breadcrumbs[] = array('/admin/pages' => 'Blogs & Pages');
			$modelName = 'Article';
			break;
		case 'product_groups' :
			$breadcrumbs[] = array('/admin/collections' => 'Collections');
			$modelName = 'Collection';
			break;
		case 'payments' :
			$breadcrumbs[] = array('/admin/payments' => 'Payments');
			$modelName = 'Payment';
			break;
			
		default :
			$breadcrumbs[] = array('/admin' => 'Dashboard');
			$modelName = null;
			break;
	}
	
	if ($this->request->params['action'] == 'admin_add') {
		$breadcrumbs[] = array( $currentUrl => 'Add New ' . $modelName);
	} else if ($this->request->params['action'] == 'admin_view' ||
				$this->request->params['action'] == 'admin_view_smart' ||
				$this->request->params['action'] == 'admin_view_custom') {
		$breadcrumbs[] = array( $currentUrl => $title_for_layout);
	} else if ($this->request->params['action'] == 'admin_add_smart') {
		$breadcrumbs[] = array( $currentUrl => 'Add New Smart Collection');
	} else if ($this->request->params['action'] == 'admin_add_custom') {
		$breadcrumbs[] = array( $currentUrl => 'Add New Custom Collection');
	}

	// add the link for EDIT
	if ($this->request->params['action'] == 'admin_edit' ||
		$this->request->params['action'] == 'admin_edit_smart' ||
		$this->request->params['action'] == 'admin_edit_custom') {
		
		switch($this->request->params['action']) {
			case 'admin_edit_smart' :
				$viewAction = 'admin_view_smart';
				break;
			case 'admin_edit_custom' :
				$viewAction = 'admin_view_custom';
				break;
			default :
				$viewAction = 'admin_view';
				break;
				
		}
		
		$viewLink = Router::url(array(
			'controller' => $this->request->params['controller'],
			'action' => $viewAction,
			'admin' => true,
			'id' => $this->request->params['pass'][0]
		));
		
		$this->log($this->request->params);
		
		$breadcrumbs[] = array( $viewLink 	=> $title_for_layout);
		$breadcrumbs[] = array( $currentUrl => 'EDIT');
	}

	$length = count($breadcrumbs);
	$count = 1;
	foreach($breadcrumbs as $bc) {
 

		foreach ($bc as $link=>$text) {
			$span = '';

			if ($count < $length) {
				$span = '<span>&raquo;</span>';
			}
			
			echo '<li>';
			echo $this->Html->link($text, $link);
			echo $span;
			echo '</li>' . "\n";

		}
		$count += 1;
	}
?>
