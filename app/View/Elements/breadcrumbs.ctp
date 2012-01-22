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
		default :
			$breadcrumbs[] = array('/admin' => 'Dashboard');
			$modelName = null;
			break;
	}
	
	if ($this->request->params['action'] == 'admin_add') {
		$breadcrumbs[] = array( $currentUrl => 'Add New ' . $modelName);
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
