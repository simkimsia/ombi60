<div class="productGroups index">
	<h2><?php __('Product Groups');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('shop_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('product_count');?></th>
			<th><?php echo $this->Paginator->sort('handle');?></th>
			<th><?php echo $this->Paginator->sort('vendor_count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($productGroups as $productGroup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $productGroup['ProductGroup']['id']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['title']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productGroup['Shop']['name'], array('controller' => 'shops', 'action' => 'view', $productGroup['Shop']['id'])); ?>
		</td>
		<td><?php echo $productGroup['ProductGroup']['created']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['modified']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['description']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['product_count']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['handle']; ?>&nbsp;</td>
		<td><?php echo $productGroup['ProductGroup']['vendor_count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $productGroup['ProductGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $productGroup['ProductGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productGroup['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productGroup['ProductGroup']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Product Group', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Shops', true), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop', true), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products In Groups', true), array('controller' => 'products_in_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products In Group', true), array('controller' => 'products_in_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>