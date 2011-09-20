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
		<?php echo __('OMBI60: Open My Business in 60 Seconds:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('base');
		echo $this->Html->css('spree2shop.jquery.tools');
		echo $this->Html->css('admin');
		//echo $this->Html->css('multirow-checkbox-menu');
		echo $this->Html->script('ops/admin');
		//echo $this->Html->script('simpleweb/jquery.multirowcheckboxmenu');
		
		
		if ($this->name = 'SavedThemes') {
			if ($this->request->action = 'admin_edit') {
				echo $this->Html->css('overlay-apple');
			}
			
			echo $this->Html->css('saved_themes');
		}
        echo $this->Html->script('jquery.js'); 
    // JS
    //echo $this->Html->scriptBlock('var baseUrl = "' . $this->Html->url('/').'";');
    //echo $this->Html->scriptBlock('var js_vars = ' . $this->Js->object($js_vars).';');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="headerleft">
			<h1><?php echo $this->Html->image('logo.png', array('alt' => 'OMBI60: Open My Business In 60s')); ?></h1>
			</div>
			<div id="headerright">
				<ul>
				<li><input name="Search" type="text" /></li>
				<li class="specialli"><?php echo $this->Html->link('Account', '/admin/account'); ?> | <?php echo $this->Html->link('Logout', '/admin/logout'); ?></li>
				</ul>
			</div>
		</div>
		<?php if ($this->request->params['action'] != 'admin_login') { ?>
		<div id="barwrapper">
			<div id="contentbar">
			<div id="barleft">
				<?php
				
					$homeSelected = '';
					$ordersSelected = '';
					$productsSelected = '';
					$collectionsSelected = '';
					$blogsPagesSelected = '';
					$marketingSelected = '';
					$navigationSelected = '';
					
					switch($this->request->params['controller']) {
						case 'orders' :
						$ordersSelected = ' class=selected ';
						break;
						case 'products' :
							$productsSelected = ' class=selected ';
							break;
						case 'webpages' :
							$blogsPagesSelected = ' class=selected ';
							break;
						case 'links' :
							$navigationSelected = ' class=selected';
							break;
					}
				?>
				<ul >
					<li <?php echo $homeSelected; ?>><?php echo $this->Html->link('Home', '/admin'); ?></li>
					<li <?php echo $ordersSelected; ?>><?php echo $this->Html->link('Orders', '/admin/orders'); ?></li>
					<li <?php echo $productsSelected; ?>><?php echo $this->Html->link('Products', '/admin/products'); ?></li>
					<li <?php echo $collectionsSelected; ?>><?php echo $this->Html->link('Collections', '/admin/collections'); ?></li>
					<li <?php echo $blogsPagesSelected; ?>><?php echo $this->Html->link('Blogs & Pages', '/admin/pages'); ?></li>
					<li <?php echo $navigationSelected; ?>><?php echo $this->Html->link('Navigation', '/admin/links'); ?></li> 
				</ul>
			</div>
			<div id="barright">
				<ul class="topnav">
					<li class="PY_slide">
						<a href="#"><strong>Themes</strong></a>
						<ul id="subnav" class="govern">  
							
							<li><?php echo $this->Html->link('My themes', '/admin/saved_themes/switch'); ?></li>  
							<li><?php echo $this->Html->link('Theme Settings', '/admin/themes/settings'); ?></li>  
						</ul>
					</li>
					<li class="PY_slide">
						<a href="#"><strong>Preferences</strong></a>
						<ul id="subnav" class="govern">  
							<li><?php echo $this->Html->link('Domains', '/admin/domains'); ?></li>  
							<li><?php echo $this->Html->link('Payments', '/admin/payments'); ?></li>
							<li><?php echo $this->Html->link('Shipping', '/admin/shipping'); ?></li>
							<li><?php echo $this->Html->link('General Settings', '/admin/general_settings'); ?></li>    
						</ul>
					</li>
				</ul>
			</div>			
			</div>
		</div>
		<!-- end of new code -->
		<?php } ?>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			
			<?php //echo $this->element('admin_scripts'); ?>

			<?php echo $content_for_layout; ?>

			<?php echo $this->Html->image('indicator.gif', array('id' => 'busy-indicator')); ?>

		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('OMBI60: Open My Business in 60 Seconds'), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);*/
			?>
		</div>
	</div>
	
	<script type="text/javascript"> 
        $(document).ready(function() {  
            $("a").click(function() {  
             $(".govern").not($(this).next(".govern")).slideUp("fast");
               $(this).next(".govern").slideToggle("fast");
          });
		  $(".topnav .PY_slide").eq(0).addClass("first");
		  $(".topnav .PY_slide").click(function(){
			$(this).toggleClass("active");
			$(this).siblings(".PY_slide").removeClass("active");
			});  
       });  
	   
	   
     </script> 
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
