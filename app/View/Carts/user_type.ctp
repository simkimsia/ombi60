<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
?>
<div class="login-checkout">
<?php
	
	
	echo $this->Form->create('Customer', array('action' => 'login'));
?>
	<?php
		echo $this->Session->flash();
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.password');
		echo $this->Form->input('User.password_confirm', array('type' => 'password', 'id' => 'password_confirm'));
		echo $this->Form->input('User.new_user', array('type' => 'checkbox', 'id' => 'new_user', 'label' => 'New user?' ));
		echo $this->Form->input('Customer.shop_id', array('type'=>'hidden', 'value'=> $shop_id));
		echo $this->Form->input('Customer.fromCheckout', array('type'=>'hidden', 'value' => true ));
		echo $this->Form->input('Customer.cart_uuid', array('type'=>'hidden', 'value' => $cart_uuid));
		
		echo $this->Form->submit('Login', array('name'=>'loginBtn', 'value'=>'login', 'id'=>'loginRegisterBtn'));
		
	?>
</div>
<?php if (!$registered_only): ?>
		<div class="guest-checkout">
	<?php
		echo $this->Form->submit('Continue as Guest', array('name'=>'checkoutBtn', 'value'=>'proceed', 'id'=>'checkoutNowButton'));
	?>
	</div>
<?php endif; ?>
<?php echo $this->Form->end();?>


<script type="text/javascript">
	$(document).ready(function(){       
	    //Hide div w/id extra
	   $("#password_confirm").parent().css("display","none");
	    // Add onclick handler to checkbox w/id checkme
	   $("#new_user").click(function(){
	    
	    // If checked
	    if ($("#new_user").is(":checked"))
	    {
	        //show the hidden div
	        $("#password_confirm").parent().show("fast");
	        $("#loginRegisterBtn").val("Register");
	    }
	    else
	    {      
	        //otherwise, hide it 
	        $("#password_confirm").parent().hide("fast");
	        $("#loginRegisterBtn").val("Login");
	        
	    }
  });});
</script>