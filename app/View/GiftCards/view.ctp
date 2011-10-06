<div class="giftCards view">
<h2><?php echo __('Gift Card');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Recipient'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['recipient']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('From'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['from']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('To'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['to']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Message'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['message']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['modified']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Delivery'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $giftCard['GiftCard']['delivery']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Gift Card Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($giftCard['GiftCardType']['type'], array('controller' => 'gift_card_types', 'action' => 'view', $giftCard['GiftCardType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Gc Design'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($giftCard['GcDesign']['name'], array('controller' => 'gc_designs', 'action' => 'view', $giftCard['GcDesign']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gift Card'), array('action' => 'edit', $giftCard['GiftCard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Gift Card'), array('action' => 'delete', $giftCard['GiftCard']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $giftCard['GiftCard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gift Cards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Card'), array('action' => 'add')); ?> </li>
		
		
		<li><?php echo $this->Html->link(__('List Gift Card Types'), array('controller' => 'gift_card_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Card Type'), array('controller' => 'gift_card_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gc Designs'), array('controller' => 'gc_designs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gc Design'), array('controller' => 'gc_designs', 'action' => 'add')); ?> </li>
	</ul>
</div>
