<div class="merchants form">
	
	
	
<?php echo $this->Form->create('Merchant');?>
	<fieldset>
 		<legend><?php __('Profile');?></legend>
	<?php
		echo $this->Form->input('User.full_name');
		echo $this->Form->input('User.name_to_call');
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.original_email', array('type'=>'hidden', 'value'=>$this->Form->value('User.email')));
		//echo $this->Form->input('User.password');
		//echo $this->Form->input('User.password_confirm', array('type' => 'password'));
		echo $this->Form->input('Merchant.id', array('type'=>'hidden') );
		echo $this->Form->input('User.id', array('type'=>'hidden') );
		echo $this->Form->input('User.language_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
