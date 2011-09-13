<?php
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<div>
    <div class="text_center"><h2><?php echo __('Payments');?></h2></div>

    <div class="payments">
        <div class="payment_left">
            <?php echo $html->image('paypal_cc.gif', array('alt' => 'Paypal'));?>
        </div>
        <div class="payment_right">
            <div class="service_class">Service: <strong>PayPal</strong></div>
            <br>
            Description: PayPal Express Checkout, PayPal Website Payments Standard 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="payment_dropdown">
        <?php
	//echo '<pre/>';
	//print_r($paypalPaymentModule);
	
	if ($paypalPaymentModule) {
		
		$id = $paypalPaymentModule['PaypalPaymentModule']['shop_payment_module_id'];
	    ?>
	        <div id="activate-paypal-<?php echo $id; ?>" style="padding-top: 10px;" class="payment">
                <ul class="method_list">
                    <li class="payment_name"><span>Using method:<strong> <?php echo $paypalPaymentModule['PaypalPaymentModule']['name'];?></strong></span></li>
                    <li class="payment_edit"><span><a href="#" onclick="toggleEditForm('<?php echo $id; ?>', 'paypal');return false;">edit</a></span></li>
                    <li class="payment_turn_off"><?php
                     echo $this->Html->link(__('Turn Off'),
				           array(
					    'controller' => 'payments',
					       'action' => 'delete_custom_payment',
					       'admin' => true,
					         $id),
				           array('class'=>'actions'),
				           __('Are you sure you want to turn off this payment method?')); 
                    ?></li>
                </ul>
            <div class="clear">&nbsp;</div>
		    </div>
		<?php
		
		$spmID = $paypalPaymentModule['PaypalPaymentModule']['shop_payment_module_id'];
		$ppmID = $paypalPaymentModule['PaypalPaymentModule']['id'];
		?>
		<div class="payment" style="display:none;" id="form-edit-paypal-<?php echo $spmID;?>">
		<?php
		
		
		echo $this->Form->create('PaypalPaymentModule', array('url'=>array('controller' => 'payments',
								      'action' => 'edit_paypal_payment',
								      'admin' => true,
									$ppmID
									)));
	    ?>
	    <div class="email_div">
	        <?php
	            echo $this->Form->input('account_email', array('value'=>$paypalPaymentModule['PaypalPaymentModule']['account_email'], 'id'=>'EditPaypalPaymentModuleName'.$spmID, 'div' => FALSE, 'label' => 'PayPal Account Email'));
		echo $this->Form->input('PaypalPaymentModule.shop_payment_module_id', array('value'=>$spmID, 'type'=>'hidden'));
	        ?>
	    </div>
	    <div class="description_div">
	        <?php
		
		    if (strpos($paypalPaymentModule['PaypalPaymentModule']['name'], 'Website Payments Standard') >= 0) {
		        echo $this->element('paypal_description');
		    } else if (strpos($paypalPaymentModule['PaypalPaymentModule']['name'], 'Website Payments Standard') >= 0) {
		        echo $this->element('paypal_express_description');
		    }
		?>
	    </div>
	    <div class="clear"></div>
	    <div class="border_bottom"></div>
		<?php
		echo $this->Form->submit('Save', array('div' => false));
		echo "&nbsp;or&nbsp;";
		echo '<a href="#" onclick="toggleEditForm('.$id.', \'paypal\');return false;">Cancel</a>';
		echo $this->Form->end();
		?>
		</div>
		<?php
		
	} else {
		
		echo $this->Form->create('PaypalPaymentModule', array('url'=>array('controller' => 'payments',
							      'action' => 'add_paypal_payment',
							   'admin' => true)));
	

		$paypalOptions = array(''=>'I do not use Paypal',
				       'Website Payments Standard' => 'PayPal Website Payments Standard',
				       'Express Checkout' => 'Paypal Express Checkout');
		echo $this->Form->input('PaypalPaymentModule.name', array('options'=>$paypalOptions,
									  'id'=>'paypalPaymentSelect',
									  'label' => false,
									  'div' => FALSE,
									  'class' => 'custom_select',
									  ));
		
		?>
		<div id="paypalForm" style="display:none">
		    <div class="email_div">
		        <?php echo $this->Form->input('account_email');?>    
		    </div>
		    <div class="description_div">
		        <?php echo $this->element('paypal_description');?>
                <?php echo $this->element('paypal_express_description');?>
		    </div>
		    <div class="clear"></div>
		    <div class="border_bottom"></div>
		<?php
			
		echo $this->Form->submit('Turn On', array('div' => FALSE));
		?>
		</div>
		<?php
		echo $this->Form->end();		
	}	
	?>
	    <div class="clear"></div>
        </div>
        <div class="clear"></div>
        
    </div>
    <div class="payments">
        <div class="payment_left">
            <?php echo $html->image('custom_payment_method.gif', array('alt' => 'Custom'));?>
        </div>
        <div class="payment_right">
            <div class="service_class">Service: <strong>Custom Payment Methods</strong></div>
            <br>
            Description: Cash On Delivery, Money Order, Internet Banking and Others
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        
        <div class="payment_dropdown">
            <div id="custom_payment_gateway">	
	        <?php
	            $count = count($customPaymentModules);
	
	            $codPresent = false;
	            $moPresent = false;
	            $ibPresent = false;
	
	            if ($count > 0) {
	            ?>
	                <div class="payment">
	                    <div>
	            <?php
	            }
	
	            foreach($customPaymentModules as $key => $paymentModule):
		            if (!$codPresent)
			            $codPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Cash On Delivery');
		            if (!$moPresent)
			            $moPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Money Order');
		            if (!$ibPresent)
			            $ibPresent = ($paymentModule['CustomPaymentModule']['name'] == 'Internet Banking Transfer');
	
		            $id = $paymentModule['CustomPaymentModule']['shop_payment_module_id'];
	                ?>
                    <div id="activate-custom-'<?php echo $id;?>'" style="padding: 10px 2px;" class="payment">
                        <ul class="method_list">
                            <li class="payment_name"><span>Using method:<strong> <?php echo $paymentModule['CustomPaymentModule']['name'];?></strong></span></li>
                            <li class="payment_edit"><span><a href="#" onclick="toggleEditForm('<?php echo $id; ?>', 'custom');return false;">edit</a></span></li>
                            <li class="payment_turn_off"><?php
                             echo $this->Html->link(__('Turn Off'),
				                   array(
					            'controller' => 'payments',
					               'action' => 'delete_custom_payment',
					               'admin' => true,
					                 $id),
				                   array('class'=>'actions'),
				                   __('Are you sure you want to turn off this payment method?')); 
                            ?></li>
                        </ul>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="border_bottom"></div>
	                <?php		
		
		            $spmID = $paymentModule['CustomPaymentModule']['shop_payment_module_id'];
		            $cpmID = $paymentModule['CustomPaymentModule']['id'];
		            ?>
                    <div class="payment" style="display:none;" id="form-edit-custom-<?php echo $spmID;?>">
		            <?php
		
		            echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
								                  'action' => 'edit_custom_payment',
								                  'admin' => true,
									            $cpmID
									            )));
	
		            echo $this->Form->input('name', array('value'=>$paymentModule['CustomPaymentModule']['name'], 'id'=>'EditCustomPaymentModuleName'.$spmID));
		            echo $this->Form->input('CustomPaymentModule.shop_payment_module_id', array('value'=>$spmID, 'type'=>'hidden'));
		            ?>
		            <span class="hint">Enter instructions. We wil display to the customer when they are checking out.</span>
		            <?php
		            echo $this->Form->input('instructions', array('type'=>'textarea', 'value'=> $paymentModule['CustomPaymentModule']['instructions'], 'label' => FALSE));
		            echo $this->Form->submit('Save', array('div' => FALSE));
		            ?>
		            &nbsp;or&nbsp;
		            <a href="#" onclick="toggleEditForm('<?php echo $id;?>', 'custom');return false;">Cancel</a>
		            <?php		            
		            echo $this->Form->end();
		            ?>
		            </div>
	            <?php endforeach;
	                if ($count > 0) {
	                    ?>
	                        </div>
	                    </div>
	                    <?php
	                }
	            ?>
	            <div class="clear"></div>
	            
	            <select id="customPaymentSelect" class="custom_select">
			        <option value="">Select a custom payment mode to add</option>
			        <option value="">------</option>';
			
	                <?php if (!$codPresent) { ?><option value="Cash On Delivery">Cash On Delivery</option><?php } ?>
	                <?php if (!$moPresent) { ?><option value="Money Order">Money Order</option><?php } ?>
	                <?php if (!$ibPresent) { ?><option value="Internet Banking Transfer">Internet Banking Transfer</option><?php } ?>
	                <option value="">------</option>
			        <option value="custom">Create new custom payment mode</option>
		        </select>
		        <div class="clear"></div>
                <div class="border_bottom"></div>
                <div id="customForm" style="display:none">
	            <?php
	                echo $this->Form->create('CustomPaymentModule', array('url'=>array('controller' => 'payments',
							                      'action' => 'add_custom_payment',
							                   'admin' => true)));
	
	                echo $this->Form->input('name');
	                ?>
	                <span class="hint">Enter instructions. We wil display to the customer when they are checking out.</span>
	                <?php
	                echo $this->Form->input('instructions', array('type'=>'textarea', 'label' => FALSE));
	                echo $this->Form->submit('Save', array('div' => FALSE));
	                ?>
	                &nbsp;or&nbsp;
	                <a href="#" onclick="$('#customForm').hide(); return false;">Cancel</a>
	                <?php
	                echo $this->Form->end();
	            ?>
                </div>
        </div>
        <div class="clear"></div>
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


