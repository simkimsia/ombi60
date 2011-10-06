<div class="merchants form">
<?php echo $this->Form->create('Merchant');?>
	<fieldset>
 		<legend><?php echo __('Edit Merchant');?></legend>
	<?php
		echo $this->Form->input('full_name');
		echo $this->Form->input('name_to_call');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
