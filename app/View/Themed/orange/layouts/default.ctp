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
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('styles');
		//echo $this->Html->css('spree2shop.jquery.tools');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			
			
			
				
			<?php echo $this->Html->tag('ul', $this->element('welcomenav'), array('id' => 'welcomenav')); ?>
			
			
			
			<?php echo $this->Html->tag('ul', $this->element('nav'), array('id' => 'navigation')); ?>
			
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			
			

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<ul>
				<li><a href="#">Search1</a></li>
				
				<li><a href="#">About Us</a></li>
			</ul>
			<div class="floatright">&copy; 2010 nailstickk. This online store is powered by </div>
			
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>