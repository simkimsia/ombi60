<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<!-- Default Style -->
<!--<link href="style_default/style.css" type="text/css" media="screen" rel="stylesheet" />-->
<!-- Alternative Style -->
<!--<link href="style_alternative/style.css" type="text/css" media="screen" rel="stylesheet" />-->
<title>
	<?php
		if (!empty($shopName_for_layout)) {
			echo $shopName_for_layout;
		}
		if (!empty($shopName_for_layout) && !empty($title_for_layout)) {
			echo ' - ';
		}
		if (!empty($title_for_layout)) {
			echo $title_for_layout;
		}
	?>
</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('style');
		
		echo $this->Html->css('spree2shop.jquery.tools');

		echo $scripts_for_layout;
	?>
</head>

<body>
	
<div id="overallContainer" class="<?php if (!empty($classForContainer)) echo $classForContainer; ?>">
	<div id="header">
		<div id="headerContent">
			<h1><a href="#"><span>Service Name</span></a></h1>
			<h2>Username <input name="txtUsername" type="text" /> Password <input name="txtUsername" type="password" /></h2>
		</div>
	</div>

	<div id="menu">
		<ul id="menuItems">
			
			<?php
			
			// there is a class called selectedMenuItem. to be added later 
			if (isset($mainMenu['Link']) && is_array($mainMenu['Link'])) {
				$count = 0;
				foreach($mainMenu['Link'] as $key=>$link) {
					$class = '';
					if ($count == 0) {
						$class = ' class="home"';
					}
					$menuLink = '
			<li '.$class.'>';
					$menuLink .= $this->Html->link($link['name'], $link['route']);
					
					// cater for the badge in cart
					if (strpos($link['route'],'/cart/view') !== false) {
						$menuLink .= '<div id="cartbadge">';
						
						// the cart items count
						if (isset($cartItemsCount) && $cartItemsCount > 0) {
							$menuLink .= $cartItemsCount;
						}
						
						$menuLink .= '</div>';
					}
					
					$menuLink .= '</li>';
					
					echo $menuLink;
					
					$count ++;
			
				}
			}
			
			
			?>
			
		</ul>
	</div>
	
	<span id="contentInOverallContainer" class="<?php if (!empty($classForContentContainer)) echo $classForContentContainer; ?>">
	<?php
                if (!empty($content_for_layout)) {
			echo $this->Session->flash(); 
                        echo $content_for_layout;
                }
        ?>
	</span>

	<div id="footer">
		&copy; Company Name 2010<br />
		<a href="#">Privacy Statement</a> | <a href="#">Disclaimer</a>
	</div>
</div>
</body>

</html>