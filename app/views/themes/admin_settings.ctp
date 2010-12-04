<div class="themes form">
<?php echo $this->Form->create('Theme');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Theme', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('author');
		echo $this->Form->input('available_for_all');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Themes', true)), array('action' => 'index'));?></li>
		
		
	</ul>
</div>