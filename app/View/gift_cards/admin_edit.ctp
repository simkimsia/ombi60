<div class="giftCards form">
<?php echo $this->Form->create('GiftCard');?>
	<fieldset>
 		<legend><?php echo __('Admin Edit Gift Card'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recipient');
		echo $this->Form->input('amount');
		echo $this->Form->input('code');
		echo $this->Form->input('from');
		echo $this->Form->input('to');
		echo $this->Form->input('message');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('delivery');
		echo $this->Form->input('gift_card_type_id');
		echo $this->Form->input('gc_design_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('GiftCard.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('GiftCard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Gift Cards'), array('action' => 'index'));?></li>
		
		
		<li><?php echo $this->Html->link(__('List Gift Card Types'), array('controller' => 'gift_card_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Card Type'), array('controller' => 'gift_card_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gc Designs'), array('controller' => 'gc_designs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gc Design'), array('controller' => 'gc_designs', 'action' => 'add')); ?> </li>
	</ul>
</div>