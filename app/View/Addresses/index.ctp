<div class="addresses index">
<h2><?php echo __('Addresses');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('address');?></th>
	<th><?php echo $this->Paginator->sort('city');?></th>
	<th><?php echo $this->Paginator->sort('region');?></th>
	<th><?php echo $this->Paginator->sort('zip_code');?></th>
	<th><?php echo $this->Paginator->sort('country');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($addresses as $address):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $address['Address']['id']; ?>
		</td>
		<td>
			<?php echo $address['Address']['address']; ?>
		</td>
		<td>
			<?php echo $address['Address']['city']; ?>
		</td>
		<td>
			<?php echo $address['Address']['region']; ?>
		</td>
		<td>
			<?php echo $address['Address']['zip_code']; ?>
		</td>
		<td>
			<?php echo $address['Address']['country']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $address['Address']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $address['Address']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $address['Address']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $address['Address']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Address'), array('action' => 'add')); ?></li>
	</ul>
</div>
