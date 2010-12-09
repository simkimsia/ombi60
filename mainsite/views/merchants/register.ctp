<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');

?>


<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Merchant', array('url'=>array('controller'=>'merchants',
								'action' => 'register','plan'=>$plan)));
	echo $this->Form->input('Shop.name', array('label'=>'Shop name'));
	echo $this->Form->input('Shop.web_address', array('value'=>'', 'type'=>'hidden') );
	echo 'http://' . $this->Form->input('Shop.subdomain', array('label'=>'Web Address')) . '.myspree2shop.com' ;
	echo $this->Form->input('User.full_name');
	echo $this->Form->input('User.name_to_call');
	
	
	echo $this->Form->input('User.email');
	
	echo $this->Form->input('theme_id');
	
	echo '<div class="panes">';
	foreach($themes as $id=>$foldername) {
		echo '<div id="img_'.$id.'">';
		echo $this->Html->image('../theme/' . $foldername . '/img/preview.jpg');
		echo '</div>';
	}
	
	echo '</div>';
	
	echo $this->Form->input('User.password');
	
	echo $this->Form->input('User.password_confirm', array('type' => 'password'));
	
		
	echo '<div id="cartpaypal">';
	// we will use the name to identify the button.
	// $this->params['form']['submit']
	echo '<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" name="submit" value="paypalExpressCheckout" alt="Make payments with PayPal - it\'s fast, free and secure!">';
	echo '</div>';
				
	
	echo $this->Form->end();
	
?>

<script type="text/javascript">

	function getFullDomain(subdomain){
		return 'http://' + subdomain + '.myspree2shop.com';
	}

	$(document).ready(function() {
		
		

		$('#ShopWebAddress').val( getFullDomain($('#ShopSubdomain').val()) );

		$('#ShopSubdomain').keyup( function () {
			$('#ShopWebAddress').val( getFullDomain($('#ShopSubdomain').val()) );
		});
		
		// first hide all the images in panes initially
		$('div.panes').children().hide();
		$('#img_' + $('#MerchantThemeId').val()).show();
		
		$('#MerchantThemeId').change(function() { 
			var message_index;
		 
			message_index = $(this).val(); 
			$('div.panes').children().hide();
		 
			if (message_index > 0) 
			    $('#img_' + message_index).show();
		}); 


	});
	
	

</script>