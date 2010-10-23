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
<title>[Service Name] - Home</title>
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
			<li id="home" class="selectedMenuItem"><span>Home</span></li>
			<li id="about"><a href="about.html"><span>About Us</span></a></li>
			<li id="catalogue"><a href="catalogue.html"><span>Catalogue</span></a></li>
			<li id="blog"><a href="blog.html"><span>Blog</a></span></li>
			<li id="cart"><a href="cart.html"><span>Cart</span></a><div id="cartbadge">3</div></li>			
		</ul>
	</div>
	
	<?php
                if (!empty($content_for_layout)) {
                        echo $content_for_layout;
                }
                else if (!empty($contentElementInOverallContainer)) {
                        echo $this->element($contentElementInOverallContainer);
                }
        ?>

	<div id="footer">
		&copy; Company Name 2010<br />
		<a href="#">Privacy Statement</a> | <a href="#">Disclaimer</a>
	</div>
</div>
</body>

</html>