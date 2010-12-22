<div class="blogs form">
<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php __('Admin Add Blog'); ?></legend>
	<?php
		echo $this->Form->input('name');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Blogs', true), array('action' => 'index'));?></li>
		
		
	</ul>
</div>