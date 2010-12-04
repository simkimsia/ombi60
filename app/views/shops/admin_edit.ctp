<div class="shops form">
<?php echo $this->Form->create('Shop');?>
	<fieldset>
 		<legend><?php __('Edit Shop');?></legend>
	<?php
		
		echo $this->Form->input('Shop.theme_id');
		echo $this->Form->input('Shop.name');
		echo $this->Form->input('Shop.id', array('type'=>'hidden') );
		
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Shop.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Shop.id'))); ?></li>
		<li><?php echo $html->link(__('List Shops', true), array('action' => 'index'));?></li>
	</ul>
</div>
