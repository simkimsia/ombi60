<?php

	echo $this->Html->script('http://cdn.jquerytools.org/1.2.4/full/jquery.tools.min.js');
	
?>

<div class="giftCards form">
<?php echo $this->Form->create('GiftCard');?>
	<fieldset>
 		<legend><?php __('Add Gift Card'); ?></legend>
	<?php
		echo $this->Form->input('recipient');
		echo $this->Form->input('amount');
		
		echo $this->Form->input('from');
		echo $this->Form->input('to');
		echo $this->Form->input('message');
		echo $this->Form->input('shop_id', array('type'=>'hidden', 'value'=>Shop::get('Shop.id')));
		
		echo '<input class="date" type="date" id="GiftCardDelivery" name="data[GiftCard][delivery]" value="today" min="'. date('Y-m-d') .'" max="'.date('Y-m-d', strtotime("+1 years")).'" />'; 
		
		echo $this->Form->input('gift_card_type_id');
		echo $this->Form->input('gc_design_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gift Cards', true), array('action' => 'index'));?></li>
		
		
		<li><?php echo $this->Html->link(__('List Gift Card Types', true), array('controller' => 'gift_card_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gift Card Type', true), array('controller' => 'gift_card_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gc Designs', true), array('controller' => 'gc_designs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gc Design', true), array('controller' => 'gc_designs', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script> 
 
$(":date").dateinput({
	format: 'dddd dd, mmmm yyyy',	// the format displayed for the user
	selectors: true,             	// whether month/year dropdowns are shown
	min: -100,                    // min selectable day (100 days backwards)
	max: 100,                    	// max selectable day (100 days onwards)
	offset: [10, 20],            	// tweak the position of the calendar
	speed: 'fast',               	// calendar reveal speed
	firstDay: 1                  	// which day starts a week. 0 = sunday, 1 = monday etc..
});
</script>