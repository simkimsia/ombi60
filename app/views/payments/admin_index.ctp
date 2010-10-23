<?php

	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');

?>

<div class="products index">
<h2><?php __('Payment Settings');?></h2>

	<dl id="custom_payment_gateway" style="padding: 0px 10px 0pt; margin-bottom: 0pt; border-top: 1px solid rgb(221, 221, 221);">

	
	<?php
	
	$count = count($customPaymentModules);
	
	$codPresent = false;
	$moPresent = false;
	$ibPresent = false;
	
	if ($count > 0) {
		echo '<dd class="payment">';
		echo '<dl>';
	}
	
	foreach($customPaymentModules as $key => $paymentModule):
	
		$codPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Cash On Delivery');
		$moPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Money Order');
		$ibPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Internet Banking Transfer');
	
		$id = $paymentModule['CustomPaymentModule']['shop_payment_module_id'];
	
		echo '<dd id="activate-custom-'.$id.'" style="padding-top: 10px;" class="payment">';
		
		echo 'Using method:<strong>' . $paymentModule['CustomPaymentModule']['name'] . '</strong>';
		
		echo '<a href="#" onclick="toggleEditForm('.$id.');return false;">edit</a>';
		
		echo $this->Html->link(__('Turn Off', true),
				       array(
					'controller' => 'payments',
					   'action' => 'delete_custom_payment',
					   'admin' => true,
					     $id),
				       array('class'=>'actions'),
				       __('Are you sure?', true)); 
		
		
		
		
		echo '</dd>';
		
		echo '<dd class="payment" style="display:none;border-top:1px solid rgb(221, 221, 221);padding-bottom:10px;" id="form-edit-custom-'.$paymentModule['CustomPaymentModule']['shop_payment_module_id'].'">';
		
		echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
								      'action' => 'edit_custom_payment',
								      'admin' => true,
									$paymentModule['CustomPaymentModule']['id']
									)));
	
		echo $this->Form->input('name', array('value'=>$paymentModule['CustomPaymentModule']['name']));
		echo $this->Form->input('instructions', array('type'=>'textarea', 'value'=> $paymentModule['CustomPaymentModule']['instructions']));
		echo $this->Form->submit('Save');
		echo '<a href="#" onclick="toggleEditForm('.$id.');return false;">Cancel</a>';
		echo $this->Form->end();
		
		echo '</dd>';
	
	?>
	
	
	
	<?php endforeach;
	if ($count > 0) {
		echo '</dd>';
		echo '</dl>';
	}
	
	?>
	
	

	<?php
	echo '<dt>';
	echo '<select id="customPaymentSelect" >
			<option value="">Select a custom payment mode to add</option>
			<option value="">------</option>';
			
	if (!$codPresent) echo	'	<option value="Cash On Delivery">Cash On Delivery</option>';
	if (!$moPresent) echo '		<option value="Money Order">Money Order</option>';
	if (!$ibPresent) echo '		<option value="Internet Banking Transfer">Internet Banking Transfer</option>';
	echo '		<option value="">------</option>
			<option value="custom">Create new custom payment mode</option>
		</select>';
	echo '</dt>';
	
	echo '<dd id="customForm" style="display:none">';
	echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
							      'action' => 'add_custom_payment',
							   'admin' => true)));
	
	echo $this->Form->input('name');
	echo $this->Form->input('instructions', array('type'=>'textarea'));
	
	echo $this->Form->end('Turn On');
	echo '</dd>';
	
	
	?>


	

	</dl>
</div>


<script>
	$(document).ready(function() {
		$('#customFormDiv').hide();
		
	});
	
	function toggleEditForm(id) {
		var formId = '#form-edit-custom-' + id;
		var activateId = '#activate-custom-' + id;
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
	
</script>


