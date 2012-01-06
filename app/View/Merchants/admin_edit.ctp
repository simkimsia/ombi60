<?php echo $this->Form->create('Merchant', array(
	'class' => 'validate-form form bt-space15', 
	'inputDefaults' => array(
		'label' => array(
			'class' => 'form-label size-120 fl-space2'
		),
		'div'	=> array(
			'class' => 'form-field clear'
		),
		'error' => array(
			'attributes' => array(
				'wrap' => 'label', 
				'class' => 'error', 
				//'for' wait for Graham reply on this code
			)
		)
	)
));?>

	<div class="columns clear bt-space15">
		<div class="col3-3">

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
			
		</div>
	</div>
	<input type="submit" class="button green fl" value="Submit" />
<?php echo $this->Form->end();?>