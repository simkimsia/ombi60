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
<body class="login">
	<?php echo $content_for_layout; ?>
	
</body>
</html>