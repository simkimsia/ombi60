<div class="login form">
<?php
	echo $this->Session->flash('auth');
	
	echo $form->create('User', array('action' => 'login'));
?>
	<fieldset>
 		<legend><?php __('Login');?></legend>
	<?php
		echo $form->input('User.email');
		echo $form->input('User.password');
		
		
		
	?>
	</fieldset>
	

<?php echo $form->end('Login');?>
</div>


