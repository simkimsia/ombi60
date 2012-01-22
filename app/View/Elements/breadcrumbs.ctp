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
	} else if ($this->request->params['action'] == 'admin_view' || $this->request->params['action'] == 'admin_edit' ) {
		$breadcrumbs[] = array( $currentUrl => $title_for_layout);
	} else if ($this->request->params['action'] == 'admin_add_smart') {
		$breadcrumbs[] = array( $currentUrl => 'Add New Smart Collection');
	} else if ($this->request->params['action'] == 'admin_add_custom') {
		$breadcrumbs[] = array( $currentUrl => 'Add New Custom Collection');
	}


	$length = count($breadcrumbs);
	$count = 1;
	foreach($breadcrumbs as $bc) {
 

		foreach ($bc as $link=>$text) {
			$span = '';

			if ($count < $length) {
				$span = '<span>&raquo;</span>';
			}
			echo '<li><a href="'.$link.'">'.$text.'</a>'.$span.'</li>' . "\n";

		}
		$count += 1;
	}
?>
