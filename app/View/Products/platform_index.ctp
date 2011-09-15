<div class="products index">
<h2><?php echo __('Products');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('shop_id');?></th>
	<th><?php echo $this->Paginator->sort('title');?></th>
	<th><?php echo $this->Paginator->sort('code');?></th>
	<th><?php echo $this->Paginator->sort('description');?></th>
	<th><?php echo $this->Paginator->sort('price');?></th>
	<th><?php echo $this->Paginator->sort('created');?></th>
	<th><?php echo $this->Paginator->sort('modified');?></th>
	<th><?php echo $this->Paginator->sort('visible');?></th>
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
	<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Product'), array('action' => 'add')); ?></li>
	</ul>
</div>
