<div class="links form">
<?php echo $this->Form->create('Link');?>
	<fieldset>
 		<legend><?php echo __('Add Link'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('route');
		echo $this->Form->input('link_list_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Links'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Link Lists'), array('controller' => 'link_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link List'), array('controller' => 'link_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>