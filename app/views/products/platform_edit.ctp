<div class="products form">
<?php echo $form->create('Product');?>
	<fieldset>
 		<legend><?php echo __('Edit Product');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('shop_id');
		echo $form->input('title');
		echo $form->input('code');
		echo $form->input('description');
		echo $form->input('price');
		echo $form->input('created');
		echo $form->input('modified');
		echo $form->input('visible');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete'), array('action' => 'delete', $form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $form->value('Product.id'))); ?></li>
		<li><?php echo $html->link(__('List Products'), array('action' => 'index'));?></li>
	</ul>
</div>
