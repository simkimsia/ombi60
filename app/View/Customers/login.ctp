<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
?>
<div class="login form">
<?php
	echo $this->Session->flash('auth');
	
	echo $this->Form->create('Customer', array('action' => 'login'));
?>
	<fieldset>
 		<legend><?php echo __('Login');?></legend>
	<?php
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.password');
		echo $this->Form->input('Customer.shop_id', array('type'=>'hidden', 'value'=>$shop_id));
	?>
	</fieldset>
	

<?php echo $this->Form->end('Login');?>
</div>