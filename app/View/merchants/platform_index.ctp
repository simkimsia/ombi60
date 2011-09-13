<div class="merchants index">
<h2><?php echo __('Merchants');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('full_name');?></th>
	<th><?php echo $paginator->sort('name_to_call');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('password');?></th>
	<th><?php echo $paginator->sort('joined_on');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('last_login_on');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($merchants as $merchant):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $merchant['Merchant']['id']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['full_name']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['name_to_call']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['email']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['password']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['joined_on']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['modified']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['status']; ?>
		</td>
		<td>
			<?php echo $merchant['Merchant']['last_login_on']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View'), array('action' => 'view', $merchant['Merchant']['id'])); ?>
			<?php echo $html->link(__('Edit'), array('action' => 'edit', $merchant['Merchant']['id'])); ?>
			<?php echo $html->link(__('Delete'), array('action' => 'delete', $merchant['Merchant']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $merchant['Merchant']['id'])); ?>
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
		<li><?php echo $html->link(__('New Merchant'), array('action' => 'add')); ?></li>
	</ul>
</div>
