<div class="domains form">
<?php echo $this->Form->create('Domain');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s'), __('Domain')); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('primary');
		echo $this->Form->input('always_redirect_here');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Domain.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Domain.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s'), __('Domains')), array('action' => 'index'));?></li>
		
		
	</ul>
</div>