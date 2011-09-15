<div class="login form">
<?php
	echo $this->Session->flash('auth');
	
	echo $this->Form->create('User', array('action' => 'login'));
?>
	<fieldset>
 		<legend><?php echo __('Login');?></legend>
	<?php
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.password');
		
		
		
	?>
	</fieldset>
	

<?php echo $this->Form->end('Login');?>
</div>


