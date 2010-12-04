<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset().PHP_EOL; ?>
	<title><?php __d('lil_blogs', 'Blog Administration').'  '.$title_for_layout; ?></title>
	<?php echo $html->css('/lil_blogs/css/lil'); ?>
	<?php echo $html->css('/lil_blogs/css/style').PHP_EOL; ?>
	
	<?php echo $scripts_for_layout.PHP_EOL; ?>
</head>
<body>
	<div id="container">
		<?php if ($session->check('Message.flash')) $session->flash(); ?>
		<?php if ($session->check('Message.auth')) $session->flash('auth'); ?>
		<div id="header">
			<div id="header_logo">
				<?php echo $html->link($html->image('/lil_blogs/img/logo.gif'), '/', null, null, false); ?>
			</div>
			<?php
				if ($auth->user(Configure::read('LilBlogsPlugin.authorAdminField'))) {
					echo $this->element('admin_navigation');
				}
			?>
		</div>

		<div id="content">
			<div id="sidebar">
				<?php echo $this->element('admin_sidebar'); ?>
			</div>
			<div id="main">
				<?php echo $content_for_layout;?>
			</div>
			<div style="clear: both">&nbsp;</div>
		</div>
	</div>
	
</body>
</html>