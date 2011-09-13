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
		
		echo $this->Form->submit('Login to checkout', array('name'=>'loginBtn', 'value'=>'login', 'id'=>'login2CheckoutButton'));
		
		echo $this->Html->link('I want an account!', array('action'=>'register'));
	?>
	</fieldset>
	
	
	<fieldset>
 		
	<?php
		echo $this->Form->submit('I don\'t have an account. Checkout now!', array('name'=>'checkoutBtn', 'value'=>'proceed', 'id'=>'checkoutNowButton'));
	?>
	</fieldset>
	

<?php echo $this->Form->end('Login');?>
</div>