<div class="products form">
<?php echo $this->Form->create('Product');?>
	<fieldset>
 		<legend><?php echo __('Edit Product');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('title');
		echo $this->Form->input('code');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
		echo $this->Form->input('created');
		echo $this->Form->input('modified');
		echo $this->Form->input('visible');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Product.id'))); ?></li>
		<li><?php echo $html->link(__('List Products'), array('action' => 'index'));?></li>
	</ul>
</div>
