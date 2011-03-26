<div class="productGroups view">
<h2><?php  __('Product Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shop'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($productGroup['Shop']['name'], array('controller' => 'shops', 'action' => 'view', $productGroup['Shop']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['product_count']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Handle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['handle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Vendor Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productGroup['ProductGroup']['vendor_count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Group', true), array('action' => 'edit', $productGroup['ProductGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Product Group', true), array('action' => 'delete', $productGroup['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productGroup['ProductGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Groups', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Group', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops', true), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop', true), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products In Groups', true), array('controller' => 'products_in_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products In Group', true), array('controller' => 'products_in_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Products In Groups');?></h3>
	<?php if (!empty($productGroup['ProductsInGroup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Product Group Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($productGroup['ProductsInGroup'] as $productsInGroup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $productsInGroup['id'];?></td>
			<td><?php echo $productsInGroup['product_id'];?></td>
			<td><?php echo $productsInGroup['product_group_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products_in_groups', 'action' => 'view', $productsInGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products_in_groups', 'action' => 'edit', $productsInGroup['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products_in_groups', 'action' => 'delete', $productsInGroup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productsInGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Products In Group', true), array('controller' => 'products_in_groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
