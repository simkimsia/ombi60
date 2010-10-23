<div class="giftCards index">
	<h2><?php __('Gift Cards');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('recipient');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('from');?></th>
			<th><?php echo $this->Paginator->sort('to');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('shop_id');?></th>
			<th><?php echo $this->Paginator->sort('delivery');?></th>
			<th><?php echo $this->Paginator->sort('gift_card_type_id');?></th>
			<th><?php echo $this->Paginator->sort('gc_design_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($giftCards as $giftCard):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $giftCard['GiftCard']['id']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['recipient']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['amount']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['code']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['from']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['to']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['message']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['created']; ?>&nbsp;</td>
		<td><?php echo $giftCard['GiftCard']['modified']; ?>&nbsp;</td>
		
		<td><?php echo $giftCard['GiftCard']['delivery']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($giftCard['GiftCardType']['type'], array('controller' => 'gift_card_types', 'action' => 'view', $giftCard['GiftCardType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($giftCard['GcDesign']['name'], array('controller' => 'gc_designs', 'action' => 'view', $giftCard['GcDesign']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $giftCard['GiftCard']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $giftCard['GiftCard']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $giftCard['GiftCard']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $giftCard['GiftCard']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Gift Card', true), array('action' => 'add')); ?></li>
		
		
		<li><?php echo $this->Html->link(__('List Gift Card Types', true), array('controller' => 'gift_card_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Card Type', true), array('controller' => 'gift_card_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gc Designs', true), array('controller' => 'gc_designs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gc Design', true), array('controller' => 'gc_designs', 'action' => 'add')); ?> </li>
	</ul>
</div>