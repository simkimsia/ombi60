<?php

	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');

?>

<div class="products index">
<h2><?php __('Payment Settings');?></h2>

	<?php
	//echo '<pre/>';
	//print_r($paypalPaymentModule);
	
	if ($paypalPaymentModule) {
		
		$id = $paypalPaymentModule['PaypalPaymentModule']['shop_payment_module_id'];
	
		echo '<div id="activate-paypal-'.$id.'" style="padding-top: 10px;" class="payment">';
		
		echo 'Using method:<strong>' . $paypalPaymentModule['PaypalPaymentModule']['name'] . '</strong>';
		
		echo '<a href="#" onclick="toggleEditForm('.$id.', \'paypal\');return false;">edit</a>';
		
		echo $this->Html->link(__('Turn Off', true),
				       array(
					'controller' => 'payments',
					   'action' => 'delete_custom_payment',
					   'admin' => true,
					     $id),
				       array('class'=>'actions'),
				       __('Are you sure?', true)); 
		
		
		echo '</div>';
		
		$spmID = $paypalPaymentModule['PaypalPaymentModule']['shop_payment_module_id'];
		$ppmID = $paypalPaymentModule['PaypalPaymentModule']['id'];
		
		echo '<div class="payment" style="display:none;border-top:1px solid rgb(221, 221, 221);padding-bottom:10px;" id="form-edit-paypal-'.$spmID.'">';
		
		echo $this->Form->create('PaypalPaymentModule', array('url'=>array('controller' => 'payments',
								      'action' => 'edit_paypal_payment',
								      'admin' => true,
									$ppmID
									)));
	
		echo $this->Form->input('account_email', array('value'=>$paypalPaymentModule['PaypalPaymentModule']['account_email'], 'id'=>'EditPaypalPaymentModuleName'.$spmID));
		echo $this->Form->input('PaypalPaymentModule.shop_payment_module_id', array('value'=>$spmID, 'type'=>'hidden'));
		
		if (strpos($paypalPaymentModule['PaypalPaymentModule']['name'], 'Website Payments Standard') >= 0) {
			echo '	<div id="paypalWPSDescription">
	Please provide your PayPal Website Payments Standard account credentials.  Sign up for a PayPal account now<br />PayPal: Proven to increase sales. According to Jupiter Research, 23% of online shoppers like to pay with PayPal.* If you offer your visitors the choice to pay with PayPal, they may be more likely to buy.<br /> *September 2007 Jupiter Research study of payment preferences online. See a demo of Paypal Website Payments Standard
		</div>';	
		} else if (strpos($paypalPaymentModule['PaypalPaymentModule']['name'], 'Website Payments Standard') >= 0) {
			echo '	<div id="paypalECDescription" >
	Please provide your PayPal Express Checkout account credentials.  Sign up for a PayPal account nowYou must have a PayPal business account and you must grant Shopify third-party API Access in your PayPal profile:Navigate to the Give Third-Party API Permission PageEnter scott_api1.jadedpixel.com as the API Partner Username.Check all of the boxes: Direct Payment, Express Checkout, Reporting and Backoffice APIs, Authorization and Settlement APIs, and click Submit.On the following screen click the Give Permission button.Click the Edit button to edit the permissions and check ManagePendingTransactionStatus. Click Submit.PayPal: Proven to increase sales. According to Jupiter Research, 23% of online shoppers like to pay with PayPal.* If you offer your visitors the choice to pay with PayPal, they may be more likely to buy.* September 2007 Jupiter Research study of payment preferences online.See a demo of Paypal Express Checkout
		</div>';
		}
		
		echo $this->Form->submit('Save');
		echo '<a href="#" onclick="toggleEditForm('.$id.', \'paypal\');return false;">Cancel</a>';
		echo $this->Form->end();
		
		echo '</div>';
		
	} else {
		
		echo $this->Form->create('PaypalPaymentModule', array('url'=>array('controller' => 'payments',
							      'action' => 'add_paypal_payment',
							   'admin' => true)));
	
		echo '<div>';
		
		$paypalOptions = array(''=>'I do not use Paypal',
				       'Website Payments Standard' => 'Paypal Website Payments Standard',
				       'Express Checkout' => 'Paypal Express Checkout');
		echo $this->Form->input('PaypalPaymentModule.name', array('options'=>$paypalOptions,
									  'id'=>'paypalPaymentSelect',
									  'label' => false));
		
		echo '</div>';
		
		
		echo '<div id="paypalForm" style="display:none">';
		echo $this->Form->input('account_email');
		
		echo '	<div id="paypalWPSDescription" style="display:none">
		Please provide your PayPal Website Payments Standard account credentials.  Sign up for a PayPal account now<br />PayPal: Proven to increase sales. According to Jupiter Research, 23% of online shoppers like to pay with PayPal.* If you offer your visitors the choice to pay with PayPal, they may be more likely to buy.<br /> *September 2007 Jupiter Research study of payment preferences online. See a demo of Paypal Website Payments Standard
			</div>';
		echo '	<div id="paypalECDescription" style="display:none">
		Please provide your PayPal Express Checkout account credentials.  Sign up for a PayPal account nowYou must have a PayPal business account and you must grant Shopify third-party API Access in your PayPal profile:Navigate to the Give Third-Party API Permission PageEnter scott_api1.jadedpixel.com as the API Partner Username.Check all of the boxes: Direct Payment, Express Checkout, Reporting and Backoffice APIs, Authorization and Settlement APIs, and click Submit.On the following screen click the Give Permission button.Click the Edit button to edit the permissions and check ManagePendingTransactionStatus. Click Submit.PayPal: Proven to increase sales. According to Jupiter Research, 23% of online shoppers like to pay with PayPal.* If you offer your visitors the choice to pay with PayPal, they may be more likely to buy.* September 2007 Jupiter Research study of payment preferences online.See a demo of Paypal Express Checkout
			</div>';
			
		echo $this->Form->submit('Turn On');
		echo '</div>';
		echo $this->Form->end();
	
		
	}
	
	
	
	
	?>


	<div id="custom_payment_gateway" style="padding: 0px 10px 0pt; margin-bottom: 0pt; border-top: 1px solid rgb(221, 221, 221);">

	
	<?php
	
	$count = count($customPaymentModules);
	
	$codPresent = false;
	$moPresent = false;
	$ibPresent = false;
	
	if ($count > 0) {
		echo '<div class="payment">';
		echo '<div>';
	}
	
	foreach($customPaymentModules as $key => $paymentModule):
		if (!$codPresent)
			$codPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Cash On Delivery');
		if (!$moPresent)
			$moPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Money Order');
		if (!$ibPresent)
			$ibPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Internet Banking Transfer');
	
		$id = $paymentModule['CustomPaymentModule']['shop_payment_module_id'];
	
		echo '<div id="activate-custom-'.$id.'" style="padding-top: 10px;" class="payment">';
		
		echo 'Using method:<strong>' . $paymentModule['CustomPaymentModule']['name'] . '</strong>';
		
		echo '<a href="#" onclick="toggleEditForm('.$id.', \'custom\');return false;">edit</a>';
		
		echo $this->Html->link(__('Turn Off', true),
				       array(
					'controller' => 'payments',
					   'action' => 'delete_custom_payment',
					   'admin' => true,
					     $id),
				       array('class'=>'actions'),
				       __('Are you sure?', true)); 
		
		
		
		
		echo '</div>';
		
		$spmID = $paymentModule['CustomPaymentModule']['shop_payment_module_id'];
		$cpmID = $paymentModule['CustomPaymentModule']['id'];
		
		echo '<div class="payment" style="display:none;border-top:1px solid rgb(221, 221, 221);padding-bottom:10px;" id="form-edit-custom-'.$spmID.'">';
		
		echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
								      'action' => 'edit_custom_payment',
								      'admin' => true,
									$cpmID
									)));
	
		echo $this->Form->input('name', array('value'=>$paymentModule['CustomPaymentModule']['name'], 'id'=>'EditCustomPaymentModuleName'.$spmID));
		echo $this->Form->input('CustomPaymentModule.shop_payment_module_id', array('value'=>$spmID, 'type'=>'hidden'));
		echo $this->Form->input('instructions', array('type'=>'textarea', 'value'=> $paymentModule['CustomPaymentModule']['instructions']));
		echo $this->Form->submit('Save');
		echo '<a href="#" onclick="toggleEditForm('.$id.', \'custom\');return false;">Cancel</a>';
		echo $this->Form->end();
		
		echo '</div>';
	
	?>
	
	
	
	<?php endforeach;
	if ($count > 0) {
		echo '</div>';
		echo '</div>';
	}
	
	?>
	
	

	<?php
	echo '<div>';
	echo '<select id="customPaymentSelect" >
			<option value="">Select a custom payment mode to add</option>
			<option value="">------</option>';
			
	if (!$codPresent) echo	'	<option value="Cash On Delivery">Cash On Delivery</option>';
	if (!$moPresent) echo '		<option value="Money Order">Money Order</option>';
	if (!$ibPresent) echo '		<option value="Internet Banking Transfer">Internet Banking Transfer</option>';
	echo '		<option value="">------</option>
			<option value="custom">Create new custom payment mode</option>
		</select>';
	echo '</div>';
	
	echo '<div id="customForm" style="display:none">';
	echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
							      'action' => 'add_custom_payment',
							   'admin' => true)));
	
	echo $this->Form->input('name');
	echo $this->Form->input('instructions', array('type'=>'textarea'));
	
	echo $this->Form->end('Turn On');
	echo '</div>';
	
	
	?>

	


	

	</div>	
</div>


<script>
	$(document).ready(function() {
		$('#customFormDiv').hide();
		
	});
	
	function toggleEditForm(id, type) {
		
		var formId = '#form-edit-' + type + '-' + id;
		var activateId = '#activate-' + type + '-' + id;
		$(activateId).toggle();
		$(formId).toggle();
		
	}
	
	
	$('#customPaymentSelect').change(function () {
		
		var valueOfSelect = $('#customPaymentSelect').val();
		
		
		if (valueOfSelect != '') {
			$('#customForm').show();
			if (valueOfSelect == 'custom') {
				$('#CustomPaymentModuleName').attr('value', 'Enter custom payment mode name');
				$('#CustomPaymentModuleName').select();	
			} else {
				
				$('#CustomPaymentModuleName').attr('value', valueOfSelect);
				$('#CustomPaymentModuleInstructions').focus();	
			}
		} else {
			$('#customForm').hide();
		}
		
		
	});
	
	
	$('#paypalPaymentSelect').change(function () {
		
		var valueOfSelect = $('#paypalPaymentSelect').val();
		
		
		if (valueOfSelect != '') {
			$('#paypalForm').show();
			innerHtml = '';
			if (valueOfSelect == 'Website Payments Standard') {
				$('#paypalWPSDescription').show();
				$('#paypalECDescription').hide();
			} else if (valueOfSelect == 'Express Checkout') {
				$('#paypalECDescription').show();
				$('#paypalWPSDescription').hide();
			} else {
				$('#paypalECDescription').hide();
				$('#paypalWPSDescription').hide();
			}
			
			$('#PaypalPaymentModuleName').focus();	
			
		} else {
			$('#paypalForm').hide();
		}
		
		
	});
	
</script>


