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
		

		echo $this->Html->css('themeforest/terminator/reset');
		echo $this->Html->css('themeforest/terminator/screen');
		echo $this->Html->css('themeforest/terminator/fancybox');
		echo $this->Html->css('themeforest/terminator/jquery.wysiwyg');
		echo $this->Html->css('themeforest/terminator/jquery.ui');
		echo $this->Html->css('themeforest/terminator/visualize');
		echo $this->Html->css('themeforest/terminator/visualize-light');
		
		// action links copied from shopify admin
		echo $this->Html->css('admin.actionlinks');
		
        echo $this->Html->script('jquery.js'); 

        echo $this->Html->script('themeforest/terminator/jquery.visualize');
        echo $this->Html->script('themeforest/terminator/jquery.wysiwyg');
        echo $this->Html->script('themeforest/terminator/tiny_mce/jquery.tinymce');
        echo $this->Html->script('themeforest/terminator/jquery.fancybox');
        echo $this->Html->script('themeforest/terminator/jquery.idtabs');
        echo $this->Html->script('themeforest/terminator/jquery.datatables');
        echo $this->Html->script('themeforest/terminator/jquery.jeditable');
        echo $this->Html->script('themeforest/terminator/jquery.ui');
        echo $this->Html->script('themeforest/terminator/jquery.jcarousel');
        echo $this->Html->script('themeforest/terminator/jquery.validate');


        echo $this->Html->script('themeforest/terminator/excanvas');
        echo $this->Html->script('themeforest/terminator/cufon');
        echo $this->Html->script('themeforest/terminator/Zurich_Condensed_Lt_Bd');
        echo $this->Html->script('themeforest/terminator/script');

    // JS
    //echo $this->Html->scriptBlock('var baseUrl = "' . $this->Html->url('/').'";');
    //echo $this->Html->scriptBlock('var js_vars = ' . $this->Js->object($js_vars).';');

		echo $scripts_for_layout;
	?>
</head>

<?php $adminLoginPage = ($this->request->params['action'] == 'admin_login'); ?>

	<?php if ($adminLoginPage) : ?>
<body class="login">
		<?php echo $content_for_layout; ?>
	<?php else: ?>
<body>
	<div class="pagetop">
		<div class="head pagesize"> <!-- *** head layout *** -->
			<div class="head_top">
				<div class="topbuts">
					<ul class="clear">
					<li><a href="#">View Site</a></li>
					<li><a href="#">Messages</a></li>
					<li><?php echo $this->Html->link('Account', '/admin/account'); ?></li>
					<li><?php echo $this->Html->link('Logout', '/admin/logout', array('class' => 'red')); ?></li>
					</ul>

					<div class="user clear">
						<?php echo $this->Html->image('themeforest/terminator/avatar.jpg', array('class' => 'avatar')); ?>
						<span class="user-detail">
							<span class="name">Welcome Arnold</span>
							<span class="text">Logged as admin</span>
							<span class="text">You have <a href="#">5 messages</a></span>
						</span>
					</div>
				</div>

				<div class="logo clear">
				<a href="index.html" title="View dashboard">
					<?php echo $this->Html->image('themeforest/terminator/logo_earth.png', array('class' => 'picture')); ?>
					<span class="textlogo">
						<span class="title">TERMINATOR</span>
						<span class="text">admin template</span>
					</span>
				</a>
				</div>
			</div>


			<?php
			// decide which menu tab to highlight
				$homeSelected = '';
				$ordersSelected = '';
				$productsSelected = '';
				$collectionsSelected = '';
				$blogsPagesSelected = '';
				$marketingSelected = '';
				$navigationSelected = '';
				
				switch($this->request->params['controller']) {
					case 'orders' :
						$ordersSelected = ' class=active ';
						break;
					case 'products' :
						$productsSelected = ' class=active ';
						break;
					case 'webpages' :
						$blogsPagesSelected = ' class=active ';
						break;
					case 'links' :
						$navigationSelected = ' class=active';
						break;
					default :
						$homeSelected = ' class=active';
						break;
				}
			?>

			<div class="menu">
				<ul class="clear">
				<li <?php echo $homeSelected; ?>><?php echo $this->Html->link('Home', '/admin'); ?></li>
				<li <?php echo $ordersSelected; ?>><?php echo $this->Html->link('Orders', '/admin/orders'); ?></li>
				<li <?php echo $productsSelected; ?>><?php echo $this->Html->link('Products', '/admin/products'); ?></li>
				<li <?php echo $collectionsSelected; ?>><?php echo $this->Html->link('Collections', '/admin/collections'); ?></li>
				<li <?php echo $blogsPagesSelected; ?>><?php echo $this->Html->link('Blogs & Pages', '/admin/pages'); ?></li>
				<li <?php echo $navigationSelected; ?>><?php echo $this->Html->link('Navigation', '/admin/links'); ?></li> 
				</ul>
			</div>
		</div>
	</div>
	<div class="breadcrumb">
		<div class="bread-links pagesize">
			<ul class="clear">
			<li class="first">You are here:</li>
			<li><a href="#">Dashboard</a></li>
			</ul>
		</div>
	</div>
	
	<div class="main pagesize"> <!-- *** mainpage layout *** -->
		<div class="main-wrap">
			<div class="page clear">

	<?php echo $content_for_layout; ?>
	
			</div><!-- end of page -->
		</div>
	</div>

	<div class="footer">
		<div class="pagesize clear">
			<p class="bt-space15"><span class="copy"><strong>&copy; 2012 Copyright by <a href="http://www.openmybusinessin60seconds.com">SpreeToShop Pte Ltd</a></strong></span> Powered by <a href="#">OMBI60</a></p>
			<?php echo $this->Html->image('themeforest/terminator/logo_earth_bw50.png', array('class' => 'block center')); ?>
		</div>
	</div>
	<?php endif; ?>
	
</body>
</html>