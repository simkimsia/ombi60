<div class="productGroups form">
<?php echo $this->Form->create('ProductGroup');?>
	<fieldset>
 		<legend><?php __('Add Product Group'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('description');
		echo $this->Form->input('product_count');
		echo $this->Form->input('handle');
		echo $this->Form->input('vendor_count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Product Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Shops', true), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop', true), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products In Groups', true), array('controller' => 'products_in_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products In Group', true), array('controller' => 'products_in_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>