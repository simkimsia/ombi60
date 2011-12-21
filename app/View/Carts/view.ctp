<?php
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
?>
<?php 

	$totalAmountWithShipping 	= $currentCart['Cart']['amount'];
	$cart_uuid 					= $currentCart['Cart']['id'];
	$shopId						= $currentCart['Cart']['shop_id'];

	echo $this->element('checkout_information', array(
		'is_shipping_included' => FALSE, 
		'step' => 1,
	));
	

	
?>
<?php 
	echo $this->Form->create('Order', array(
		'url' => array(
			'controller' 	=> 'carts',
			'action' 		=> 'create_order',
			'shop_id'		=> $shopId,
			'cart_uuid' 	=> $cart_uuid
	)));
?>
<?php if (!$customerId) : ?>
	<div class="gray_background">
	    <div><?php
	    	echo $this->Form->label('Contact Email');
		 ?></div>
	    <div class="clear"></div>
	    <?php 
	        echo $this->Form->input('User.email', array('div' => FALSE)); 
	    ?>
	</div>
	<?php else: 
		    echo $this->Form->input('User.email', array('type' => 'hidden', 'value' => $user['User']['email'])); 
	    
	endif;?>
<div class="clear">&nbsp;</div>

<div class="gray_background">

    <div class="billing_left">
        <h2 class="border_bottom">Billing Address</h2>

	    
		<?php
        echo $this->Form->input('Cart.id', array('type'=>'hidden', 'value'=>$cart_uuid));

        if (!$customerId) {
            //echo $this->Form->input('User.email', array('div' => FALSE));
        } 
        
        echo $this->Form->input('Order.customer_id', array('type' => 'hidden', 'value'=>$customerId));
        echo $this->Form->input('Customer.shop_id', array('type' => 'hidden', 'value'=>$shopId));
		?>

        <?php
	    if (!empty($billingAddresses)) :
	    ?>
		<br />
		<select id="billing_address_selector" name="billing_address_selector">
	        <?php foreach ($billingAddresses as $address) : 
				
				$text = $address['BillingAddress']['full_name'] . ', ' . 
 						$address['BillingAddress']['address'] . ', ' .
						$address['BillingAddress']['city'] . ', ' .
						$address['BillingAddress']['region'] . ', ' .
						$address['BillingAddress']['zip_code'] . ', ' .
						$address['Country']['printable_name'];
						
				$text = substr($text, 0, 50) . ' ...';
			?>
			<option value="<?php echo $address['BillingAddress']['id']; ?>"><?php echo $text; ?></option>
	        <?php endforeach; ?>
			<option>New Address...</option>
		</select>
		<br />
		<?php endif; ?>
        
		<?php
        echo $this->Form->input('BillingAddress.0.full_name', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.address', array('div' => FALSE, 'type' => 'textarea'));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.city', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.region', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.zip_code', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('BillingAddress.0.country', array('type' => 'select', 'options' => $countries, 'div' => FALSE, 'style' => "width: 250px;", 'empty' => '-----------'));
        echo "<div class='clear'></div>";

		echo $this->Form->input('BillingAddress.0.phone', array('div' => FALSE));
        echo "<div class='clear'></div>";

        echo $this->Form->input('BillingAddress.0.type', array('type' => 'hidden', 'value' => BILLING, 'div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->checkbox('DeliveryAddress.same', array('checked'=>true, ));
        echo 'Ship to above billing address';
        ?>
    </div>
    <div class="billing_left">
        <h2 class="border_bottom">Shipping Address</h2>
        <div class="error_message" id="err_msg">Product(s) shipped to billing address</div>
        <div id="delivery_address">
	
        <?php
	    if (!empty($shippingAddresses)) :
	    ?>
		<br />
		<select id="delivery_address_selector" name="delivery_address_selector">
	        <?php foreach ($shippingAddresses as $address) : 

				$text = $address['DeliveryAddress']['full_name'] . ', ' . 
 						$address['DeliveryAddress']['address'] . ', ' .
						$address['DeliveryAddress']['city'] . ', ' .
						$address['DeliveryAddress']['region'] . ', ' .
						$address['DeliveryAddress']['zip_code'] . ', ' .
						$address['Country']['printable_name'];

				$text = substr($text, 0, 50) . ' ...';
			?>
			<option value="<?php echo $address['DeliveryAddress']['id']; ?>"><?php echo $text; ?></option>
	        <?php endforeach; ?>
			<option>New Address...</option>
		</select>
		<br />
		<?php endif; ?>
	
	
        <?php
        echo $this->Form->input('DeliveryAddress.0.full_name', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.address', array('div' => FALSE, 'type' => 'textarea'));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.city', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.region', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.zip_code', array('div' => FALSE));
        echo "<div class='clear'></div>";
        echo $this->Form->input('DeliveryAddress.0.country', array('type' => 'select', 'options' => $countries, 'div' => FALSE, 'style' => "width: 250px;", 'empty' => '-----------'));
        echo "<div class='clear'></div>";

		echo $this->Form->input('DeliveryAddress.0.phone', array('div' => FALSE));
        echo "<div class='clear'></div>";

        echo $this->Form->input('DeliveryAddress.0.type', array('type'=>'hidden', 'value'=>BILLING));
        ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php echo $this->Form->submit('Continue to next step', array('div' => FALSE));?>
&nbsp;or&nbsp;
<?php
echo $this->element('return_to_store');
?>
<?php echo $this->Form->end();?>

<!--<div>
	<div id="totalAmountWithShipping">
	<?php echo $this->Number->currency($totalAmountWithShipping, 'SGD'); ?>
	</div>
</div>-->


<script type="text/javascript">
    var isChanged = false;
    var isChangedDelivery = false;

	var billingAddresses = $.parseJSON('<?php echo json_encode($billingAddresses) ?>');
	var deliveryAddresses = $.parseJSON('<?php echo json_encode($shippingAddresses) ?>');

    $(document).ready(function(){       
        //Hide div w/id extra
		if ($("#DeliveryAddressSame").is(":checked")) {
			$("#delivery_address").css("display","none");
			$("#err_msg").css("display", "block");
		} else {
			$("#delivery_address").css("display","block");
			$("#err_msg").css("display", "none");
		}

        // Add onclick handler to checkbox w/id checkme
       $("#DeliveryAddressSame").click(function(){
        
        // If checked
        if ($("#DeliveryAddressSame").is(":checked"))
        {
            //show the hidden div
            $("#delivery_address").hide();
            $("#err_msg").show();
        }
        else
        {      
            //otherwise, hide it 
            $("#delivery_address").show();
            $("#err_msg").hide();
        }
      });

		

		$("#billing_address_selector").change(function() {
			assignAddress('billing');
		});
		
		$("#delivery_address_selector").change(function() {
			assignAddress('delivery');
		});
		


       $(":input.shipToThisAddressBtn").each(function() {
		$(this).click(function() {		
			$("#OrderFixedDelivery").val($(this).attr('id'));
		});
       });

       $('#BillingAddress0Country').click(function(){      
         if (isChanged == false) {
             $('#BillingAddress0Country').prepend('<option value="0">Please select</option>');
             isChanged = true;
         }        
       }); 
       $('#DeliveryAddress0Country').click(function(){      
         if (isChangedDelivery == false) {
             $('#DeliveryAddress0Country').prepend('<option value="0">Please select</option>');
             isChangedDelivery = true;
         }        
       }); 

		// set the default fields
		assignAddress('billing');
		assignAddress('delivery');

    });

	function assignAddress(type) {
		if (type == 'billing') {
			addresses = billingAddresses;
			selector = "#billing_address_selector";
			preFieldId = "#BillingAddress0";
			model = 'BillingAddress';
		} else {
			addresses = deliveryAddresses;
			selector = "#delivery_address_selector";
			preFieldId = "#DeliveryAddress0";
			model = 'DeliveryAddress';
		}
		var id = $(selector).val();

		$(preFieldId+"FullName").val(addresses[id][model]['full_name']);
		$(preFieldId+"ZipCode").val(addresses[id][model]['zip_code']);
		$(preFieldId+"Address").val(addresses[id][model]['address']);
		$(preFieldId+"City").val(addresses[id][model]['city']);
		$(preFieldId+"Region").val(addresses[id][model]['region']);
		$(preFieldId+"Country").val(addresses[id][model]['country']);
		$(preFieldId+"Phone").val(addresses[id][model]['phone']);
		
	}
</script>
