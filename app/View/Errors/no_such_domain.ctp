<?php
/**
 *
 * 
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php echo __('Error'); ?>: </strong>
	<?php
            printf(__('The requested address %s was not found on this server.'), "<strong>'{$message}'</strong>");
            echo '<br />';
            $signupLink = $this->Html->link('here', $signup);
            printf(__('If you want to have your own store with this url %s, sign up %s'), "<strong>'{$url}'</strong>", $signupLink);
        ?>
        
</p>