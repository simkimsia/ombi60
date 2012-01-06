<div class="merchants form">
	
	
	
<?php echo $this->Form->create('Merchant');?>
	<fieldset>
 		<legend><?php echo __('Profile');?></legend>
	<?php
		echo $this->Form->input('User.full_name');
		echo $this->Form->input('User.name_to_call');
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.original_email', array('type'=>'hidden', 'value'=>$this->Form->value('User.email')));
		echo $this->Form->input('User.current_password', array('type' => 'password', 'value'=>''));
		echo $this->Form->input('User.new_password', array('type' => 'password', 'value' => ''));
		echo $this->Form->input('User.new_password_confirm', array('type' => 'password', 'value'=>''));
		echo $this->Form->input('Merchant.id', array('type'=>'hidden') );
		echo $this->Form->input('User.id', array('type'=>'hidden') );
		echo $this->Form->input('User.language_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
