<div class="addresses index">
<h2><?php __('Addresses');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('address');?></th>
	<th><?php echo $paginator->sort('city');?></th>
	<th><?php echo $paginator->sort('region');?></th>
	<th><?php echo $paginator->sort('zip_code');?></th>
	<th><?php echo $paginator->sort('country');?></th>
	<th class="actions"><?php __('Actions');?></th>
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
			<?php echo $html->link(__('View', true), array('action' => 'view', $address['Address']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $address['Address']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $address['Address']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $address['Address']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Address', true), array('action' => 'add')); ?></li>
	</ul>
</div>
