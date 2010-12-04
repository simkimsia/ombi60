<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	echo $this->Html->script('jquery/jquery.tools-1.2.ui-full.min');
	
	// include uploadify specific js files
	echo $this->Html->script('/uploadify/js/jquery.uploadify.v2.1.0.min');
	echo $this->Html->script('/uploadify/js/swfobject');
	echo $this->element('jquery_uploadify_js', array('plugin' => 'uploadify'));
	
?>

	<div><?php echo $this->element('products_admin_edit_form'); ?></div>
	<div>
		
		<?php echo $this->element('product_images_add_form_uploadify'); ?>
	</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Product.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Products', true)), array('action' => 'index'));?></li>

	</ul>
</div>