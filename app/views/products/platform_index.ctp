<div class="products index">
<h2><?php echo __('Products');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('shop_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('code');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('price');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('visible');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $product['Product']['id']; ?>
		</td>
		<td>
			<?php echo $product['Product']['shop_id']; ?>
		</td>
		<td>
			<?php echo $product['Product']['title']; ?>
		</td>
		<td>
			<?php echo $product['Product']['code']; ?>
		</td>
		<td>
			<?php echo $product['Product']['description']; ?>
		</td>
		<td>
			<?php echo $product['Product']['price']; ?>
		</td>
		<td>
			<?php echo $product['Product']['created']; ?>
		</td>
		<td>
			<?php echo $product['Product']['modified']; ?>
		</td>
		<td>
			<?php echo $product['Product']['visible']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $html->link(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Product'), array('action' => 'add')); ?></li>
	</ul>
</div>
